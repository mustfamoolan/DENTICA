@extends('layouts.patient')

@section('title', 'الملف الشخصي للمريض')

@section('content')
<div class="patient-profile-container">
    <div class="profile-column">
        <!-- بطاقة معلومات المريض مع الصورة -->
        <div class="patient-card">
            <div class="patient-avatar">
                <img src="{{ asset($patient->gender == 'female' ? 'images/22.png' : 'images/11.png') }}" alt="{{ $patient->full_name }}">
            </div>
            <div class="patient-name">{{ $patient->full_name }}</div>
            <div class="patient-age">{{ $patient->age }} سنة</div>
            <div class="patient-actions">
                <a href="#" class="edit-photo">تعديل الصورة</a>
                <a href="#" class="remove-photo">إزالة الصور</a>
            </div>
        </div>

        <!-- بطاقة معلومات المريض التفصيلية -->
        <div class="patient-details-card">
            <div class="detail-row">
                <div class="detail-label">اسم المريض الكامل:</div>
                <div class="detail-value">{{ $patient->full_name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">العمـــر:</div>
                <div class="detail-value">{{ $patient->age }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">الجنـس:</div>
                <div class="detail-value">{{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">رقم الهاتف:</div>
                <div class="detail-value">{{ $patient->phone_number }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">الوظيفة:</div>
                <div class="detail-value">{{ $patient->occupation ?: 'UI / UX Designer' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">رقم السجل الطبي:</div>
                <div class="detail-value">{{ $patient->patient_number }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">تاريخ الإضافة:</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($patient->registration_date)->format('Y.m.d') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">وقت الإضافة:</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($patient->registration_time)->format('h:i A') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">عدد الزيارات الكلي:</div>
                <div class="detail-value">{{ $patient->appointments ? $patient->appointments->count() : '0' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">تاريخ آخر زيارة:</div>
                <div class="detail-value">{{ $patient->appointments && $patient->appointments->count() > 0 ? \Carbon\Carbon::parse($patient->appointments->sortByDesc('appointment_date')->first()->appointment_date)->format('Y.m.d') : '2024.10.10' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">الحالة الحالية:</div>
                <div class="detail-value">مستمرة</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">الأمراض المزمنة:</div>
                <div class="detail-value">{{ $patient->chronicDiseases->count() > 0 ? $patient->chronicDiseases->pluck('name')->implode(', ') : 'لا يوجد' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">الحساسية:</div>
                <div class="detail-value">{{ $patient->allergies->count() > 0 ? $patient->allergies->pluck('name')->implode(', ') : 'لا يوجد' }}</div>
            </div>

            <button class="edit-info-btn">تعديل المعلومات</button>
        </div>
    </div>

    <div class="appointments-column">
        <!-- قائمة آخر المواعيد -->
        <div class="appointments-card">
            <h3 class="appointments-title">آخــر المواعيد</h3>
            <div class="appointments-table-container">
                <table class="appointments-table">
                    <thead>
                        <tr>
                            <th>منذ</th>
                            <th>التاريــخ</th>
                            <th>وقت الموعد</th>
                            <th>عنوان الموعد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // التأكد من تحميل المواعيد مباشرة من قاعدة البيانات
                            $patientAppointments = \App\Models\Appointment::where('patient_id', $patient->id)
                                ->orderBy('appointment_date', 'desc')
                                ->take(8)
                                ->get();
                        @endphp

                        @if($patientAppointments->count() > 0)
                            @foreach($patientAppointments as $appointment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y/m/d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                <td class="appointment-title-cell">
                                    <span class="appointment-title">
                                        <i class="fas fa-{{ $appointment->status == 'completed' ? 'check' : 'lock' }}"></i>
                                        {{ $appointment->session_type ?: 'موعد عام' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">لا توجد مواعيد سابقة لهذا المريض</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="add-appointment-container">
                <a href="{{ route('appointments.index', ['patient_id' => $patient->id]) }}" class="add-appointment-btn">
                    <i class="fas fa-plus"></i>
                    إضافة موعد
                </a>
            </div>
        </div>

        <div class="cards-row">
            <!-- قائمة الحساسية -->
            <div class="allergies-card">
                <div class="allergies-header">
                    <h3 class="allergies-title">الحساسية</h3>
                    <a href="#" class="add-allergy-btn">إضافــة</a>
                </div>
                <div class="allergies-table-container">
                    <table class="allergies-table">
                        <thead>
                            <tr>
                                <th>ت</th>
                                <th>اسم الدواء</th>
                                <th>مستوى الخطورة</th>
                                <th>ملاحظات</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 4; $i++)
                            <tr>
                                <td class="allergy-number">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>البنسلين</td>
                                <td>عادي</td>
                                <td>—</td>
                                <td class="actions-cell">
                                    <a href="#" class="delete-btn"><i class="fas fa-trash"></i></a>
                                    <a href="#" class="edit-btn"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- قائمة الملاحظات -->
            <div class="notes-card">
                <div class="notes-header">
                    <h3 class="notes-title">مُلاحظات</h3>
                    <a href="#" class="add-note-btn">إضافــة</a>
                </div>
                <div class="notes-list">
                    @for($i = 0; $i < 3; $i++)
                    <div class="note-item">
                        <div class="note-content">
                            <div class="note-title">علاج التهاب اللثة</div>
                            <div class="note-date">2024/12/6</div>
                        </div>
                        <div class="note-actions">
                            <a href="#" class="delete-btn"><i class="fas fa-trash"></i></a>
                            <a href="#" class="edit-btn"><i class="fas fa-edit"></i></a>
                            <span class="note-number">1</span>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .patient-profile-container {
        padding: 20px;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        margin-right: 20px;
        gap: 20px;
    }

    .profile-column {
        display: flex;
        flex-direction: column;
    }

    .appointments-column {
        flex: 0 0 auto;
        width: 776px;
    }

    .cards-row {
        display: flex;
        gap: 20px;
    }

    /* بطاقة معلومات المريض مع الصورة */
    .patient-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 20px;
        text-align: center;
        width: 368px;
    }

    .patient-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 15px;
        background-color: #cfe2f3;
    }

    .patient-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .patient-name {
        font-size: 24px;
        font-weight: bold;
        color: #1e5a7e;
        margin-bottom: 5px;
    }

    .patient-age {
        font-size: 16px;
        color: #777;
        margin-bottom: 20px;
    }

    .patient-actions {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .edit-photo {
        color: #3498db;
        text-decoration: none;
    }

    .remove-photo {
        color: #e74c3c;
        text-decoration: none;
    }

    /* بطاقة معلومات المريض التفصيلية */
    .patient-details-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        width: 368px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-label {
        color: #1e5a7e;
        font-weight: 600;
        text-align: right;
        width: 150px;
    }

    .detail-value {
        color: #333;
        text-align: right;
        width: 150px;
    }

    .edit-info-btn {
        background-color: #1e5a7e;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 12px;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
    }

    .edit-info-btn:hover {
        background-color: #174a66;
    }

    /* قائمة آخر المواعيد */
    .appointments-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        width: 776px;
        margin-bottom: 20px;
    }

    .appointments-title {
        color: #1e5a7e;
        font-size: 20px;
        margin-top: 0;
        margin-bottom: 20px;
        text-align: right;
    }

    .appointments-table-container {
        overflow-x: auto;
    }

    .appointments-table {
        width: 100%;
        border-collapse: collapse;
    }

    .appointments-table th {
        color: #1e5a7e;
        font-weight: 600;
        padding: 12px 15px;
        text-align: right;
        border-bottom: 1px solid #eee;
    }

    .appointments-table td {
        padding: 12px 15px;
        text-align: right;
        border-bottom: 1px solid #f0f0f0;
    }

    .appointment-title-cell {
        position: relative;
    }

    .appointment-title {
        display: flex;
        align-items: center;
        color: #1e5a7e;
    }

    .appointment-title i {
        margin-left: 8px;
        color: #1e5a7e;
    }

    .add-appointment-container {
        margin-top: 20px;
        text-align: center;
    }

    .add-appointment-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px;
        background-color: transparent;
        border: 1px dashed #1e5a7e;
        border-radius: 5px;
        color: #1e5a7e;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
    }

    .add-appointment-btn i {
        margin-left: 8px;
    }

    /* قائمة الحساسية */
    .allergies-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        width: 378px;
    }

    .allergies-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .allergies-title {
        color: #e74c3c;
        font-size: 20px;
        margin: 0;
        text-align: right;
    }

    .add-allergy-btn {
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 15px;
        text-decoration: none;
        font-size: 14px;
    }

    .allergies-table-container {
        overflow-x: auto;
    }

    .allergies-table {
        width: 100%;
        border-collapse: collapse;
    }

    .allergies-table th {
        color: #555;
        font-weight: 600;
        padding: 12px 15px;
        text-align: right;
        border-bottom: 1px solid #eee;
    }

    .allergies-table td {
        padding: 12px 15px;
        text-align: right;
        border-bottom: 1px solid #f0f0f0;
    }

    .allergy-number {
        color: #777;
    }

    /* قائمة الملاحظات */
    .notes-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        width: 378px;
    }

    .notes-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .notes-title {
        color: #1e5a7e;
        font-size: 20px;
        margin: 0;
        text-align: right;
    }

    .add-note-btn {
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 15px;
        text-decoration: none;
        font-size: 14px;
    }

    .notes-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .note-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .note-content {
        flex: 1;
    }

    .note-title {
        color: #1e5a7e;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .note-date {
        color: #777;
        font-size: 12px;
    }

    .note-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .note-number {
        display: inline-block;
        width: 24px;
        height: 24px;
        background-color: #f0f0f0;
        border-radius: 50%;
        text-align: center;
        line-height: 24px;
        font-size: 12px;
        color: #555;
    }

    .actions-cell {
        white-space: nowrap;
    }

    .actions-cell .delete-btn,
    .actions-cell .edit-btn,
    .note-actions .delete-btn,
    .note-actions .edit-btn {
        display: inline-block;
        margin: 0 5px;
        color: #e74c3c;
        text-decoration: none;
    }

    .actions-cell .edit-btn,
    .note-actions .edit-btn {
        color: #3498db;
    }

    /* تعديل موضع المحتوى ليكون بالقرب من السلايدر */
    .content-area {
        display: flex;
        justify-content: flex-start;
        padding-right: 0;
    }
</style>
@endsection
