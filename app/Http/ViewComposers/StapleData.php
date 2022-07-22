<?php 

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class StapleData {
    public function compose(View $view){
        $authenticated_User = Auth::user();
        $category =   Category::pluck('category_Menu');
        $user = User::all();
        $view->with('authenticated_User', $authenticated_User)->with('category', $category)->with('user', $user);
    }
}