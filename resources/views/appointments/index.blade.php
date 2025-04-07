@extends('layouts.appointments_layout')

@section('title', 'إدارة المواعيد')

@section('styles')
<style>
    .appointments-table {
        width: 100%;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .appointments-table table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
    }

    .appointments-table th {
        background-color: #f8f9fa;
        padding: 15px 10px;
        font-weight: 500;
        color: #555;
        text-align: center;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .appointments-table td {
        padding: 12px 10px;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        font-size: 14px;
        color: #333;
    }

    .appointments-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .status-badge {
        background-color: #00c853;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        display: inline-block;
        font-weight: 500;
    }

    .star-icon {
        color: #ddd;
        cursor: pointer;
        font-size: 16px;
        margin-left: 5px;
    }

    .star-icon:hover, .star-icon.active {
        color: #ffc107;
    }

    .folder-icon {
        color: #34939C;
        cursor: pointer;
        font-size: 16px;
    }

    .folder-icon:hover {
        color: #22577A;
    }

    .patient-img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f0f0f0;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background-color: #f8f9fa;
        border-top: 1px solid #eee;
    }

    .action-btn {
        background-color: #f0f0f0;
        border: none;
        color: #555;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 13px;
    }

    .action-btn:hover {
        background-color: #e0e0e0;
    }

    .checkbox-container {
        display: flex;
        justify-content: center;
    }

    .form-check-input {
        width: 16px;
        height: 16px;
        margin-top: 0;
        cursor: pointer;
    }

    .time-cell {
        color: #666;
        font-size: 13px;
    }

    .date-cell {
        color: #666;
        font-size: 13px;
    }

    .session-type {
        color: #34939C;
        font-weight: 500;
    }

    .patient-name {
        font-weight: 500;
        color: #22577A;
    }

    .patient-age {
        color: #666;
    }

    /* تعديلات إضافية لمطابقة الصورة بنسبة 100% */
    .table-header {
        background-color: #f8f9fa;
    }

    .table-header th {
        font-weight: normal;
        color: #666;
        border-bottom: none;
        padding: 12px 10px;
    }

    .appointments-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
    }

    .appointments-table tbody tr:last-child {
        border-bottom: none;
    }

    .appointments-table tbody td {
        border-bottom: none;
    }

    .footer-actions {
        display: flex;
        gap: 10px;
    }

    .footer-actions .action-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        background-color: #f8f9fa;
        border: 1px solid #eee;
        padding: 8px 20px;
    }

    .footer-actions .action-btn i {
        font-size: 14px;
    }

    /* أنماط مودال التصفية */
    .filter-modal {
        position: absolute;
        top: 70px;
        left: 20px;
        width: 280px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        padding: 20px;
        display: none;
    }

    .filter-modal.show {
        display: block;
    }

    .filter-modal-header {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 600;
        color: #22577A;
        font-size: 16px;
    }

    .filter-option {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 10px;
        text-align: center;
        color: #666;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .filter-option:hover {
        background-color: #eef2f7;
    }

    .filter-option.active {
        background-color: #34939C;
        color: white;
    }

    .filter-option.disabled {
        color: #ccc;
        cursor: not-allowed;
    }

    .filter-option .filter-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
    }

    .filter-option .filter-chevron {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    .filter-submenu {
        display: none;
        margin-top: 5px;
        margin-bottom: 15px;
        padding-right: 15px;
    }

    .filter-submenu.show {
        display: block;
    }

    .filter-submenu-item {
        background-color: #f0f0f0;
        border-radius: 6px;
        padding: 8px 12px;
        margin-bottom: 5px;
        text-align: center;
        color: #666;
        cursor: pointer;
        transition: all 0.3s;
    }

    .filter-submenu-item:hover {
        background-color: #e0e0e0;
    }

    .filter-submenu-item.active {
        background-color: #22577A;
        color: white;
    }

    .filter-actions {
        margin-top: 20px;
        text-align: center;
    }

    .filter-clear {
        color: #f44336;
        background: none;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        font-size: 14px;
    }

    .filter-clear:hover {
        text-decoration: underline;
    }

    .filter-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.1);
        z-index: 999;
        display: none;
    }

    .filter-overlay.show {
        display: block;
    }

    /* أنماط المودال */
    .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }

    .modal-title {
        font-weight: 600;
        color: #22577A;
    }

    .modal-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 8px 12px;
    }

    .modal-footer {
        border-top: none;
        padding-top: 0;
    }

    .btn-primary {
        background-color: #34939C;
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
    }

    .btn-secondary {
        background-color: #f0f0f0;
        border: none;
        color: #555;
        border-radius: 8px;
        padding: 8px 20px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- مودال التصفية -->
    <div class="filter-overlay" id="filterOverlay"></div>
    <div class="filter-modal" id="filterModal">
        <div class="filter-modal-header">تصفية الجدول حسب</div>

        <!-- تصفية حسب اسم المريض -->
        <div class="filter-option" data-filter="patient" data-has-submenu="true">
            اسم المريض
            <i class="fas fa-chevron-down filter-chevron"></i>
        </div>
        <div class="filter-submenu" id="patientSubmenu">
            @if(isset($patients) && count($patients) > 0)
                @foreach($patients as $patient)
                    <div class="filter-submenu-item" data-filter="patient" data-value="{{ $patient->id }}">
                        {{ $patient->full_name }}
                    </div>
                @endforeach
            @else
                <div class="filter-submenu-item disabled">لا يوجد مرضى</div>
            @endif
        </div>

        <!-- تصفية حسب نوع الجلسة -->
        <div class="filter-option" data-filter="session_type" data-has-submenu="true">
            نوع الجلسة
            <i class="fas fa-chevron-down filter-chevron"></i>
        </div>
        <div class="filter-submenu" id="sessionTypeSubmenu">
            <div class="filter-submenu-item" data-filter="session_type" data-value="مراجعة ثانية">مراجعة ثانية</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="حشوة">حشوة</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="تنظيف">تنظيف</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="خلع">خلع</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="تقويم">تقويم</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="زراعة">زراعة</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="تبييض">تبييض</div>
            <div class="filter-submenu-item" data-filter="session_type" data-value="كشف">كشف</div>
        </div>

        <!-- تصفية حسب التاريخ -->
        <div class="filter-option" data-filter="date">
            <div class="d-flex justify-content-between align-items-center">
                <span>التاريخ</span>
                <input type="date" class="form-control filter-date-input" style="width: 150px; height: 30px;">
            </div>
        </div>

        <!-- تصفية حسب الوقت -->
        <div class="filter-option" data-filter="time">
            <div class="d-flex justify-content-between align-items-center">
                <span>الوقت</span>
                <input type="time" class="form-control filter-time-input" style="width: 150px; height: 30px;">
            </div>
        </div>

        <!-- تصفية حسب الحالة -->
        <div class="filter-option" data-filter="status" data-has-submenu="true">
            حسب الحالة
            <i class="fas fa-chevron-down filter-chevron"></i>
        </div>
        <div class="filter-submenu" id="statusSubmenu">
            <div class="filter-submenu-item" data-filter="status" data-value="pending">قيد الانتظار</div>
            <div class="filter-submenu-item" data-filter="status" data-value="completed">مكتمل</div>
            <div class="filter-submenu-item" data-filter="status" data-value="cancelled">ملغي</div>
        </div>

        <!-- تصفية المؤرشفة والمميزة -->
        <div class="filter-option" data-filter="archived">المؤرشفة فقط</div>
        <div class="filter-option" data-filter="starred">المميزة فقط</div>

        <div class="filter-actions">
            <button class="filter-clear">مسح التصفية</button>
        </div>
    </div>

    <div class="appointments-table">
        <table class="table mb-0">
            <thead class="table-header">
                <tr>
                    <th style="width: 40px;">ت</th>
                    <th style="width: 60px;">الصورة</th>
                    <th style="width: 150px;">اسم المريض</th>
                    <th style="width: 80px;">عمر المريض</th>
                    <th style="width: 150px;">نوع الجلسة</th>
                    <th style="width: 120px;">تاريخ الموعد</th>
                    <th style="width: 120px;">وقت الموعد</th>
                    <th style="width: 120px;">حالة الموعد</th>
                    <th style="width: 100px;">إعدادات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                <tr data-id="{{ $appointment->id }}" class="{{ $appointment->is_archived ? 'archived' : '' }} {{ $appointment->is_starred ? 'starred' : '' }}">
                    <td>
                        <div class="checkbox-container">
                            <input type="checkbox" class="form-check-input appointment-checkbox" value="{{ $appointment->id }}">
                        </div>
                    </td>
                    <td>
                        @if($appointment->patient && $appointment->patient->gender == 'male')
                            <img src="{{ asset('images/11.png') }}" alt="صورة المريض" class="patient-img">
                        @else
                            <img src="{{ asset('images/22.png') }}" alt="صورة المريضة" class="patient-img">
                        @endif
                    </td>
                    <td class="patient-name">
                        <a href="#" class="patient-details-link" data-id="{{ $appointment->patient->id ?? 0 }}">
                            {{ $appointment->patient->full_name ?? 'غير محدد' }}
                        </a>
                    </td>
                    <td class="patient-age">{{ $appointment->patient->age ?? 'غير محدد' }}</td>
                    <td class="session-type">{{ $appointment->session_type ?? 'مراجعة' }}</td>
                    <td class="date-cell">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y/m/d') }}</td>
                    <td class="time-cell">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                    <td>
                        <span class="status-badge
                            @if($appointment->status == 'completed') bg-success
                            @elseif($appointment->status == 'cancelled') bg-danger
                            @else bg-warning @endif">
                            {{ $appointment->status == 'completed' ? 'مكتمل' : ($appointment->status == 'cancelled' ? 'ملغي' : 'قيد الانتظار') }}
                        </span>
                    </td>
                    <td>
                        <i class="fas fa-star star-icon {{ $appointment->is_starred ? 'active' : '' }}"
                           data-id="{{ $appointment->id }}" title="تمييز بنجمة"></i>
                        <i class="fas fa-folder folder-icon {{ $appointment->is_archived ? 'active' : '' }}"
                           data-id="{{ $appointment->id }}" title="أرشفة"></i>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">لا توجد مواعيد متاحة</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="table-footer">
            <div class="footer-actions">
                <button class="action-btn" id="starSelectedBtn">
                    <i class="fas fa-star"></i>
                    تمييز بنجمة
                </button>
                <button class="action-btn" id="archiveSelectedBtn">
                    <i class="fas fa-folder"></i>
                    أرشفة
                </button>
            </div>
            <div class="pagination-container">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>

<!-- مودال إضافة موعد جديد -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">إضافة موعد جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAppointmentForm">
                    <div class="form-group mb-3">
                        <label for="patient_id" class="form-label">اختر المريض</label>
                        <select class="form-control" id="patient_id" name="patient_id" required>
                            <option value="">-- اختر المريض --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="appointment_date" class="form-label">تاريخ الموعد</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="appointment_time" class="form-label">وقت الموعد</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="session_type" class="form-label">نوع الجلسة</label>
                        <select class="form-control" id="session_type" name="session_type">
                            <option value="مراجعة ثانية">مراجعة ثانية</option>
                            <option value="حشوة">حشوة</option>
                            <option value="تنظيف">تنظيف</option>
                            <option value="خلع">خلع</option>
                            <option value="تقويم">تقويم</option>
                            <option value="زراعة">زراعة</option>
                            <option value="تبييض">تبييض</option>
                            <option value="كشف">كشف</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="المبلغ (اختياري)">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">حالة الموعد</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending">قيد الانتظار</option>
                            <option value="completed">مكتمل</option>
                            <option value="cancelled">ملغي</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" id="saveAppointmentBtn">حفظ الموعد</button>
            </div>
        </div>
    </div>
</div>

<!-- مودال تفاصيل المريض -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light py-3">
                <h5 class="modal-title fw-bold text-primary" id="patientDetailsModalLabel">عنوان الموعد أو الجلسة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="card mb-4 border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">اسم المريض</div>
                                    <div class="bg-light py-1 px-3 rounded flex-grow-1" id="patient-name">اسلام</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">عمر المريض</div>
                                    <div class="bg-light py-1 px-3 rounded flex-grow-1" id="patient-age">20</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">وقت الموعد</div>
                                    <div class="bg-light py-1 px-3 rounded flex-grow-1" id="appointment-time">10:00 AM</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">تاريخ الموعد</div>
                                    <div class="bg-light py-1 px-3 rounded flex-grow-1" id="appointment-date">10 / 10 / 2024</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">المبلغ الكلي</div>
                                    <div class="bg-light py-1 px-3 rounded flex-grow-1" id="total-amount">100 ألف</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">نوع المدفوع</div>
                                    <div class="bg-light py-1 px-3 rounded flex-grow-1" id="payment-type">100</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2" style="width: 120px;">الحالة</div>
                                    <div class="py-1 px-3 rounded flex-grow-1">
                                        <span id="appointment-status" class="badge bg-success px-4 py-2">مدفوع</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex mb-3">
                                    <div class="text-primary fw-bold ms-2">ملاحظة</div>
                                </div>
                                <div class="bg-light p-3 rounded mb-4" id="appointment-note">
                                    تم استخدام حشوة ضوئية.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-light w-100 text-start py-2 mb-2" id="dental-images-btn">
                                    <i class="fas fa-chevron-left float-start mt-1"></i>
                                    صور الأسنان
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-light w-100 text-start py-2 mb-2" id="xray-images-btn">
                                    <i class="fas fa-chevron-left float-start mt-1"></i>
                                    صور الأشعة
                                </button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="text-primary fw-bold mb-2">تفاصيل الجلسة</div>
                                <div class="bg-light p-3 rounded mb-4" id="session-details">
                                    تم إزالة التسوس من الضرس الأيمن السفلي.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-primary fw-bold mb-2">الدواء الذي تم وصفه</div>
                                <div class="bg-light p-3 rounded mb-3" id="prescribed-medicine">
                                    إيبوبروفين 400 ملجم حبة واحدة كل 8 ساعات.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-primary fw-bold mb-2">تعليمات الاستخدام</div>
                                <div class="bg-light p-3 rounded mb-3" id="usage-instructions">
                                    تناول الدواء بعد الطعام لتجنب تهيج المعدة لمدة 3 أيام.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button type="button" class="btn btn-primary px-5 py-2" id="editAppointmentBtn">تعديل</button>
                    <button type="button" class="btn btn-outline-danger px-5 py-2" id="deleteAppointmentBtn">حذف</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // تفعيل وظيفة النجمة
    document.querySelectorAll('.star-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const appointmentId = this.getAttribute('data-id');
            toggleStar(appointmentId, this);
        });
    });

    // تفعيل وظيفة الأرشفة
    document.querySelectorAll('.folder-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const appointmentId = this.getAttribute('data-id');
            toggleArchive(appointmentId, this);
        });
    });

    // تفعيل مودال التصفية
    document.addEventListener('DOMContentLoaded', function() {
        const filterIcon = document.querySelector('.filter-icon');
        const filterModal = document.getElementById('filterModal');
        const filterOverlay = document.getElementById('filterOverlay');

        // فتح المودال عند الضغط على أيقونة الفلتر
        if (filterIcon) {
            filterIcon.addEventListener('click', function() {
                filterModal.classList.toggle('show');
                filterOverlay.classList.toggle('show');
            });
        }

        // إغلاق المودال عند الضغط خارجه
        if (filterOverlay) {
            filterOverlay.addEventListener('click', function() {
                filterModal.classList.remove('show');
                filterOverlay.classList.remove('show');
            });
        }

        // تفعيل خيارات التصفية الرئيسية
        const filterOptions = document.querySelectorAll('.filter-option:not(.disabled)');
        filterOptions.forEach(option => {
            option.addEventListener('click', function() {
                const hasSubmenu = this.getAttribute('data-has-submenu') === 'true';

                if (hasSubmenu) {
                    // إذا كان له قائمة فرعية، نعرضها أو نخفيها
                    const filterType = this.getAttribute('data-filter');
                    const submenu = document.getElementById(filterType + 'Submenu');
                    if (submenu) {
                        submenu.classList.toggle('show');
                        // تغيير اتجاه السهم
                        const chevron = this.querySelector('.filter-chevron');
                        if (chevron) {
                            chevron.classList.toggle('fa-chevron-down');
                            chevron.classList.toggle('fa-chevron-up');
                        }
                    }
                } else if (this.querySelector('input')) {
                    // إذا كان يحتوي على حقل إدخال، لا نفعل شيئًا عند النقر على الخيار نفسه
                    return;
                } else {
                    // تفعيل/إلغاء تفعيل الخيار
                    this.classList.toggle('active');
                    applyFilters();
                }
            });
        });

        // تفعيل حقول الإدخال في خيارات التصفية
        const dateInput = document.querySelector('.filter-date-input');
        if (dateInput) {
            dateInput.addEventListener('change', function() {
                applyFilters();
            });

            // منع انتشار الحدث للعنصر الأب
            dateInput.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        const timeInput = document.querySelector('.filter-time-input');
        if (timeInput) {
            timeInput.addEventListener('change', function() {
                applyFilters();
            });

            // منع انتشار الحدث للعنصر الأب
            timeInput.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // تفعيل خيارات القوائم الفرعية
        const submenuItems = document.querySelectorAll('.filter-submenu-item');
        submenuItems.forEach(item => {
            item.addEventListener('click', function() {
                this.classList.toggle('active');
                applyFilters();
            });
        });

        // مسح التصفية
        const filterClearBtn = document.querySelector('.filter-clear');
        if (filterClearBtn) {
            filterClearBtn.addEventListener('click', function() {
                // إلغاء تفعيل جميع خيارات التصفية
                document.querySelectorAll('.filter-option.active').forEach(option => {
                    option.classList.remove('active');
                });

                // إلغاء تفعيل جميع خيارات القوائم الفرعية
                document.querySelectorAll('.filter-submenu-item.active').forEach(item => {
                    item.classList.remove('active');
                });

                // إعادة تعيين حقول الإدخال
                if (dateInput) dateInput.value = '';
                if (timeInput) timeInput.value = '';

                // إعادة عرض جميع الصفوف
                document.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = '';
                });
            });
        }

        // تفعيل خيارات التصفية الإضافية
        const statusSubmenu = document.getElementById('statusSubmenu');
        if (statusSubmenu) {
            const statusItems = statusSubmenu.querySelectorAll('.filter-submenu-item');
            statusItems.forEach(item => {
                item.addEventListener('click', function() {
                    this.classList.toggle('active');
                    applyFilters();
                });
            });
        }

        // تفعيل خيارات التصفية الإضافية
        const sessionTypeSubmenu = document.getElementById('sessionTypeSubmenu');
        if (sessionTypeSubmenu) {
            const sessionTypeItems = sessionTypeSubmenu.querySelectorAll('.filter-submenu-item');
            sessionTypeItems.forEach(item => {
                item.addEventListener('click', function() {
                    this.classList.toggle('active');
                    applyFilters();
                });
            });
        }

        // تفعيل خيارات التصفية الإضافية
        const patientSubmenu = document.getElementById('patientSubmenu');
        if (patientSubmenu) {
            const patientItems = patientSubmenu.querySelectorAll('.filter-submenu-item');
            patientItems.forEach(item => {
                item.addEventListener('click', function() {
                    this.classList.toggle('active');
                    applyFilters();
                });
            });
        }

        // تفعيل خيارات التصفية الإضافية
        const archived = document.querySelector('.filter-option[data-filter="archived"]');
        if (archived) {
            archived.addEventListener('click', function() {
                this.classList.toggle('active');
                applyFilters();
            });
        }

        // تفعيل خيارات التصفية الإضافية
        const starred = document.querySelector('.filter-option[data-filter="starred"]');
        if (starred) {
            starred.addEventListener('click', function() {
                this.classList.toggle('active');
                applyFilters();
            });
        }
    });

    // وظيفة تطبيق الفلاتر
    function applyFilters() {
        // الحصول على الفلاتر النشطة
        const activeMainFilters = Array.from(document.querySelectorAll('.filter-option.active')).map(option =>
            option.getAttribute('data-filter')
        );

        const activeSubmenuFilters = {};
        document.querySelectorAll('.filter-submenu-item.active').forEach(item => {
            const filterType = item.getAttribute('data-filter');
            const filterValue = item.getAttribute('data-value');

            if (!activeSubmenuFilters[filterType]) {
                activeSubmenuFilters[filterType] = [];
            }

            activeSubmenuFilters[filterType].push(filterValue);
        });

        const dateFilter = document.querySelector('.filter-date-input')?.value;
        const timeFilter = document.querySelector('.filter-time-input')?.value;

        // إعادة عرض جميع الصفوف
        document.querySelectorAll('tbody tr').forEach(row => {
            let shouldShow = true;

            // تطبيق الفلاتر الرئيسية
            if (activeMainFilters.includes('archived') && !row.classList.contains('archived')) {
                shouldShow = false;
            }

            if (activeMainFilters.includes('starred') && !row.classList.contains('starred')) {
                shouldShow = false;
            }

            // تطبيق فلاتر القوائم الفرعية
            for (const filterType in activeSubmenuFilters) {
                if (activeSubmenuFilters[filterType].length > 0) {
                    const cellValue = row.querySelector(`.${filterType}-cell`)?.textContent.trim();
                    const rowValue = row.getAttribute(`data-${filterType}`);
                    const valueToCheck = rowValue || cellValue;

                    if (!activeSubmenuFilters[filterType].some(value => valueToCheck?.includes(value))) {
                        shouldShow = false;
                    }
                }
            }

            // تطبيق فلتر التاريخ
            if (dateFilter) {
                const rowDate = row.querySelector('.date-cell')?.textContent.trim();
                const formattedRowDate = formatDateForComparison(rowDate);
                if (formattedRowDate !== dateFilter) {
                    shouldShow = false;
                }
            }

            // تطبيق فلتر الوقت
            if (timeFilter) {
                const rowTime = row.querySelector('.time-cell')?.textContent.trim();
                const formattedRowTime = formatTimeForComparison(rowTime);
                if (formattedRowTime !== timeFilter) {
                    shouldShow = false;
                }
            }

            // تطبيق النتيجة
            row.style.display = shouldShow ? '' : 'none';
        });
    }

    // وظائف مساعدة لتنسيق التاريخ والوقت للمقارنة
    function formatDateForComparison(dateStr) {
        if (!dateStr) return '';

        // تحويل التاريخ من صيغة "2024/10/10" إلى "2024-10-10"
        const parts = dateStr.split('/');
        if (parts.length === 3) {
            return `${parts[0]}-${parts[1]}-${parts[2]}`;
        }

        return dateStr;
    }

    function formatTimeForComparison(timeStr) {
        if (!timeStr) return '';

        // تحويل الوقت من صيغة "10:26 AM" إلى "10:26"
        const timeParts = timeStr.split(' ')[0];
        return timeParts;
    }

    // وظيفة تبديل حالة النجمة
    function toggleStar(appointmentId, element) {
        fetch(`/appointments/${appointmentId}/toggle-star`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                element.classList.toggle('active');
                const row = element.closest('tr');
                if (data.is_starred) {
                    row.classList.add('starred');
                } else {
                    row.classList.remove('starred');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // وظيفة تبديل حالة الأرشفة
    function toggleArchive(appointmentId, element) {
        fetch(`/appointments/${appointmentId}/toggle-archive`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                element.classList.toggle('active');
                const row = element.closest('tr');
                if (data.is_archived) {
                    row.classList.add('archived');
                } else {
                    row.classList.remove('archived');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // الحصول على المواعيد المحددة
    function getSelectedAppointments() {
        const checkboxes = document.querySelectorAll('.appointment-checkbox:checked');
        return Array.from(checkboxes).map(checkbox => checkbox.value);
    }

    // تمييز مواعيد متعددة بنجمة
    function starMultipleAppointments(appointmentIds) {
        fetch('/appointments/star-multiple', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ appointment_ids: appointmentIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // أرشفة مواعيد متعددة
    function archiveMultipleAppointments(appointmentIds) {
        fetch('/appointments/archive-multiple', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ appointment_ids: appointmentIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // إضافة كود JavaScript لمعالجة إرسال نموذج إضافة موعد
    document.addEventListener('DOMContentLoaded', function() {
        const addAppointmentButton = document.getElementById('addAppointmentButton');
        if (addAppointmentButton) {
            addAppointmentButton.addEventListener('click', function() {
                const addAppointmentModal = new bootstrap.Modal(document.getElementById('addAppointmentModal'));
                addAppointmentModal.show();
            });
        }

        const saveAppointmentBtn = document.getElementById('saveAppointmentBtn');
        if (saveAppointmentBtn) {
            saveAppointmentBtn.addEventListener('click', function() {
                const form = document.getElementById('addAppointmentForm');
                const formData = new FormData(form);

                // تحويل FormData إلى كائن JSON
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });

                // إرسال البيانات باستخدام Fetch API
                fetch('{{ route("appointments.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // إغلاق المودال
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addAppointmentModal'));
                        modal.hide();

                        // عرض رسالة نجاح
                        alert('تم إضافة الموعد بنجاح');

                        // إعادة تحميل الصفحة بعد فترة قصيرة
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        // عرض رسائل الخطأ
                        alert('حدث خطأ أثناء إضافة الموعد');
                        console.error(data.errors);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء إضافة الموعد');
                });
            });
        }
    });

    // إضافة كود JavaScript لمعالجة عرض تفاصيل المريض
    document.addEventListener('DOMContentLoaded', function() {
        // تفعيل روابط تفاصيل المريض
        const patientLinks = document.querySelectorAll('.patient-details-link');
        patientLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const patientId = this.getAttribute('data-id');
                showPatientDetails(patientId);
            });
        });

        // وظيفة عرض تفاصيل المريض
        function showPatientDetails(patientId) {
            // في الحالة الحقيقية، يجب استدعاء API للحصول على بيانات المريض
            // لكن هنا سنستخدم بيانات ثابتة للعرض

            // يمكنك استبدال هذا بطلب AJAX للحصول على البيانات من الخادم
            // fetch(`/patients/${patientId}/appointment-details`)
            //    .then(response => response.json())
            //    .then(data => {
            //        // تعبئة البيانات في المودال
            //    });

            // عرض المودال
            const patientDetailsModal = new bootstrap.Modal(document.getElementById('patientDetailsModal'));
            patientDetailsModal.show();

            // تفعيل أزرار المودال
            document.getElementById('editAppointmentBtn').addEventListener('click', function() {
                // تنفيذ إجراء التعديل
                patientDetailsModal.hide();
                // يمكن فتح مودال التعديل هنا
            });

            document.getElementById('deleteAppointmentBtn').addEventListener('click', function() {
                if (confirm('هل أنت متأكد من حذف هذا الموعد؟')) {
                    // تنفيذ إجراء الحذف
                    // fetch(`/appointments/${appointmentId}`, {
                    //    method: 'DELETE',
                    //    headers: {
                    //        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    //    }
                    // })
                    // .then(response => response.json())
                    // .then(data => {
                    //    if (data.success) {
                    //        window.location.reload();
                    //    }
                    // });
                }
            });

            // تفعيل أزرار الصور
            document.getElementById('dental-images-btn').addEventListener('click', function() {
                // عرض صور الأسنان
                alert('عرض صور الأسنان');
            });

            document.getElementById('xray-images-btn').addEventListener('click', function() {
                // عرض صور الأشعة
                alert('عرض صور الأشعة');
            });
        }
    });
</script>
@endsection

