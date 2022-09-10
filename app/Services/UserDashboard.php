<?php

namespace App\Services;

use Illuminate\Http\Request;

class userDashboard{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}