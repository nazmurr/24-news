<?php

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* next day work points
- add post status pending, publish (done)
- add commenting system (submit commment from website, edit/delete/show comments in dashboard, publish/unpublish comment as admin)
- add button in dashboard header to go to website (done)
- add nav menu support in dashboard so in website navigation can be configured from dashboard
- add pagination for users list page in dashboard (done)
- fix dashboard homepage
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/blog', function () {
    return view('posts.index');
});

Route::get('/single', function () {
    return view('posts.single');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::resources(['/admin/posts' => 'AdminPostsController']);
    Route::get('/admin/users/me', 'AdminUsersController@me')->name('users.me');
    Route::patch('/admin/users/update-my-profile', 'AdminUsersController@updateMyProfile')->name('users.updatemyprofile');
});

Route::group(['middleware' => ['admin']], function() {
    Route::resources(['/admin/users' => 'AdminUsersController']);
    Route::resources(['/admin/categories' => 'AdminCategoriesController']);
    Route::get('/admin/settings', 'SettingsController@index')->name('settings');
    Route::post('/admin/settings', 'SettingsController@update')->name('settings.update');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts/{slug}', 'PostController@show')->name('post');
Route::get('/authors/{id}', 'AuthorController@show')->name('author');
Route::get('/categories/{slug}', 'CategoryController@show')->name('category');
Route::post('/search', 'SearchController@search')->name('search');

Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');

Route::get('/about', function() {
    return view('pages.about');
})->name('about');

Route::post('/submit-contactform', function(Request $request) {
    try {
        Mail::to("nazmur.r@gmail.com")->send(new ContactForm($request));
        Session::flash('flash_contact_submit_success', 'Contact form submitted successfully!');
        return redirect()->back();
    } catch (Exception $e) {
        $errorMessage = '';
        if( count(Mail::failures()) > 0 ) {
            $errorMessage .= "There was one or more failures. They were: <br />";
            foreach(Mail::failures() as $email_address) {
                $errorMessage .= " - $email_address <br />";
            }
        } else {
            $errorMessage .= $e->getMessage();
        }
        Session::flash('flash_contact_submit_error', $errorMessage);
        return redirect()->back();
    }
});
