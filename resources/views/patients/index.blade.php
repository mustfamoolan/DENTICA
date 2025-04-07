@extends('layouts.app')

@section('title', 'قائمة المرضى')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .patients-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 30px;
    }

    .patients-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .patients-header h2 {
        color: #22577A;
        font-size: 24px;
        font-weight: 600;
        margin: 0;
        font-family: 'Alexandria', sans-serif;
    }

    .search-form {
        display: flex;
        margin-bottom: 20px;
    }

    .search-form input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px 0 0 8px;
        font-family: 'Alexandria', sans-serif;
    }

    .search-form button {
        background-color: #22577A;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
    }

    .patients-table {
        width: 100%;
        border-collapse: collapse;
    }

    .patients-table th, .patients-table td {
        padding: 12px 15px;
        text-align: right;
        border-bottom: 1px solid #eee;
    }

    .patients-table th {
        background-color: #f8f9fa;
        color: #22577A;
        font-weight: 600;
        font-family: 'Alexandria', sans-serif;
    }

    .patients-table tr:hover {
        background-color: #f8f9fa;
    }

    .patient-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .patient-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .actions-cell {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .view-btn, .edit-btn, .delete-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
    }

    .view-btn {
        background-color: #38A3A5;
    }

    .edit-btn {
        background-color: #57CC99;
    }

    .delete-btn {
        background-color: #FF5C58;
    }

    .view-btn:hover, .edit-btn:hover, .delete-btn:hover {
        opacity: 0.9;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 5px;
    }

    .pagination .page-item {
        list-style: none;
    }

    .pagination .page-link {
        display: block;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #22577A;
        text-decoration: none;
    }

    .pagination .active .page-link {
        background-color: #22577A;
        color: white;
        border-color: #22577A;
    }

    .add-patient-btn {
        background-color: #22577A;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: 'Alexandria', sans-serif;
    }

    .add-patient-btn:hover {
        background-color: #1a4d6d;
        color: white;
    }

    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .tag {
        background-color: #e1ebfa;
        color: #22577A;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="patients-container">
                <div class="patients-header">
                    <h2>قائمة المرضى</h2>
                    <a href="{{ route('patients.create') }}" class="add-patient-btn">
                        <i class="fas fa-plus"></i>
                        إضافة مريض جديد
                    </a>
                </div>

                <form action="{{ route('patients.search') }}" method="GET" class="search-form">
                    <input type="text" name="query" placeholder="ابحث عن مريض بالاسم أو رقم الهاتف..." value="{{ $query ?? '' }}">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="patients-table">
                        <thead>
                            <tr>
                                <th>رقم</th>
                                <th>الصورة</th>
                                <th>اسم المريض</th>
                                <th>العمر</th>
                                <th>رقم الهاتف</th>
                                <th>الأمراض المزمنة</th>
                                <th>الحساسية</th>
                                <th>تاريخ التسجيل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patients as $patient)
                                <tr>
                                    <td>{{ $patient->patient_number }}</td>
                                    <td>
                                        <div class="patient-avatar">
                                            <img src="{{ asset($patient->gender == 'male' ? 'images/11.png' : 'images/22.png') }}" alt="{{ $patient->full_name }}">
                                        </div>
                                    </td>
                                    <td>{{ $patient->full_name }}</td>
                                    <td>{{ $patient->age }}</td>
                                    <td>{{ $patient->phone_number }}</td>
                                    <td>
                                        <div class="tags-container">
                                            @foreach($patient->chronicDiseases as $disease)
                                                <span class="tag">{{ $disease->name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tags-container">
                                            @foreach($patient->allergies as $allergy)
                                                <span class="tag">{{ $allergy->name }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ $patient->registration_date->format('Y-m-d') }}</td>
                                    <td class="actions-cell">
                                        <a href="{{ route('patients.show', $patient) }}" class="view-btn" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('patients.edit', $patient) }}" class="edit-btn" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا المريض؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">لا يوجد مرضى</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    {{ $patients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // إعدادات toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "rtl": true
    };

    // عرض رسائل النجاح
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    // عرض رسائل الخطأ
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endsection
