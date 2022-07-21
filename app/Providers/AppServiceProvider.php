<?php

namespace App\Providers;

use App\Http\ViewComposers\StapleData;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::aliasComponent('components.postCard', 'postCard');
        Blade::aliasComponent('components.singlePost', 'singlePost');
        Blade::aliasComponent('components.comments', 'comments');
        Blade::aliasComponent('components.errors', 'errors');
        Blade::aliasComponent('components.dashboard.dashSideNav', 'sideNav');
        Blade::aliasComponent('components.dashboard.dashTopNav', 'topNav');
        Blade::aliasComponent('components.dashboard.dashHome', 'dashHome');
        Blade::aliasComponent('components.dashboard.dashTableData', 'dashTable');
        Blade::aliasComponent('components.dashboard.dashTableSearch', 'dashSearchData');
        Blade::aliasComponent('components.dashboard.dashNewPost', 'dashNewPost');
        Blade::aliasComponent('components.dashboard.dashEditPost', 'dashEditPost');
        Blade::aliasComponent('components.alert', 'alertNodal');
        view()->composer(['*'], StapleData::class);
    }
}
