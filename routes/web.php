<?php

use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Education\EducationController;
use App\Http\Controllers\Admin\Prestation\PrestationController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Project\ProjectController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\WorkExperience\WorkExperienceController;
use App\Http\Controllers\Common\CkeditorController;
use Illuminate\Support\Facades\Route;

Route::get('sudut-panel/admin/login', [AuthController::class, 'viewLogin'])->name('admin.login');
Route::post('sudut-panel/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::get('sudut-panel/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware([
    \App\Http\Middleware\AdminMiddleware::class
])->name('admin.')->prefix('sudut-panel/admin')->group(function () {
    Route::get('dashboard', function () {
        return view('pages.test');
    })->name('dashboard');
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting', [SettingController::class, 'update'])->name('setting.update');
    Route::resource('prestation', PrestationController::class);
    Route::post('common/ckeditor/upload',[CkeditorController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('work-experience', WorkExperienceController::class);
    Route::resource('education', EducationController::class);
    Route::group([
        'prefix' => 'user',
        'as' => 'profile.',
    ], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/', [ProfileController::class, 'update'])->name('update');
    });
    Route::resource('artikel', ArtikelController::class);
    Route::resource('project', ProjectController::class);
});

Route::get('/', function () {
    $educations = \App\Models\Education::query()->orderBy('order', 'asc')->get();
    $prestations = \App\Models\Prestation::query()->orderBy('created_at', 'asc')->get();
    $workExperiences = \App\Models\WorkExperience::query()->orderBy('start_date', 'asc')->get();
    $projects = \App\Models\Project::query()->orderBy('created_at', 'asc')->get();
    $articles = \App\Models\Artikel::query()->orderBy('created_at', 'desc')->limit(4)->get();
    return view('pages.user.index', compact('educations', 'prestations', 'workExperiences', 'projects', 'articles'));
})->name('home');

Route::get('prestations/{slug}', [\App\Http\Controllers\User\Prestation\PrestationController::class, 'show'])->name('prestations.show');
Route::get('projects/{slug}', [\App\Http\Controllers\User\Project\ProjectController::class, 'show'])->name('projects.show');
Route::get('artikel', [\App\Http\Controllers\User\Artikel\ArtikelController::class, 'index'])->name('artikel.index');
Route::get('artikel/{slug}', [\App\Http\Controllers\User\Artikel\ArtikelController::class, 'show'])->name('artikel.show');
