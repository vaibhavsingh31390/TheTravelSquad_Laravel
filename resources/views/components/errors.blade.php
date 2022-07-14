@if ($errors->any())
<div class="mb-2 mt-2">
    @foreach ($errors->all() as $error)
            <div class="alert alert-danger p-2">
                {{ $error }}
            </div>
    @endforeach
</div>
@endif