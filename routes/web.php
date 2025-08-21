<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStatusController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Test route
Route::get('/test', function() {
    return 'Test route working!';
});

// Test route without database
Route::get('/testdb', function() {
    try {
        $dbPath = database_path('database.sqlite');
        if (file_exists($dbPath)) {
            DB::connection();
            return 'Database connection working! Path: ' . $dbPath;
        } else {
            return 'Database file not found at: ' . $dbPath;
        }
    } catch (Exception $e) {
        return 'Database error: ' . $e->getMessage();
    }
});

// Simple login route without middleware
Route::get('/simple-login', function() {
    return view('simple-login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Project Import temporarily disabled due to compatibility issues

    // Projects (resource route va después)
    Route::resource('projects', ProjectController::class);

    // Data Import (legacy - for existing project data)
    Route::get('/projects/{project}/import', [DataImportController::class, 'create'])->name('data-import.create');
    Route::post('/projects/{project}/import', [DataImportController::class, 'store'])->name('data-import.store');

    // Project Status Management
    Route::get('/projects/{project}/status/pending-activation', [ProjectStatusController::class, 'showPendingActivation'])->name('projects.status.pending-activation');
    Route::post('/projects/{project}/status/pending-activation', [ProjectStatusController::class, 'updateToPendingActivation'])->name('projects.status.update-pending-activation');
    
    Route::get('/projects/{project}/status/document-returned', [ProjectStatusController::class, 'showDocumentReturned'])->name('projects.status.document-returned');
    Route::post('/projects/{project}/status/document-returned', [ProjectStatusController::class, 'updateToDocumentReturned'])->name('projects.status.update-document-returned');
    
    Route::get('/projects/{project}/status/development', [ProjectStatusController::class, 'showDevelopment'])->name('projects.status.development');
    Route::post('/projects/{project}/status/development', [ProjectStatusController::class, 'updateToDevelopment'])->name('projects.status.update-development');
    
    Route::get('/projects/{project}/status/production', [ProjectStatusController::class, 'showProduction'])->name('projects.status.production');
    Route::post('/projects/{project}/status/production', [ProjectStatusController::class, 'updateToProduction'])->name('projects.status.update-production');
});
