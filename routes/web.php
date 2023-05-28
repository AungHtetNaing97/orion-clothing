<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ShopController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\DetailsController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\WishlistController;
use App\Http\Controllers\Admin\Backend\AuthController;
use App\Http\Controllers\Admin\Backend\SizeController;
use App\Http\Controllers\Admin\Backend\UserController;
use App\Http\Controllers\Admin\Backend\BrandController;
use App\Http\Controllers\Admin\Backend\ColorController;
use App\Http\Controllers\Website\CollectionsController;
use App\Http\Controllers\Admin\Backend\SliderController;
use App\Http\Controllers\Admin\Backend\ProductController;
use App\Http\Controllers\Admin\Backend\SettingController;
use App\Http\Controllers\Admin\Backend\VariantController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\Backend\CategoryController;
use App\Http\Controllers\Admin\Backend\ContactController as BackendContactController;
use App\Http\Controllers\Admin\Backend\DashboardController;
use App\Http\Controllers\Admin\Backend\SubcategoryController;
use App\Http\Controllers\Website\AuthController as WebsiteAuthController;
use App\Http\Controllers\Website\BrandController as WebsiteBrandController;
use App\Http\Controllers\Admin\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\SearchController;

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

// Frontend App with Livewire
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('shop', [ShopController::class, 'index'])->name('shop');

Route::get('collections/{category_slug}/{subcategory_slug}/{product_slug}', [DetailsController::class, 'index'])->name('productDetails');

Route::get('collections', [CollectionsController::class, 'index'])->name('collections.category');

Route::get('collections/{category_slug}', [CollectionsController::class, 'category'])->name('collections.category.subcategory');

Route::get('collections/{category_slug}/{subcategory_slug}',[CollectionsController::class, 'subcategory'])->name('collections.category.subcategory.product');

Route::get('brands', [WebsiteBrandController::class, 'index'])->name('brands');

Route::get('brands/{brand_slug}', [WebsiteBrandController::class, 'brand'])->name('brand.product');

// User Register & Login
Route::get('register', [WebsiteAuthController::class, 'indexRegister'])->name('register');
Route::get('login', [WebsiteAuthController::class, 'indexLogin'])->name('login');
Route::post('logout', [WebsiteAuthController::class, 'logout'])->name('logout');

// Search
Route::get('search', [SearchController::class, 'searchProducts'])->name('search');

//After Login
Route::middleware('frontendAuth')->group(function () {
    // Contact Form
    Route::get('contactUs', [ContactController::class, 'contactUs'])->name('contactUs');

    // Wishlist
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');

    // Cart
    Route::get('cart', [CartController::class, 'index'])->name('cart');

    // Checkout
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');

    // Thank you
    Route::get('thank-you', [HomeController::class, 'thankyou']);

    // Order
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'updateUserDetails'])->name('profile.update');

    // Password
    Route::get('change-password', [ProfileController::class, 'passwordCreate'])->name('profile.passwordPage');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});

// Backend Admin Panel
Route::prefix('ecommerce/')->name('ecommerce.')->group(function () {
    Route::prefix('admin/')->name('admin.')->group(function () {
        // Admin Register & Login
        Route::get('register', [AuthController::class, 'adminRegisterPage'])->name('adminRegisterPage');
        Route::post('register', [AuthController::class, 'adminRegister'])->name('adminRegister');
        Route::get('login', [AuthController::class, 'adminLoginPage'])->name('adminLoginPage');
        Route::post('login', [AuthController::class, 'adminLogin'])->name('adminLogin');
        Route::post('logout', [AuthController::class, 'adminLogout'])->name('adminLogout');

        // Admin Panel
        Route::middleware('adminAuth')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Color
            Route::resource('colors', ColorController::class);

            // Size
            Route::resource('sizes', SizeController::class);

            // Brand
            Route::resource('brands', BrandController::class);

            // Category
            Route::resource('categories', CategoryController::class);

            //Subcategory
            Route::resource('subcategories', SubcategoryController::class);
            Route::get('/categories/{categoryId}/subcategories', [SubcategoryController::class, 'getSubcategory']);

            // Product
            Route::resource('products', ProductController::class);
            Route::get('products/productImage/{productImage_id}', [ProductController::class, 'destroyImage']);

            // Product Variant
            Route::resource('variants', VariantController::class);

            // Slider
            Route::resource('sliders', SliderController::class);

            // Order
            Route::controller(BackendOrderController::class)->group(function () {
                Route::get('orders', 'index')->name('orders.index');
                Route::get('orders/{orderId}/edit', 'edit')->name('orders.edit');
                Route::put('orders/{orderId}', 'update')->name('orders.update');
                Route::get('orders/{orderId}', 'show')->name('orders.show');
                Route::delete('orders/{orderId}', 'destroy')->name('orders.destroy');

                Route::get('orders/invoice/{orderId}', 'viewInvoice')->name('orders.invoice');
                Route::get('orders/invoice/{orderId}/generate', 'generateInvoice')->name('orders.invoice.generate');

                Route::get('orders/invoice/{orderId}/mail', 'mailInvoice')->name('orders.invoice.mail');
            });

            // Setting
            Route::controller(SettingController::class)->group(function () {
                Route::get('settings', 'index')->name('settings.index');
                Route::post('settings', 'storeupdate')->name('settings.storeupdate');
            });

            // User
            Route::resource('users', UserController::class);

            // Users' Contacts
            Route::controller(BackendContactController::class)->group(function () {
                Route::get('contacts', 'index')->name('contacts.index');
                Route::get('contacts/{contactId}', 'show')->name('contacts.show');
                Route::delete('contacts/{contactId}', 'destroy')->name('contacts.destroy');
            });
        });
    });
});
