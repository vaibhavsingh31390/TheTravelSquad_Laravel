<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use App\Http\Requests\StorePost;
use App\Services\Pages;
use App\Services\UserDashboard;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    private $userDashboard;
    private $pages;
    public function __construct(userDashboard $userDashboard, Pages $pages)
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->userDashboard = $userDashboard;
        $this->pages = $pages;
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
        // return redirect()->route('user.Dashboard', ['action' => 'myPosts']);
    }
}
