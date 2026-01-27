<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\DataRequestController as AdminRequestController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\DocumentController as ClientDocumentController;
use App\Http\Controllers\Client\ServiceController as ClientServiceController;
use App\Http\Controllers\Client\StatisticController as ClientStatisticController;
use App\Http\Controllers\Client\HelpController as ClientHelpController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;

/* --- KHÁCH (PUBLIC) --- */
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Tra cứu
// Trang danh sách dự án (bạn có thể tái sử dụng trang home hoặc tạo trang riêng)
Route::get('/du-an', [ClientProjectController::class, 'index'])->name('client.projects.index');
Route::get('/du-an/{id}', [ClientProjectController::class, 'show'])->name('client.project.detail');
Route::get('/tra-cuu/san-pham', [ClientProductController::class, 'index'])->name('client.products.index');

// 3. Tài liệu số 
Route::get('/tai-lieu-so', [ClientDocumentController::class, 'index'])->name('client.documents.index');

// 4. Dịch vụ
Route::get('/dich-vu/bieu-phi', [ClientServiceController::class, 'fees'])->name('client.services.fees');
Route::view('/dich-vu/khac', 'client.services.other')->name('client.services.other');

// 5. Yêu cầu dữ liệu (Đã có Controller)
Route::get('/gui-yeu-cau', [HomeController::class, 'createRequest'])->name('client.request.create');
Route::post('/gui-yeu-cau', [HomeController::class, 'storeRequest'])->name('client.request.store');

// 6. Thống kê (Tạo view tương ứng)
Route::view('/thong-ke/du-an', 'client.statistics.projects')->name('client.statistics.projects');
Route::view('/thong-ke/de-an-47', 'client.statistics.scheme47')->name('client.statistics.scheme47');
Route::get('/thong-ke/don-vi', [ClientStatisticController::class, 'byUnit'])->name('client.statistics.units');
Route::view('/thong-ke/bo-nganh', 'client.statistics.ministries')->name('client.statistics.ministries');
Route::view('/thong-ke/tai-lieu', 'client.statistics.documents')->name('client.statistics.documents');
// 7. Trợ giúp & Footer Links
Route::view('/gioi-thieu', 'client.help.about')->name('client.help.about'); // Giới thiệu chung
Route::view('/co-cau-to-chuc', 'client.help.org')->name('client.help.org'); // Cơ cấu tổ chức
Route::view('/huong-dan', 'client.help.guide')->name('client.help.guide'); // Hướng dẫn
Route::view('/lien-he', 'client.help.contact')->name('client.help.contact'); // Liên hệ

/* --- ADMIN (PRIVATE) --- */
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', AdminProjectController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('data_requests', AdminRequestController::class)->only(['index', 'update', 'destroy']);
    Route::patch('/data_requests/{id}/update-status', [AdminRequestController::class, 'update'])->name('data_requests.update_status');
    Route::resource('ministries', MinistryController::class);
});

/* --- AUTH --- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';