<?php

namespace App\Http\Controllers;

use App\Services\Pages;
use App\Services\userDashboard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $userDashboard;
    private $pages;
    public function __construct(userDashboard $userDashboard, Pages $pages)
    {
        $this->userDashboard = $userDashboard;
        $this->pages = $pages;
    }

    public function index()
    {
        return $this->pages->indexPage_User();
    }

    public function category($category)
    {
        return $this->pages->posts_Category($category);
    }

    public function userDash()
    {
        return $this->userDashboard->home_Post();
    }

    public function userDashData()
    {
        return $this->userDashboard->post_Data_Search();
    }

    public function test()
    {
        return view('test')->with(['test' => 'success']);
    }
}
