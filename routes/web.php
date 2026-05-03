<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\HomepageSettingController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/pengalaman', [HomeController::class, 'experiencePage'])->name('experience.index');
Route::get('/pendidikan', [HomeController::class, 'educationPage'])->name('education.index');
Route::get('/project-unggulan', [HomeController::class, 'projectsPage'])->name('projects.index');
Route::get('/kontak', [HomeController::class, 'contactPage'])->name('contact.index');
Route::get('/tentang', [HomeController::class, 'aboutPage'])->name('about.index');
Route::get('/layanan', [HomeController::class, 'servicesPage'])->name('services.index');

Route::post('/review', [ReviewController::class, 'submit'])->name('review.submit');

Route::get('/dashboard', function () {
    if (! auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/homepage', [HomepageSettingController::class, 'edit'])->name('homepage.edit');
    Route::put('/homepage', [HomepageSettingController::class, 'update'])->name('homepage.update');

    Route::resource('experiences', ExperienceController::class)->except(['show']);
    Route::resource('educations', EducationController::class)->except(['show']);
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'update', 'destroy']);
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
});
