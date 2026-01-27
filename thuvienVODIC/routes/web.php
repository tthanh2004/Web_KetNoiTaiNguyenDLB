<?php

use Illuminate\Support\Facades\Route;

/* --- IMPORTS: CONTROLLERS --- */
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\DataRequestController as AdminRequestController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\UnitController as AdminUnitController;             
use App\Http\Controllers\Admin\FeeCategoryController as AdminFeeCategoryController; 
use App\Http\Controllers\Admin\FeeItemController as AdminFeeItemController;    
use App\Http\Controllers\Admin\ProjectGroupController as AdminProjectGroupController;  

// Client Controllers
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\DocumentController as ClientDocumentController;
use App\Http\Controllers\Client\ServiceController as ClientServiceController;
use App\Http\Controllers\Client\StatisticController as ClientStatisticController;
use App\Http\Controllers\Client\StatisticController as StatisticController;
use App\Http\Controllers\Client\HelpController as ClientHelpController;

/* ==========================================================================
   KHÁCH (PUBLIC ROUTES)
   ========================================================================== */

Route::get('/', [HomeController::class, 'index'])->name('home');

// 1. Tra cứu Dự án & Sản phẩm
Route::get('/du-an', [ClientProjectController::class, 'index'])->name('client.projects.index');
Route::get('/du-an/{id}', [ClientProjectController::class, 'show'])->name('client.project.detail');
Route::get('/tra-cuu/san-pham', [ClientProductController::class, 'index'])->name('client.products.index');

// 2. Tài liệu số
Route::get('/tai-lieu-so', [ClientDocumentController::class, 'index'])->name('client.documents.index');

// 3. Dịch vụ
Route::get('/dich-vu/bieu-phi', [ClientServiceController::class, 'fees'])->name('client.services.fees');
Route::view('/dich-vu/khac', 'client.services.other')->name('client.services.other');

// 4. Yêu cầu dữ liệu
Route::get('/gui-yeu-cau', [HomeController::class, 'createRequest'])->name('client.request.create');
Route::post('/gui-yeu-cau', [HomeController::class, 'storeRequest'])->name('client.request.store');

// 5. Thống kê
Route::get('/thong-ke/du-an', [StatisticController::class, 'projects'])->name('client.statistics.projects');
Route::get('/thong-ke/de-an-47', [StatisticController::class, 'scheme47'])->name('client.statistics.scheme47');
Route::get('/thong-ke/don-vi', [StatisticController::class, 'byUnit'])->name('client.statistics.units');
Route::get('/thong-ke/bo-nganh', [StatisticController::class, 'ministries'])->name('client.statistics.ministries');
Route::get('/thong-ke/tai-lieu', [StatisticController::class, 'documents'])->name('client.statistics.documents');

// 6. Trang tĩnh (Giới thiệu, Liên hệ...)
Route::view('/gioi-thieu', 'client.help.about')->name('client.help.about');
Route::view('/co-cau-to-chuc', 'client.help.org')->name('client.help.org');
Route::view('/huong-dan', 'client.help.guide')->name('client.help.guide');
Route::view('/lien-he', 'client.help.contact')->name('client.help.contact');

/* ==========================================================================
   QUẢN TRỊ (ADMIN ROUTES)
   ========================================================================== */

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý Dự án
    Route::resource('projects', AdminProjectController::class);

    // Quản lý Đơn vị thực hiện
    Route::resource('units', AdminUnitController::class);

    // Quản lý Bộ ngành
    Route::resource('ministries', MinistryController::class);

    // Quản lý Tài liệu số
    Route::resource('documents', AdminDocumentController::class);

    // Quản lý Biểu phí (Nhóm phí & Loại phí chi tiết)
    Route::resource('fee-categories', AdminFeeCategoryController::class);
    Route::resource('fee-items', AdminFeeItemController::class);

    // Quản lý Yêu cầu dữ liệu (Chỉ Xem, Cập nhật, Xóa - Không có Tạo mới)
    // Lưu ý: Đặt tên resource là 'data_requests' để khớp với Sidebar của bạn
    Route::resource('requests', AdminRequestController::class)->only(['index', 'update', 'destroy']);    
    // Route riêng để update trạng thái nhanh (nếu cần dùng Ajax/Patch)
    Route::patch('/data_requests/{id}/update-status', [AdminRequestController::class, 'update'])->name('data_requests.update_status');
    // Quản lý Nhóm dự án
    Route::resource('project-groups', AdminProjectGroupController::class);
});

/* ==========================================================================
   AUTHENTICATION & PROFILE
   ========================================================================== */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';