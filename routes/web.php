<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorLoginController;
use App\Http\Controllers\AuthorRegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [FrontendController::class, 'welcome_front'])->name('index');
Route::get('/temp', [FrontendController::class, 'welcome']);
// ->name('author.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// User
Route::get('/profile', [UserController::class, 'profile'])->name('admin.profile');
Route::get('/edit', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/update', [UserController::class, 'update_profile'])->name('update.profile');
Route::get('/list', [UserController::class, 'user_list'])->name('user.list');
Route::post('/password/update', [UserController::class, 'password_update'])->name('password.update');
Route::get('/delete/user{id}', [UserController::class, 'delete_user'])->name('delete.user');

// Categories
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete{id}', [CategoryController::class, 'delete_category'])->name('delete.category');
Route::get('/trash', [CategoryController::class, 'category_trash'])->name('category.trash');
Route::get('/delete{id}', [CategoryController::class, 'permanent_delete_category'])->name('permanent.delete.category');
Route::get('/restore{id}', [CategoryController::class, 'restore_category'])->name('restore.category');
Route::post('/multi_delete', [CategoryController::class, 'checked_delete'])->name('checked.delete');
Route::post('/checked_cat_action', [CategoryController::class, 'checked_cat_action'])->name('checked.cat.action');

// Tags
Route::get('/tag', [TagController::class, 'tag'])->name('tag');
Route::post('/tag_store', [TagController::class, 'tag_store'])->name('tag.store');
Route::get('/tag_delete{id}', [TagController::class, 'tag_delete'])->name('tag.delete');
Route::get('/tag_trash', [TagController::class, 'tag_trash'])->name('tag.trash');
Route::get('/tag_fdelete{id}', [TagController::class, 'permanent_delete_tag'])->name('permanent.delete.tag');
Route::get('/tag_restore{id}', [TagController::class, 'restore_tag'])->name('restore.tag');
Route::post('/multi_tag_action', [TagController::class, 'checked_tag_action'])->name('checked.tag.action');
Route::post('/multi_trash', [TagController::class, 'checked_trash'])->name('checked.trash');

// Frontend
Route::get('/auth_login', [FrontendController::class, 'author_login'])->name('author.login');
Route::get('/reg', [FrontendController::class, 'author_reg'])->name('author.reg');
Route::get('/blog/details/{slug}', [FrontendController::class, 'blog_details'])->name('blog.details');
Route::get('/category/blog/{id}', [FrontendController::class, 'category_blog'])->name('category.blog');
Route::get('/author/blog/{id}', [FrontendController::class, 'author_blog'])->name('author.blog');
Route::get('/all_blogs', [FrontendController::class, 'all_blogs'])->name('all.blogs');
Route::get('all/author/list', [FrontendController::class, 'all_author_list'])->name('all.author.list');
Route::get('tag/blog/{id}', [FrontendController::class, 'tag_blog'])->name('tag.blog');

// Author Reg
Route::post('/registration', [AuthorRegistrationController::class, 'author_registration_store'])->name('author.registration.store');
Route::get('/mail/verify/{token}', [AuthorRegistrationController::class, 'mail_verify'])->name('mail.verify');

// Author Login
Route::post('/login_confirm', [AuthorLoginController::class, 'login_confirm'])->name('login.confirm');

// Author
Route::get('/my_profile', [AuthorController::class, 'my_profile'])->name('my.profile');
Route::get('/my_edit_profile', [AuthorController::class, 'author_edit_profile'])->name('author.edit.profile');
Route::post('/my_profile_update', [AuthorController::class, 'author_profile_update'])->name('author.profile.update');
Route::get('/become_auth', [AuthorController::class, 'become_author'])->name('become.author');
Route::post('/author_req_store', [AuthorController::class, 'author_req_store'])->name('author.req.store');
Route::get('/author_logout', [AuthorController::class, 'author_logout'])->name('author.logout');


// Home
Route::get('/auth_req', [HomeController::class, 'auth_req'])->name('auth.req');
Route::get('/auth_list', [HomeController::class, 'auth_list'])->name('auth.list');
Route::get('/auth_req_accept{id}', [HomeController::class, 'auth_req_accept'])->name('auth.req.accept');
Route::get('/auth_deactive{id}', [HomeController::class, 'auth_deactive'])->name('auth.deactive');
Route::get('/auth_req_dele{id}', [HomeController::class, 'auth_req_delete'])->name('auth.req.delete');
Route::get('/auth_del{id}', [HomeController::class, 'auth_del'])->name('auth.del');
Route::post('/author_social_store', [HomeController::class, 'author_social_store'])->name('author.social.store');

// Post
Route::get('/add_post', [PostController::class, 'add_post'])->name('add.post');
Route::post('/post_store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/post_list', [PostController::class, 'post_list'])->name('post.list');
Route::get('/status_change{id}', [PostController::class, 'status_change'])->name('status.change');
Route::get('/post_delete{id}', [PostController::class, 'post_delete'])->name('post.delete');

// Subscribe
Route::post('/subs_store', [SubscribeController::class, 'subs_store'])->name('subs.store');
Route::get('/subscribers', [SubscribeController::class, 'subscribers'])->name('subscribers');
Route::get('/subscribers_delete{id}', [SubscribeController::class, 'subs_delete'])->name('subs.delete');
Route::get('/subscribers_mail{id}', [SubscribeController::class, 'send_mail'])->name('send.mail');

// Social
Route::get('/social', [SocialController::class, 'social'])->name('social');
Route::post('/social_store', [SocialController::class, 'social_store'])->name('social.store');
Route::get('/social_status_change{id}', [SocialController::class, 'social_status_change'])->name('social.status.change');
Route::get('/social_delete{id}', [SocialController::class, 'social_delete'])->name('social.delete');

//Comments
Route::post('/comments/store', [CommentsController::class, 'comments_store'])->name('comments.store');

//Search
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Password Reset
Route::get('/password/reset/req', [PasswordResetController::class, 'pass_reset_controller'])->name('pass.reset.req');
Route::post('/reset/req/send', [PasswordResetController::class, 'reset_req_send'])->name('reset.req.send');
Route::get('/reset/form/{token}', [PasswordResetController::class, 'reset_form'])->name('reset.form');
Route::post('/reset/confirm/{token}', [PasswordResetController::class, 'pass_reset_confirm'])->name('pass.reset.confirm');

// Role Manager
Route::get('/role_manager', [RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/role/delete{id}', [RoleController::class, 'role_delete'])->name('role.delete');
Route::get('/remove/role/user{id}', [RoleController::class, 'remove_role_user'])->name('remove.role.user');

// GitHub Login
Route::get('/github/redirect', [GithubController::class, 'githaub_redirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'github_callback'])->name('github.callback');

// GitHub Login
Route::get('/google/redirect', [GoogleController::class, 'google_redirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');
