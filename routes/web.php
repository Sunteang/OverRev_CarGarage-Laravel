<?php

use Illuminate\Support\Facades\Route;

// Use controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCarController;
use App\Http\Controllers\Admin\AdminRentalController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSaleController;
use App\Http\Controllers\Admin\AdminRepairController;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\CarController;
use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\TestimonialController;
use App\Http\Controllers\App\ProfileController;
use App\Http\Controllers\App\FavouriteController;

//============ Public Routes ============
// User Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/cars-collection', [CarController::class, 'index'])->name('cars-collection');

Route::get('/about', function () {
    return view('apps.about');
})->name('about');

Route::get('/contact', function () {
    return view('apps.contact');
})->name('contact');


// Logout can remain protected
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

//============ End of Public Route ============
//=============================================
//============ User Routes ====================

//=============================================
// User Authentication Routes
Route::prefix('user')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('user.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');

    Route::get('register', [AuthController::class, 'showRegister'])->name('user.register'); // optional
    Route::post('register', [AuthController::class, 'register']);
});

// Car listing page
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('show-detail');

//=============================================
// Testimonial submission
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');


//=============================================
// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

//=============================================
// Favourite Cars
Route::middleware(['auth'])->group(function () {
    Route::post('/favourites/{car}/toggle', [FavouriteController::class, 'toggle'])->name('favourites.toggle');
});

// Rental Booking
Route::post('/rentals/book', [AdminRentalController::class, 'store'])->name('rentals.book');

//============ End of User Routes ============
//============================================
//============ Admin Routes ==================

// Admin Login Routes (public)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Admin Protected Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'show'])->name('admin.dashboard');

    // Admin CRUD
    Route::get('/admin/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admin/admins', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admin/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('/admin/admins/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('/admin/admins/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');

    // Cars CRUD
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');
        Route::get('/admin/cars/create', [AdminCarController::class, 'create'])->name('admin.cars.create');
        Route::post('/admin/cars', [AdminCarController::class, 'store'])->name('admin.cars.store');
        Route::get('/admin/cars/{car}/edit', [AdminCarController::class, 'edit'])->name('admin.cars.edit');
        Route::put('/admin/cars/{car}', [AdminCarController::class, 'update'])->name('admin.cars.update');
        Route::get('/admin/cars/{car}', [AdminCarController::class, 'show'])->name('admin.cars.show');
        Route::delete('/admin/cars/{car}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');
    });

    // Customers CRUD    
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/admin/customers/create', [AdminCustomerController::class, 'create'])->name('admin.customers.create');
        Route::post('/admin/customers', [AdminCustomerController::class, 'store'])->name('admin.customers.store');
        Route::get('/admin/customers/{customer}/edit', [AdminCustomerController::class, 'edit'])->name('admin.customers.edit');
        Route::put('/admin/customers/{customer}', [AdminCustomerController::class, 'update'])->name('admin.customers.update');
        Route::get('/admin/customers/{customer}', [AdminCustomerController::class, 'show'])->name('admin.customers.show');
        Route::delete('/admin/customers/{customer}', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');
    });

    // Rentals CRUD
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('admin.rentals.index');
        Route::get('/admin/rentals/create', [AdminRentalController::class, 'create'])->name('admin.rentals.create');
        Route::post('/admin/rentals', [AdminRentalController::class, 'store'])->name('admin.rentals.store');
        Route::get('/admin/rentals/{rental}/edit', [AdminRentalController::class, 'edit'])->name('admin.rentals.edit');
        Route::put('/admin/rentals/{rental}', [AdminRentalController::class, 'update'])->name('admin.rentals.update');
        Route::get('/admin/rentals/{rental}', [AdminRentalController::class, 'show'])->name('admin.rentals.show');
        Route::delete('/admin/rentals/{rental}', [AdminRentalController::class, 'destroy'])->name('admin.rentals.destroy');
    });

    // Sales CRUD
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin/sales', [AdminSaleController::class, 'index'])->name('admin.sales.index');
        Route::get('/admin/sales/create', [AdminSaleController::class, 'create'])->name('admin.sales.create');
        Route::post('/admin/sales', [AdminSaleController::class, 'store'])->name('admin.sales.store');
        Route::get('/admin/sales/{sale}/edit', [AdminSaleController::class, 'edit'])->name('admin.sales.edit');
        Route::put('/admin/sales/{sale}', [AdminSaleController::class, 'update'])->name('admin.sales.update');
        Route::get('/admin/sales/{sale}', [AdminSaleController::class, 'show'])->name('admin.sales.show');
        Route::delete('/admin/sales/{sale}', [AdminSaleController::class, 'destroy'])->name('admin.sales.destroy');
    });

    // Repairs CRUD
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin/repairs', [AdminRepairController::class, 'index'])->name('admin.repairs.index');
        Route::get('/admin/repairs/create', [AdminRepairController::class, 'create'])->name('admin.repairs.create');
        Route::post('/admin/repairs', [AdminRepairController::class, 'store'])->name('admin.repairs.store');
        Route::get('/admin/repairs/{repair}/edit', [AdminRepairController::class, 'edit'])->name('admin.repairs.edit');
        Route::put('/admin/repairs/{repair}', [AdminRepairController::class, 'update'])->name('admin.repairs.update');
        Route::get('/admin/repairs/{repair}', [AdminRepairController::class, 'show'])->name('admin.repairs.show');
        Route::delete('/admin/repairs/{repair}', [AdminRepairController::class, 'destroy'])->name('admin.repairs.destroy');
    });


    // Reports
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
    });

    // Settings
    Route::get('/admin/settings', [AdminSettingController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings', [AdminSettingController::class, 'updateSettings'])->name('admin.settings.update');
});

// Redirect to admin login if accessing /admin without authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');


//============ End of Admin Routes ============