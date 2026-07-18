<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Http\Requests\UploadEditorImageRequest;
use App\Services\Pages;
use App\Services\PostEditor;
use App\Services\TagSearch;
use App\Services\UserDashboard;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $userDashboard;

    private $pages;

    private $postEditor;

    private $tagSearch;

    public function __construct(
        UserDashboard $userDashboard,
        Pages $pages,
        PostEditor $postEditor,
        TagSearch $tagSearch
    ) {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy', 'uploadEditorImage', 'searchTags']);
        $this->userDashboard = $userDashboard;
        $this->pages = $pages;
        $this->postEditor = $postEditor;
        $this->tagSearch = $tagSearch;
    }

    public function index()
    {
        return $this->pages->posts_All();
    }

    public function create()
    {
        return $this->userDashboard->create_Post();
    }

    public function store(StorePost $request)
    {
        return $this->userDashboard->store_Post($request);
    }

    public function show($id)
    {
        return $this->pages->showPost_User($id);
    }

    public function edit($id)
    {
        return $this->userDashboard->edit_Post($id);
    }

    public function update(StorePost $request, $id)
    {
        return $this->userDashboard->update_Post($request, $id);
    }

    public function destroy($id)
    {
        return $this->userDashboard->destroy_Post($id);
    }

    public function uploadEditorImage(UploadEditorImageRequest $request)
    {
        return $this->postEditor->upload_Image($request);
    }

    public function searchTags(Request $request)
    {
        return response()->json(
            collect($this->tagSearch->suggest($request->query('q'), 12))
                ->map(fn (string $name) => ['value' => $name])
                ->values()
                ->all()
        );
    }
}
