## Reason To Learn

> So I can grow myself as the way I planned to.
> Learing things like these are kind of stairs for me to reach my goal.
> My goal is to become a sound professional in my field.
> I want to learn things in a way that helps the people around me (professional && personal).
> I am a slow learner but I want to learn this slowley but perfectly. 

# Learnt So far 

> Installed Composer

> Ran Command To intall Laravel ver.9

> Went through the content on laravel stack.

> Read about MVC (Model = Database, View = Resources->views->BLADE TEMPLATES & Controller = app->Http->Controllers).

> Added some Routes in the training Laravel project.

> Added use of constraints & derivative. In web.php(for constarints -> Later Migrated to RouteServiceProvider.php) and 
  use of @syntax (directives) of laravel in Blade Templates.

> Naming Routes, grouping routes and passing data in URI of routes (both required as well as not required ie. 'xyz/{test?}')

> Using variables or datasets(arrays,JSON) inside routes by using use keyword.

> Added logic to Blade templates by using @if/@else, @foreach, @forelse/@empty.

> Added support for partials templates for distributing logical code to another place and using it many times.

> Added $loop inside @foreach loops to add further logic in how we show our data.

> Read and learnt about Http response codes and what the major code represnt (200, 201, 301, 302, 304, 400, 401, 402, 403, 404 & 500).

> Added Predefined Function Request inside Routes to show the response code corresponding to the request 
  parameters('content', respose code).

> Added Predefined Function redirect(), back(), redirect()->away(), redirect()->route('routeName').

> Learnt sending JSOn through response(). ie: response()->json($json).

> Added download request through response->download(public_path('path'), 'filename.jpg').

> Learnt how to use controllers and moved the logical part to app/http/controllers via php artisan make:controllers cmd.

> Modifed the old Routes to work with controller syntax moved to its xyzController.php file.
  (ie. Route::get('uri',[controllerName::Class, 'name of method']).

> Learnt about linking the Database to the Laravel project via .env file.

> Connected Database via env file.

> Read about Models & Migartions().

> Created a new model with the name of BlogPost (with migration as well via php artisan make:model -m).

> Learnt about new ways to launch DB query via raw query, query builder & Eloquent(tinker).

> Learnt about 2 ways to target Models in tinker (Static methods & Instance methods) 
  example :- $post = new BlogPost(); && BlogPost::Find().

> Linked BlogPost model to PostController and replaced predefinded function abort_if() with query Builder function findOrFail();

> Added form to input data that saves in the model (DB). 

> Learnt about CSRF (cross site request forgery) and how to implement the csrf token into the form using @csrf derivative.

> Added validation to the form via targeting $request and using validation() static function & displaying errors via 
  @error derivative or using ->any() function on $error and for each loop to display all() errors.

> Transfered the vakidation logic to a seperate request class by making one via php artisan make:request xyz.

> Used old helper function to keep the inputed data if the validation stops form to sumbit invalid data.

> Replaced native storing method by create() static method by adding $fillable in the model.

> Created Routes for Edit And Delete operation while writing code in the controller ie. fill() & save().

> Started laravel MIX via node install and installed bootstrap by following command composer require laravel/ui,  
php artisan ui bootstrap.

> Intalled authentication controllers via php artisan ui:controllers.

> Linked asses via @asset derivative.

> Learn how to add version to the assests when ever they are complied via mix.version() function.

> Added styles to the elemets of the views like form and nav-bar etc via boottsrap classes and learnt about SCSS styling syntax.

> Started automated testing via laravel tests feature which categorize it into 2 type UNIT and FEATURES.

> To run the test we use commad ./vendor/bin/phpunit and if everything is fine we get 0 Failures.

> The flow os test will be arrange->act->assert.

> Started testing Database and mofified DB_CONNECTION variable in phpunit.xml file and added the 
  new database(local) to the config/database.php.

> To clear Config Cache used php artisan config:clear that clears the config cache.

> Created a HomeTest.php file in test/feature to test weather the page containes perticular string or now, with the use of adding helper function on $response->assertSeeText('String to search');

> Learnt about relation between eloquent (belongsTo, hasOne, HasMany).

> Learnt about loading ways (Lazy & Eager) via querying data with and without relations.

> Learnt about factory class and how to produceddummy data for models (php artisan make:factory zyz --model=modelName).

> Diffrent ways of using factory in tinker (For Normal/Defination method => BlogPost::factory()->create())
  (For State methid => BlogPost::factory()->count(5)->suspended()->create())

> Using model factory to fake data with models having reltions ie. Author has 1 profile {Author::factory()->has(Profile::factory()->count(1))->create();} or {Author::factory()->hasProfile(1)->create();} or {Profile::factory()->for(Author::factory())->create();  only applicable for one to one relation, count method should be used for one to many relation}

> Using Auth service (Auth Controllers and traits of auth-backend) by using php artisan ui:controllers we add the auth backend dependencies. Explored all controllers for authenticate users.

> Made register form and added validation classes to the field with respects to use of ternary operators for true/false.

> Modified the default route(redirectTo) for logged in or authenticated user to home page.

> Made login form and blade template and added support to remember the user via saving session to cookie.

> Used @guest directives to modify end action points to login or logout depnding on state (logged in. Not logged In).

> Using Auth Facades in Home:controller to check if the person is authentic or not (Auth::id(returns id os user)/user(retuns object with user info)/check(returns true or false))

> To protect a page from being accessed without logging in we can use middleware method with the route defined in web.php ie. Route::get('/', [HomeController::class, 'home'])->middleware('auth')->name('home.index');.

> Adding middleware as public function __contructor(){ $this->middleware()->only(['login','register']);} inside any controller to provide authetic check to access.

> Learnt about seeder and make custom seeder to push demo data into the database in all tables made during migartions with php artisan migrate refresh --seed and using composer dump-autoload or to just seed a perticulat class we used 
php artisan db::seed --class=UserTableSeeder.

> Learnt About Gates and added is_Admin Column to user table to overide some Gates incase the user is admin.

> Learnt About Policy and made policy with respect to our Posts model (make:policy CrudModelPolicy --model=CrudModel) and implemented Update and delete Gate with respect to the policy inside AuthServiceProvider and posts Controller.

> Learnt diffrent way to use policy by making entry into protected $policies array and implementing inside posts Controller. 
(ie. $this->authorize('crudModel.delete', $Obj) becomes $this->authorize('delete', $Obj) or even as $this->authorize($Obj);

> Using policy in blade via using @can @canend and @cannot @cannotend directives ie. @can('update', $post) @canend  and if the policy verify it as authorized than only the part inside of the directive block will be visible.

> Setting user id to posts via using user method ($request->user()->id).

> Learnt global query scopes, we can do it by 2 ways 1 via closure ie. ordeyBy('columnName', 'desc') or else by defining namespace as Scopes and creating a php file that will contain the query scope method 
<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class latestScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy($model::CREATED_AT, 'desc');
    }

}.

and using  static::addGlobalScope(new latestScope) inside parent boot method to call it inside the model class.

> Learnt local query scopes by adding method inside model class, calling them with parent model class or by adding query method ahead of      relation method. ie. CrudModel::Latest()->withCount('comment')->get(), by using a closure like CrudModel::with(['comment' => function($query){return $query->Latest();}]) or by  public function comment(){ return $this->hasMany('App\Models\Comment')->Latest(); }

> modified all blog posts page to show most commented blog post and most posts by any users by adding local query scope 
  (
    public function scopeMostCommented(Builder $query){
          return $query->withCount('comment')->orderBy('comment_count', 'desc');
      }
  ).

> Learnt using Components and implementing aliasComponent into the AppServiceProvider.php to use an alias ie. badge as a directive name. And passing extra variables (slots) to componenets to substitue the conditions with instead giving variable values to show or not show component.

> Learnt Cache and Redis Basic setup to avoid qurying unwanted data everytime.

> Learnt using many to many relation by using belongsToMany on the models that can have a relation like that and associating the data using attach(links without even if duplicates being made), syncWithoutDetaching (does not create duplicate entry if already exist) and sync (keeps only the data provided and deletes the existing data if not present during sync) methods. 

> Learnt removing association using detach method to remove relation.

> Learnt accessing the data via both side and know about pivot (pivot table) and rename pivot via using as method on reltion method inside both related models.

> Implemented Many to many relation to show tags on post view and make route to show posts related to the tag.

> Learnt using view composer to make certain data always available for perticular view blade template or use @include to make set of data available in any view if the included view is listed inside AuthServiceProvider view()->composer() method. By using this statement one can make a set of data available for all views "view()->composer('*', ComposerClass::class)".

> Made data seed for Tags model.

> Added support for nested relationship into view model for solo post.

> Learning about File Storage and uploading.

> Using hasFile function to verify if submited form has file or not.

> Used file() method on $request to fetch the submitted file and than storing it in a $variable. To save the file using store()method which takes the location(folder name) as the argument for public disks type.  getClientMimeType() to get type of file and getClientOriginalExtension() to get extension of the file.

> Using Storage fascade to store files i.e Storage::disk('public')->put('thumbnail', $file) And using Storage::url($name) to get url of the uploaded file.;

> Learnt using one to one polymorphic relation.

> Learnt using one to many polymorphic relation.

