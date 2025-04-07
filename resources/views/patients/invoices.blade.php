@extends('layouts.patient')

@section('title', 'فواتير المريض')

@section('content')
<div class="patient-invoices">
    <h2 class="section-title">فواتير المريض</h2>

    <div class="info-card">
        <div class="info-header">
            <h3>الفواتير</h3>
            <button class="add-invoice-btn"><i class="fas fa-plus"></i> إضافة فاتورة جديدة</button>
        </div>
        <div class="info-body">
            @if($invoices->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-file-invoice-dollar empty-icon"></i>
                    <p>لا توجد فواتير للمريض حتى الآن</p>
                    <button class="add-btn">إضافة فاتورة جديدة</button>
                </div>
            @else
                <div class="invoices-table-container">
                    <table class="invoices-table">
                        <thead>
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>التاريخ</th>
                                <th>نوع الفاتورة</th>
                                <th>المبلغ الإجمالي</th>
                                <th>المبلغ المدفوع</th>
                                <th>المبلغ المتبقي</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>#{{ $invoice->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($invoice->issue_date)->format('Y/m/d') }}</td>
                                    <td>{{ $invoice->invoice_type }}</td>
                                    <td>{{ $invoice->amount }} د.ع</td>
                                    <td>{{ $invoice->paid_amount }} د.ع</td>
                                    <td>{{ $invoice->amount - $invoice->paid_amount }} د.ع</td>
                                    <td>
                                        <span class="status-badge {{ $invoice->amount <= $invoice->paid_amount ? 'paid' : 'unpaid' }}">
                                            {{ $invoice->amount <= $invoice->paid_amount ? 'مدفوعة' : 'غير مدفوعة' }}
                                        </span>
                                    </td>
                                    <td class="actions-cell">
                                        <a href="{{ route('invoices.show', $invoice) }}" class="view-btn">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('invoices.edit', $invoice) }}" class="edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('هل أنت متأكد من حذف هذه الفاتورة؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="invoice-summary">
                    <div class="summary-item">
                        <div class="summary-label">إجمالي الفواتير:</div>
                        <div class="summary-value">{{ $invoices->sum('amount') }} د.ع</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">إجمالي المدفوعات:</div>
                        <div class="summary-value">{{ $invoices->sum('paid_amount') }} د.ع</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">إجمالي المتبقي:</div>
                        <div class="summary-value">{{ $invoices->sum('amount') - $invoices->sum('paid_amount') }} د.ع</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .patient-invoices {
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

    .add-invoice-btn {
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

    .add-invoice-btn i {
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

    .invoices-table-container {
        overflow-x: auto;
    }

    .invoices-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoices-table th {
        background-color: #f8f9fa;
        color: #1e5a7e;
        font-weight: 600;
        text-align: right;
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
    }

    .invoices-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #f5f5f5;
    }

    .invoices-table tr:hover {
        background-color: #f9f9f9;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge.paid {
        background-color: #d4edda;
        color: #155724;
    }

    .status-badge.unpaid {
        background-color: #f8d7da;
        color: #721c24;
    }

    .actions-cell {
        white-space: nowrap;
    }

    .view-btn, .edit-btn, .delete-btn {
        background: none;
        border: none;
        font-size: 14px;
        margin-right: 10px;
        cursor: pointer;
    }

    .view-btn {
        color: #17a2b8;
    }

    .edit-btn {
        color: #1e5a7e;
    }

    .delete-btn {
        color: #dc3545;
    }

    .invoice-summary {
        margin-top: 30px;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .summary-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .summary-label {
        font-weight: 600;
        color: #555;
    }

    .summary-value {
        font-weight: 700;
        color: #1e5a7e;
    }
</style>
@endsection
