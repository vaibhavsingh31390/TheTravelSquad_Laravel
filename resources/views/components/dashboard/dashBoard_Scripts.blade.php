<script type="text/javascript">
    const richTextToolbar = [
        [{ header: [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ indent: '-1' }, { indent: '+1' }],
        ['blockquote', 'code-block'],
        ['link', 'image'],
        [{ align: [] }],
        ['clean'],
    ];

    window.travelSquadEditorMode = 'visual';

    function syncRichTextEditor() {
        if (window.travelSquadEditorMode === 'html') {
            $('#content').val($('#content-html').val() || '');
            return;
        }

        if (window.travelSquadEditor) {
            $('#content').val(window.travelSquadEditor.root.innerHTML);
        }
    }

    function setRichTextEditorMode(mode) {
        var $shell = $('.rich-text-shell');
        if (!$shell.length) {
            return;
        }

        mode = mode === 'html' ? 'html' : 'visual';

        if (mode === 'html') {
            if (window.travelSquadEditor) {
                $('#content-html').val(window.travelSquadEditor.root.innerHTML);
            } else {
                $('#content-html').val($('#content').val() || '');
            }
            $('#content-editor-visual').addClass('d-none');
            $('#content-editor-html').removeClass('d-none');
        } else {
            var html = $('#content-html').val() || $('#content').val() || '<p><br></p>';
            $('#content').val(html);
            if (window.travelSquadEditor) {
                window.travelSquadEditor.root.innerHTML = html;
            }
            $('#content-editor-html').addClass('d-none');
            $('#content-editor-visual').removeClass('d-none');
        }

        window.travelSquadEditorMode = mode;
        $shell.find('.rich-text-mode-btn').removeClass('active').attr('aria-selected', 'false');
        $shell.find('.rich-text-mode-btn[data-mode="' + mode + '"]').addClass('active').attr('aria-selected', 'true');
        syncRichTextEditor();
    }

    function editorImageHandler() {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/jpeg,image/png,image/gif,image/webp');
        input.click();

        input.onchange = function () {
            var file = input.files && input.files[0];
            if (!file || !window.travelSquadEditor) return;

            var formData = new FormData();
            formData.append('image', file);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var range = window.travelSquadEditor.getSelection(true);

            $.ajax({
                url: "{{ route('editor.upload') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.url) {
                        window.travelSquadEditor.insertEmbed(range.index, 'image', res.url);
                        syncRichTextEditor();
                    }
                },
                error: function () {
                    alert('Image upload failed. Use JPG, PNG, GIF, or WebP under 5MB.');
                }
            });
        };
    }

    function initRichTextEditor() {
        var editorEl = document.getElementById('content-editor');
        if (!editorEl || typeof Quill === 'undefined') {
            return;
        }

        if (window.travelSquadEditor) {
            window.travelSquadEditor = null;
        }

        window.travelSquadEditorMode = 'visual';

        var initialHtml = $('#content').val() || '<p><br></p>';
        $('#content-html').val(initialHtml);

        window.travelSquadEditor = new Quill('#content-editor', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: richTextToolbar,
                    handlers: { image: editorImageHandler }
                }
            },
            placeholder: 'Write your story — headings, paragraphs, inline images, lists, and more…',
        });

        window.travelSquadEditor.root.innerHTML = initialHtml;
        syncRichTextEditor();

        window.travelSquadEditor.on('text-change', function () {
            syncRichTextEditor();
        });

        $('#content-editor-visual').removeClass('d-none');
        $('#content-editor-html').addClass('d-none');
        $('.rich-text-mode-btn').removeClass('active').attr('aria-selected', 'false');
        $('.rich-text-mode-btn[data-mode="visual"]').addClass('active').attr('aria-selected', 'true');
    }

    $(document).on('click', '.rich-text-mode-btn', function (e) {
        e.preventDefault();
        setRichTextEditorMode($(this).data('mode'));
    });

    $(document).on('input', '#content-html', function () {
        if (window.travelSquadEditorMode === 'html') {
            syncRichTextEditor();
        }
    });

    function debounce(fn, wait) {
        var timeout;
        return function () {
            var context = this;
            var args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                fn.apply(context, args);
            }, wait);
        };
    }

    function getTagifyInstance() {
        var input = document.getElementById('tags');
        if (!input) {
            return null;
        }

        return input.tagify || input._tagify || null;
    }

    function getTagsCommaValue() {
        var tagify = getTagifyInstance();
        if (!tagify) {
            return $('#tags-value').val() || '';
        }

        return tagify.getCleanValue()
            .map(function (item) {
                return item.value;
            })
            .filter(Boolean)
            .join(',');
    }

    function syncTagsField() {
        $('#tags-value').val(getTagsCommaValue());
    }

    var tagsAutocomplete = {
        items: [],
        query: '',
        activeIndex: 0,
        visible: false,
        selecting: false,
    };

    function hideTagsAutocomplete() {
        tagsAutocomplete.visible = false;
        tagsAutocomplete.items = [];
        tagsAutocomplete.activeIndex = 0;
        $('#tags-autocomplete').addClass('d-none').empty();
    }

    function renderTagsAutocomplete() {
        var $panel = $('#tags-autocomplete');
        if (!tagsAutocomplete.items.length) {
            hideTagsAutocomplete();
            return;
        }

        var html = tagsAutocomplete.items.map(function (item, index) {
            var value = item.value || item;
            var activeClass = index === tagsAutocomplete.activeIndex ? ' is-active' : '';
            return '<button type="button" class="tags-autocomplete__item' + activeClass + '" role="option" data-value="' + $('<div>').text(value).html() + '">' + $('<div>').text(value).html() + '</button>';
        }).join('');

        $panel.html(html).removeClass('d-none');
        tagsAutocomplete.visible = true;
    }

    function selectTagFromAutocomplete(tagName) {
        var tagify = getTagifyInstance();
        if (!tagify || !tagName) {
            return;
        }

        var query = (tagsAutocomplete.query || '').trim().toLowerCase();
        var tagNameStr = String(tagName).trim();
        var tagNameLower = tagNameStr.toLowerCase();

        if (tagify.DOM.input) {
            tagify.DOM.input.innerHTML = '';
        }

        tagify.getCleanValue().forEach(function (tag) {
            var tagLower = String(tag.value).toLowerCase();

            if (tagLower === tagNameLower) {
                return;
            }

            if (query && tagLower === query) {
                tagify.removeTags(tag.value);
                return;
            }

            if (tagNameLower.indexOf(tagLower) === 0 && tagLower.length < tagNameLower.length) {
                tagify.removeTags(tag.value);
            }
        });

        var existing = tagify.getCleanValue().map(function (tag) {
            return String(tag.value).toLowerCase();
        });

        if (existing.indexOf(tagNameLower) === -1) {
            tagify.addTags([tagNameStr]);
        }

        tagsAutocomplete.query = '';
        hideTagsAutocomplete();
        syncTagsField();
        tagify.focus();
    }

    function handleTagsAutocompleteKeydown(ev) {
        if (!tagsAutocomplete.visible || !tagsAutocomplete.items.length) {
            return true;
        }

        if (ev.key === 'ArrowDown') {
            ev.preventDefault();
            tagsAutocomplete.activeIndex = Math.min(
                tagsAutocomplete.activeIndex + 1,
                tagsAutocomplete.items.length - 1
            );
            renderTagsAutocomplete();
            return false;
        }

        if (ev.key === 'ArrowUp') {
            ev.preventDefault();
            tagsAutocomplete.activeIndex = Math.max(tagsAutocomplete.activeIndex - 1, 0);
            renderTagsAutocomplete();
            return false;
        }

        if (ev.key === 'Escape') {
            ev.preventDefault();
            hideTagsAutocomplete();
            return false;
        }

        if (ev.key === 'Enter' || ev.key === 'Tab') {
            ev.preventDefault();
            ev.stopImmediatePropagation();

            var item = tagsAutocomplete.items[tagsAutocomplete.activeIndex];
            var value = item && (item.value || item);

            if (value) {
                selectTagFromAutocomplete(value);
            }

            return false;
        }

        return true;
    }

    function initTagsField() {
        var input = document.getElementById('tags');
        if (!input || typeof Tagify === 'undefined') {
            return;
        }

        var existing = input.tagify || input._tagify;
        if (existing) {
            existing.destroy();
        }

        hideTagsAutocomplete();

        var initialValue = $('#tags-value').val() || input.value || '';

        var tagify = new Tagify(input, {
            maxTags: 8,
            duplicates: false,
            enforceWhitelist: false,
            editTags: false,
            addTagOnBlur: false,
            addTagOn: ['blur', 'enter'],
            dropdown: {
                enabled: 0,
            },
        });

        if (tagify.DOM && tagify.DOM.input) {
            tagify.DOM.input.addEventListener('keydown', function (ev) {
                handleTagsAutocompleteKeydown(ev);
            }, true);
        }

        if (initialValue) {
            tagify.removeAllTags();
            tagify.addTags(initialValue);
        }

        var fetchTagSuggestions = debounce(function (value) {
            tagsAutocomplete.query = value || '';

            $.ajax({
                url: "{{ route('tags.search') }}",
                method: 'GET',
                data: { q: value || '' },
                dataType: 'json',
            })
                .done(function (items) {
                    var existing = tagify.getCleanValue().map(function (tag) {
                        return String(tag.value).toLowerCase();
                    });

                    tagsAutocomplete.items = (items || []).filter(function (item) {
                        var value = String(item.value || item).toLowerCase();
                        return existing.indexOf(value) === -1;
                    });
                    tagsAutocomplete.activeIndex = 0;
                    renderTagsAutocomplete();
                })
                .fail(function () {
                    hideTagsAutocomplete();
                });
        }, 300);

        tagify.on('input', function (e) {
            fetchTagSuggestions(e.detail.value);
        });

        tagify.on('focus', function () {
            fetchTagSuggestions(tagify.state.inputText || '');
        });

        tagify.on('blur', function () {
            setTimeout(function () {
                if (tagsAutocomplete.selecting) {
                    return;
                }

                hideTagsAutocomplete();
            }, 180);
        });

        tagify.on('add remove change', function () {
            syncTagsField();
        });

        input._tagify = tagify;
        syncTagsField();
    }

    $(document).on('mousedown', '#tags-autocomplete .tags-autocomplete__item', function (e) {
        e.preventDefault();
        e.stopPropagation();

        tagsAutocomplete.selecting = true;

        var value = this.getAttribute('data-value');
        if (value) {
            selectTagFromAutocomplete(value);
        }

        setTimeout(function () {
            tagsAutocomplete.selecting = false;
        }, 0);
    });

    function initThumbnailField() {
        var $input = $('#upload');
        var $preview = $('#thumbnail-preview');
        var $img = $('#thumbnail-preview-img');
        var $hint = $('#thumbnail-filename');

        if (!$input.length) {
            return;
        }

        $input.off('change.thumbnail').on('change.thumbnail', function () {
            var file = this.files && this.files[0];

            if (!file) {
                return;
            }

            if ($hint.length) {
                $hint.text(file.name);
            }

            var reader = new FileReader();
            reader.onload = function (event) {
                $img.attr('src', event.target.result);
                $preview.removeClass('d-none');
            };
            reader.readAsDataURL(file);
        });
    }

    function initPostFormFields() {
        initRichTextEditor();
        initThumbnailField();
        setTimeout(initTagsField, 0);
    }

    $(document).on('click', '.tag-suggestion-pill', function (e) {
        e.preventDefault();
        var tagify = getTagifyInstance();
        if (!tagify) {
            return;
        }

        var tagName = $(this).data('tag');
        if (tagName) {
            tagify.addTags([String(tagName)]);
            syncTagsField();
        }
    });

    function dashboardShowError(xhr, fallbackMessage) {
        var message = fallbackMessage || 'Something went wrong.';

        if (xhr.responseJSON) {
            if (xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }

            if (xhr.responseJSON.errors) {
                message = Object.values(xhr.responseJSON.errors).flat().join('\n');
            }
        }

        alert(message);
        $('#loader').addClass('d-none');
    }

    function dismissDashboardToast($toast) {
        if (!$toast || !$toast.length) {
            return;
        }

        $toast.addClass('is-hiding');
        setTimeout(function () {
            $toast.remove();
        }, 280);
    }

    function bindDashboardToast($toast) {
        if (!$toast || !$toast.length || $toast.data('toast-bound')) {
            return;
        }

        $toast.data('toast-bound', true);

        $toast.on('click', '[data-dismiss-toast]', function () {
            dismissDashboardToast($toast);
        });

        $toast.on('click', function (e) {
            if (e.target === $toast[0]) {
                dismissDashboardToast($toast);
            }
        });

        if (!$toast.find('#response_True').length) {
            setTimeout(function () {
                dismissDashboardToast($toast);
            }, 3500);
        }
    }

    function showDashboardToast(html, $container) {
        var $target = $container && $container.length ? $container : $('body');
        $target.append(html);
        bindDashboardToast($('#success, #Failed, #ask_Modal').last());
    }

    class ajaxRequest {
        static dahsboard_Home() {
            $.ajax({
                type: "POST",
                url: "/dashHome",
                data: {
                    dashData: "load_Data",
                    _token: "{{ csrf_token() }}",
                    value: "NewPost",
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.Data);
                    initPostFormFields();
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Fetch_All_Posts() {
            $.ajax({
                type: "POST",
                url: "/userDashboard/myPosts",
                data: { load_Data: "load_Data", _token: "{{ csrf_token() }}" },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.all_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Search_Posts(val) {
            $.ajax({
                type: "POST",
                url: "/userDashboard/search",
                data: {
                    load_Data: "load_Data",
                    value: val,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#ajax_Fetch_Data").html(data.search_Data);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Delete_Posts(valueUserId) {
            $.ajax({
                type: "POST",
                url: "/posts/" + valueUserId + "/destroy",
                data: {
                    dashData: "delete_Data",
                    _token: "{{ csrf_token() }}",
                    value: "EditPost",
                    id: valueUserId,
                },
                dataType: "json",
                success: function (data) {
                    console.log(data.success);
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }
        static dahsboard_New_Post() {
            $.ajax({
                type: "POST",
                url: "{{ route('user.DashNew') }}",
                data: {
                    dashData: "load_Data",
                    _token: "{{ csrf_token() }}",
                    value: "NewPost",
                },
                dataType: "json",
                success: function (data) {
                    $("#ajax_Fetch_Data").html(data.Data);
                    initPostFormFields();
                },
                error: function (error) {
                    dashboardShowError(error, 'Could not open the new post form.');
                },
            });
        }

        static dahsboard_Total_Likes() {
            $.ajax({
                type: "POST",
                url: "{{ route('user.DashboardDataPost', ['action' => 'totalLikes']) }}",
                data: {
                    load_Data: "load_Data",
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function (data) {
                    $("#ajax_Fetch_Data").html(data.likes_Data);
                },
                error: function (error) {
                    dashboardShowError(error, 'Could not load likes data.');
                },
            });
        }

        static dahsboard_Store(inputData) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "{{ route('user.DashStore') }}",
                data: inputData,
                processData: false,
                contentType: false,
                success: function (data) {
                    showDashboardToast(data.responseAlert, $('#dash_Area'));
                },
                error: function (error) {
                    dashboardShowError(error, 'Could not create the post.');
                },
            });
        }

        static dahsboard_Edit_View(valueUserId) {
            $.ajax({
                type: "POST",
                url: "/posts/" + valueUserId + "/edit",
                data: {
                    dashData: "load_Data",
                    _token: "{{ csrf_token() }}",
                    value: "EditPost",
                    id: valueUserId,
                },
                dataType: "json",
                success: function (data) {
                    console.log(true);
                    $("#ajax_Fetch_Data").html(data.Edit_Data);
                    initPostFormFields();
                },
                error: function (error) {
                    console.log(error.responseText);
                    console.log("error");
                },
            });
        }

        static dahsboard_Update_Post(inputData,post_id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "{{ url('posts') }}/" + post_id + "/update",
                data: inputData,
                processData: false,
                contentType: false,
                success: function (data) {
                    showDashboardToast(data.responseAlert, $('#body_Content_Dashboard'));
                },
                error: function (error) {
                    dashboardShowError(error, 'Could not update the post.');
                },
            });
        }

        static dahsboard_Loader(){
            $(document).on({
              ajaxStop: function() { 
                $('#loader').delay(200).fadeOut( function () {
                    $(this).addClass('d-none');
                })
            }    
            });
        }
    }

    // dahsboard_NavLink_Active
        $(document).ready(function() {
            $(".sidanav_link").first().addClass("active");
            $(".sidanav_link").click(function () {
            $(".sidanav_link").removeClass("active");
                $(this).addClass("active");   
                $('#loader').removeClass('d-none')
            });

            $(document).on("click", "#toggleEdit", function () {
                $('#loader').removeClass('d-none');
            });
        });

        $(document).ready(function() {
            $(".dropdown-item").click(function () {
            $(".dropdown-item").removeClass("active");
            $(this).addClass("active");   
            $('#loader').removeClass('d-none')
            });
        });

    $(document).ready(function () {
        initPostFormFields();

        // DASHBOARD HOME
        $(document).on("click", ".toggleDashboardHome", function (e) {
            e.preventDefault();
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Home();
        });

        // ALL POSTS
        $(document).on("click", ".toggleMyPost", function (e) {
            e.preventDefault();
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Fetch_All_Posts();
        });

        // TOTAL LIKES
        $(document).on("click", ".toggleTotalLikes", function (e) {
            e.preventDefault();
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Total_Likes();
        });

        // SEARCH POST
        $("#toggleSearchPost").click(function (e) {
            e.preventDefault();
            var val = $("#serach_String").val();
            if(val == ''){
                alert('Please Write The Post Title !')
                return
            }
            $(document).on({
              ajaxStart: function() { 
                $('#loader').removeClass('d-none');
              }
            });
            ajaxRequest.dahsboard_Loader();
            console.log("Search");
            ajaxRequest.dahsboard_Search_Posts(val);
        });

        // SELECT ALL VIA CHECKBOX //
        $(document).on("click", "#check_All", function () {
            if ($("#check_All").is(":checked")) {
                var checkValue = true;
                console.log(checkValue);
                $(".check_One").prop("checked", true);
            } else {
                var checkValue = false;
                console.log(checkValue);
                $(".check_One").prop("checked", false);
            }
        });

        // DELETE
        $(document).on("click", ".delete_This_Post", function (e) {
            e.preventDefault();
            var valueUserId = $(this).closest("tr").attr("data-id");
            $(this).closest("tr").remove();
            console.log("Delete");
            ajaxRequest.dahsboard_Delete_Posts(valueUserId);
        });



        // NEW AND STORE
        $(document).on("click", ".toggleNewPost", function (e) {
            e.preventDefault();
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_New_Post();
        });

        $(document).on("submit", ".postsFormNew", function (event) {
            event.preventDefault();
            syncRichTextEditor();
            syncTagsField();

            if (!$("#category_Menu").val()) {
                alert('Please select a category.');
                return;
            }

            let inputData = new FormData($("#posts_Form_New")[0]);
            inputData.set('tags', getTagsCommaValue());
            inputData.append("requestType", "New");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Store(inputData);
            setTimeout(function() {
                ajaxRequest.dahsboard_Fetch_All_Posts();
                $('#toggleMyPost').addClass("active");
            }, 1000);
        });

        // EDIT AND UPDATE
        $(document).on("click", ".edit_This_Post", function (e) {
            e.preventDefault();
            console.log("Edit");
            var valueUserId = $(this).closest("tr").attr("data-id");
            console.log(valueUserId);
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Edit_View(valueUserId);
        });

        $(document).on("submit", ".postsFormUpdate", function (event) {
            event.preventDefault();
            syncRichTextEditor();
            syncTagsField();
            var formUpdate = {
                category_Menu: $("#category_Menu").val(),
                title: $("#title").val(),
                content: $("#content").val(),
                users_id: $("#users_id").val(),
                post_id: $("#posts_Form_Update").attr("data-id"),
            };
            var file = $("#upload").prop("files")[0];
            let inputData = new FormData($("#posts_Form_Update")[0]);
            inputData.set('tags', getTagsCommaValue());
            inputData.append(
                "posts_id",
                $("#posts_Form_Update").attr("data-id")
            );
            inputData.append("requestType", "Update");
            ajaxRequest.dahsboard_Loader();
            ajaxRequest.dahsboard_Update_Post(inputData,formUpdate.post_id);
            setTimeout(function() {
                ajaxRequest.dahsboard_Fetch_All_Posts();
                $('#toggleMyPost').addClass("active");   
            }, 1000);
            
        });
    });
</script>
