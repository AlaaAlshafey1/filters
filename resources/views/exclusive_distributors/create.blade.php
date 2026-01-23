@extends('layouts.master')
@section('title', 'إضافة موزع حصري')

@section('css')
<style>
    .form-card{
        background:#fff;
        border-radius:15px;
        box-shadow:0 2px 10px rgba(0,0,0,.05);
        padding:25px
    }
    .section-title{
        font-size:16px;
        font-weight:600;
        color:#0d6efd;
        margin-bottom:15px;
        border-bottom:2px solid #e9ecef;
        padding-bottom:5px
    }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center" style="direction:rtl">
    <div>
        <h4 class="fw-bold text-primary"><i class="bx bx-store"></i> إضافة موزع حصري</h4>
        <small class="text-muted">إدخال بيانات الموزع الحصري</small>
    </div>
    <a href="{{ route('exclusive-distributors.index') }}" class="btn btn-secondary btn-sm">
        <i class="bx bx-arrow-back"></i> رجوع
    </a>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('exclusive-distributors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- العنوان --}}
            <h6 class="mb-3 text-primary">العنوان</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان (عربي)</label>
                    <input type="text" name="title_ar" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان (إنجليزي)</label>
                    <input type="text" name="title_en" class="form-control">
                </div>
            </div>

            {{-- العنوان الفرعي --}}
            <h6 class="mb-3 text-primary">العنوان الفرعي</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="subtitle_ar" class="form-control"
                           placeholder="العنوان الفرعي (عربي)">
                </div>

                <div class="col-md-6 mb-3">
                    <input type="text" name="subtitle_en" class="form-control"
                           placeholder="Subtitle (English)">
                </div>
            </div>

            {{-- الوصف --}}
            <h6 class="mb-3 text-primary">الوصف</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <textarea name="description_ar" class="form-control" rows="4"
                              placeholder="الوصف بالعربية"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <textarea name="description_en" class="form-control" rows="4"
                              placeholder="Description in English"></textarea>
                </div>
            </div>

            {{-- الصورة --}}
            <div class="mb-3">
                <label class="form-label">الصورة</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- التفعيل --}}
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                <label class="form-check-label">مفعل</label>
            </div>

            {{-- أزرار --}}
            <button class="btn btn-primary">حفظ</button>
            <a href="{{ route('exclusive-distributors.index') }}" class="btn btn-secondary">
                رجوع
            </a>

        </form>

    </div>
</div>
@endsection

