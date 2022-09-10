<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AjaxData;
use App\Services\UserAction;
use App\Services\UserComments;

class AjaxController extends Controller
{
    private $ajaxData;
    private $userAction;
    private $userComments;
    public function __construct(AjaxData $ajaxData, UserAction $userAction, UserComments $userComments)
    {
        $this->ajaxData = $ajaxData;
        $this->userAction = $userAction;
        $this->userComments = $userComments;
    }

    //Index Page LoadMore Data
    public function loadMoreData()
    {
        return $this->ajaxData->Load_More_Data_On_Click();
    }

    public function loadMoreDataOnScroll()
    {
        return $this->ajaxData->Load_More_Data_On_Scroll();
    }

    //Action Like, Dislike 
    public function incrementDecrement()
    {
        return $this->userAction->User_Take_Action();
    }

    //Comments Post And Fetch
    public function commentsSave()
    {
        return $this->userComments->Comments_Post();
    }
}
