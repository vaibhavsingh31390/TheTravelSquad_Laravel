<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){

        DB::connection()->enableQueryLog();

        $CAT = Category::all()->keyBy('category_Menu');
        // $CAT = (array) $catObject;
        return view('index')->with('CAT' , $CAT);
    }
}
