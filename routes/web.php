<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/make-me-admin', function () {
    if (auth()->check()) {
        $user = auth()->user();
        $user->role = 'admin';
        $user->save();
        return 'لقد أصبحت مسؤولاً الآن! يمكنك زيارة <a href="/admin/dashboard">لوحة التحكم من هنا</a>';
    }
    return 'يجب تسجيل الدخول أولاً.';
});

Route::get('/migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);

        return 'Migrations ran successfully: '.\Illuminate\Support\Facades\Artisan::output();
    } catch (\Exception $e) {
        return 'Error: '.$e->getMessage();
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/experience', [\App\Http\Controllers\ExperienceController::class, 'store'])->name('experience.store');
    Route::delete('/experience/{experience}', [\App\Http\Controllers\ExperienceController::class, 'destroy'])->name('experience.destroy');

    Route::post('/education', [\App\Http\Controllers\EducationController::class, 'store'])->name('education.store');
    Route::delete('/education/{education}', [\App\Http\Controllers\EducationController::class, 'destroy'])->name('education.destroy');
});

// Storage fallback for environments without symlink support
Route::get('/storage/{path}', [\App\Http\Controllers\StorageController::class, 'show'])->where('path', '.*');

// Job Management for Employers
Route::middleware(['auth'])->group(function () {
    Route::get('jobs/search', [\App\Http\Controllers\JobListingController::class, 'search'])->name('jobs.search');
    Route::resource('jobs', \App\Http\Controllers\JobListingController::class);
    Route::get('jobs/{job}/applicants', [\App\Http\Controllers\JobListingController::class, 'applicants'])->name('jobs.applicants');

    // Application routes
    Route::post('jobs/{job}/apply', [\App\Http\Controllers\JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('my-applications', [\App\Http\Controllers\JobApplicationController::class, 'myApplications'])->name('applications.index');
    Route::patch('applications/{application}/status', [\App\Http\Controllers\JobApplicationController::class, 'updateStatus'])->name('applications.status');

    // Saved Jobs
    Route::get('saved-jobs', [\App\Http\Controllers\SavedJobController::class, 'index'])->name('jobs.saved');
    Route::post('jobs/{job}/save', [\App\Http\Controllers\SavedJobController::class, 'store'])->name('jobs.save');
    Route::delete('jobs/{job}/save', [\App\Http\Controllers\SavedJobController::class, 'destroy'])->name('jobs.unsave');

    // Employer Profiles
    Route::get('employer/analytics', [\App\Http\Controllers\JobListingController::class, 'analytics'])->name('employer.analytics');
    Route::get('employer/{user}', [\App\Http\Controllers\JobListingController::class, 'employerProfile'])->name('employer.profile');
    Route::post('/companies/{company}/reviews', [\App\Http\Controllers\CompanyReviewController::class, 'store'])->name('companies.reviews.store');
    Route::post('/reviews/{review}/reply', [\App\Http\Controllers\CompanyReviewController::class, 'reply'])->name('reviews.reply');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
        Route::get('/users/{user}/edit', [\App\Http\Controllers\AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
        
        Route::get('/jobs', [\App\Http\Controllers\AdminController::class, 'jobs'])->name('jobs');
        Route::delete('/jobs/{job}', [\App\Http\Controllers\AdminController::class, 'deleteJob'])->name('jobs.delete');
        Route::post('/jobs/{job}/toggle', [\App\Http\Controllers\AdminController::class, 'toggleJobStatus'])->name('jobs.toggle');
        Route::get('/reviews', [\App\Http\Controllers\AdminController::class, 'reviews'])->name('reviews');
        Route::get('/activity-logs', [\App\Http\Controllers\ActivityLogsController::class, 'index'])->name('activity-logs');
    });
});

// AI Assistant (Public)
Route::post('/ai/chat', App\Http\Controllers\ChatController::class)->name('ai.chat');
Route::get('/ai-assistant', function () {
    return view('ai-chat.index');
})->name('ai.assistant');

require __DIR__.'/auth.php';

// CV Analyzer (Guest Accessible)
Route::get('/cv-analyzer', [App\Http\Controllers\CVAnalyzerController::class, 'index'])->name('cv-analyzer.index');
Route::post('/cv-analyzer/analyze', [App\Http\Controllers\CVAnalyzerController::class, 'analyze'])->name('cv-analyzer.analyze');



