@extends('layouts.patient')

@section('title', 'مواعيد المريض')

@section('content')
<div class="patient-appointments">
    <h2 class="section-title">مواعيد المريض</h2>

    <div class="info-card">
        <div class="info-header">
            <h3>المواعيد</h3>
            <button class="add-appointment-btn"><i class="fas fa-plus"></i> إضافة موعد جديد</button>
        </div>
        <div class="info-body">
            @if($appointments->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-calendar-alt empty-icon"></i>
                    <p>لا توجد مواعيد للمريض حتى الآن</p>
                    <button class="add-btn">إضافة موعد جديد</button>
                </div>
            @else
                <div class="appointments-table-container">
                    <table class="appointments-table">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>نوع الجلسة</th>
                                <th>الحالة</th>
                                <th>ملاحظات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y/m/d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                    <td>{{ $appointment->session_type ?? 'غير محدد' }}</td>
                                    <td>
                                        <span class="status-badge {{ $appointment->status == 'completed' ? 'completed' : ($appointment->status == 'cancelled' ? 'cancelled' : 'upcoming') }}">
                                            {{ $appointment->status == 'completed' ? 'مكتمل' : ($appointment->status == 'cancelled' ? 'ملغي' : 'قادم') }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($appointment->note, 30) }}</td>
                                    <td class="actions-cell">
                                        <a href="{{ route('appointments.edit', $appointment) }}" class="edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد من حذف هذا الموعد؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .patient-appointments {
        padding: 20px;
    }

    .section-title {
        color: #1e5a7e;
        margin-bottom: 20px;
        font-size: 24px;
        border-bottom: 2px solid #3ca99e;
        padding-bottom: 10px;
    }

    .info-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .info-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-header h3 {
        margin: 0;
        color: #1e5a7e;
        font-size: 18px;
    }

    .add-appointment-btn {
        background-color: #3ca99e;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .add-appointment-btn i {
        margin-left: 8px;
    }

    .info-body {
        padding: 20px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-icon {
        font-size: 60px;
        color: #ccc;
        margin-bottom: 20px;
    }

    .empty-state p {
        color: #777;
        margin-bottom: 20px;
    }

    .add-btn {
        background-color: #1e5a7e;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .appointments-table-container {
        overflow-x: auto;
    }

    .appointments-table {
        width: 100%;
        border-collapse: collapse;
    }

    .appointments-table th {
        background-color: #f8f9fa;
        color: #1e5a7e;
        font-weight: 600;
        text-align: right;
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
    }

    .appointments-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #f5f5f5;
    }

    .appointments-table tr:hover {
        background-color: #f9f9f9;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge.completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-badge.cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-badge.upcoming {
        background-color: #cce5ff;
        color: #004085;
    }

    .actions-cell {
        white-space: nowrap;
    }

    .edit-btn, .delete-btn {
        background: none;
        border: none;
        font-size: 14px;
        margin-right: 10px;
        cursor: pointer;
    }

    .edit-btn {
        color: #1e5a7e;
    }

    .delete-btn {
        color: #dc3545;
    }
</style>
@endsection
