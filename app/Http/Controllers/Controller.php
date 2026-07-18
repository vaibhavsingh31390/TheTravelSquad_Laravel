<?php

namespace App\Http\Controllers;

use App\Services\Pages;
use App\Services\Sitemap;
use App\Services\UserDashboard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $userDashboard;

    private $pages;

    private $sitemap;

    public function __construct(UserDashboard $userDashboard, Pages $pages, Sitemap $sitemap)
    {
        $this->userDashboard = $userDashboard;
        $this->pages = $pages;
        $this->sitemap = $sitemap;
    }

    public function index()
    {
        return $this->pages->indexPage_User();
    }

    public function category($category)
    {
        return $this->pages->posts_Category($category);
    }

    public function tag($tag)
    {
        return $this->pages->posts_By_Tag($tag);
    }

    public function search()
    {
        return $this->pages->posts_Search();
    }

    public function about()
    {
        return $this->pages->about_Page();
    }

    public function contact()
    {
        return $this->pages->contact_Page();
    }

    public function privacy()
    {
        return $this->pages->privacy_Page();
    }

    public function terms()
    {
        return $this->pages->terms_Page();
    }

    public function sitemap()
    {
        return $this->sitemap->xml_Response();
    }

    public function userDash()
    {
        return $this->userDashboard->home_Post();
    }

    public function userDashData(?string $action = null)
    {
        if ($action === 'totalLikes') {
            return $this->userDashboard->total_Likes();
        }

        return $this->userDashboard->post_Data_Search();
    }

    public function test()
    {
        return $this->pages->test_Page();
    }
}
