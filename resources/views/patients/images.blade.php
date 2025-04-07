@extends('layouts.patient')

@section('title', 'صور وأشعة المريض')

@section('content')
<div class="patient-images">
    <h2 class="section-title">صور وأشعة المريض</h2>

    <div class="info-card">
        <div class="info-header">
            <h3>الصور والأشعة</h3>
            <button class="add-image-btn"><i class="fas fa-plus"></i> إضافة صورة جديدة</button>
        </div>
        <div class="info-body">
            <div class="empty-state">
                <i class="fas fa-images empty-icon"></i>
                <p>لا توجد صور أو أشعة للمريض حتى الآن</p>
                <button class="upload-btn">رفع صور جديدة</button>
            </div>

            <!-- هنا سيتم عرض الصور عند إضافتها -->
            <div class="images-grid" style="display: none;">
                <!-- مثال على صورة -->
                <div class="image-item">
                    <div class="image-container">
                        <img src="{{ asset('images/sample-xray.jpg') }}" alt="صورة أشعة">
                    </div>
                    <div class="image-info">
                        <h4>صورة أشعة بانوراما</h4>
                        <p>تاريخ الإضافة: 2023/10/15</p>
                        <div class="image-actions">
                            <button class="view-btn"><i class="fas fa-eye"></i></button>
                            <button class="delete-btn"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .patient-images {
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

    .add-image-btn {
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

    .add-image-btn i {
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

    .upload-btn {
        background-color: #1e5a7e;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .image-item {
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
    }

    .image-container {
        height: 180px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-info {
        padding: 10px;
    }

    .image-info h4 {
        margin: 0 0 5px;
        font-size: 16px;
        color: #333;
    }

    .image-info p {
        margin: 0 0 10px;
        font-size: 12px;
        color: #777;
    }

    .image-actions {
        display: flex;
        justify-content: flex-end;
    }

    .image-actions button {
        background: none;
        border: none;
        font-size: 14px;
        margin-right: 10px;
        cursor: pointer;
    }

    .view-btn {
        color: #1e5a7e;
    }

    .delete-btn {
        color: #dc3545;
    }
</style>
@endsection
