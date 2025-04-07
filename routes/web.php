<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClinicNoteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceTypeController;
use App\Http\Controllers\NotificationController;

// الصفحة الرئيسية - تم تعديلها لتوجيه المستخدم إلى صفحة تسجيل الدخول
Route::get('/', function () {
    return redirect()->route('login');
});

// مسارات المصادقة
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// مسارات التسجيل
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register/clinic', [RegisterController::class, 'registerClinic'])->name('register.clinic.submit');
Route::get('/register/doctor', [RegisterController::class, 'showDoctorRegistrationForm'])->name('register.doctor');
Route::post('/register/doctor', [RegisterController::class, 'registerDoctor'])->name('register.doctor.submit');

// مسار لوحة التحكم (محمي)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/latest-patients', [DashboardController::class, 'getLatestPatients'])->name('dashboard.latest-patients');
    Route::get('/dashboard/today-appointments', [DashboardController::class, 'getTodayAppointments'])->name('dashboard.today-appointments');
    Route::get('/dashboard/available-times', [DashboardController::class, 'getAvailableTimes'])->name('dashboard.available-times');
});

// مسارات المرضى
Route::resource('patients', PatientController::class);
Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');
Route::post('/patients/add-from-dashboard', [PatientController::class, 'addFromDashboard'])->name('patients.add-from-dashboard');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::get('/patients/{patient}/images', [PatientController::class, 'images'])->name('patients.images');
Route::get('/patients/{patient}/appointments', [PatientController::class, 'appointments'])->name('patients.appointments');
Route::get('/patients/{patient}/invoices', [PatientController::class, 'invoices'])->name('patients.invoices');

// مسارات المواعيد
Route::resource('appointments', AppointmentController::class);
Route::post('/appointments/{appointment}/toggle-star', [AppointmentController::class, 'toggleStar'])->name('appointments.toggle-star');
Route::post('/appointments/{appointment}/toggle-archive', [AppointmentController::class, 'toggleArchive'])->name('appointments.toggle-archive');
Route::post('/appointments/star-multiple', [AppointmentController::class, 'starMultiple'])->name('appointments.star-multiple');
Route::post('/appointments/archive-multiple', [AppointmentController::class, 'archiveMultiple'])->name('appointments.archive-multiple');

// مسارات ملاحظات العيادة
Route::resource('notes', ClinicNoteController::class);
Route::post('/notes/{note}/toggle-importance', [ClinicNoteController::class, 'toggleImportance'])->name('notes.toggle-importance');
Route::post('/notes/quick-add', [ClinicNoteController::class, 'addQuickNote'])->name('notes.quick-add');

// مسارات الفواتير
Route::resource('invoices', InvoiceController::class);

// مسارات أنواع الفواتير
Route::post('/invoice-types', [InvoiceTypeController::class, 'store'])->name('invoice-types.store');
Route::put('/invoice-types/{invoiceType}', [InvoiceTypeController::class, 'update'])->name('invoice-types.update');
Route::delete('/invoice-types/{invoiceType}', [InvoiceTypeController::class, 'destroy'])->name('invoice-types.destroy');

// مسارات التنبيهات
Route::resource('notifications', NotificationController::class)->except(['create', 'edit', 'update']);
Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
Route::get('/notifications/latest', [NotificationController::class, 'getLatestNotifications'])->name('notifications.latest');


