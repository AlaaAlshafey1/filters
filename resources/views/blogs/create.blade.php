@extends('layouts.master')
@section('title', 'إضافة مقال جديد')

@section('css')
<style>
.blog-form-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    padding: 25px;
}

.form-section-title {
    font-size: 16px;
    font-weight: 600;
    color: #0d6efd;
    margin-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 5px;
}

label.form-label { font-weight: 500; color: #333; }
input.form-control, textarea.form-control { border-radius: 10px; padding: 10px; }
.img-preview { max-width: 150px; border-radius: 10px; margin-bottom: 10px; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-news"></i> إضافة مقال جديد</h4>
        <small class="text-muted">قم بإدخال بيانات المقال الجديد</small>
    </div>
    <div>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back fs-5"></i> رجوع</a>
    </div>
</div>
@endsection

@section('content')
<div class="blog-form-card">
    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">عنوان المقال (عربي)</label>
            <input type="text" name="title_ar" class="form-control" placeholder="أدخل عنوان المقال بالعربي" required>
        </div>

        <div class="mb-3">
            <label class="form-label">عنوان المقال (إنجليزي)</label>
            <input type="text" name="title_en" class="form-control" placeholder="Enter Blog Title in English" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ملخص المقال (عربي)</label>
            <textarea name="excerpt_ar" class="form-control" rows="3" placeholder="أدخل ملخص قصير للمقال بالعربي"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">ملخص المقال (إنجليزي)</label>
            <textarea name="excerpt_en" class="form-control" rows="3" placeholder="Enter short excerpt in English"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">محتوى المقال (عربي)</label>
            <textarea name="content_ar" class="form-control" rows="6" placeholder="أدخل محتوى المقال بالعربي"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">محتوى المقال (إنجليزي)</label>
            <textarea name="content_en" class="form-control" rows="6" placeholder="Enter full content in English"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">صورة المقال</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
            <label class="form-check-label">مفعل</label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary" style="background-color:#c1953e; border:none;">
                <i class="bx bx-save"></i> حفظ المقال
            </button>
            <a href="{{ route('blogs.index') }}" class="btn btn-light border"><i class="bx bx-x-circle"></i> إلغاء</a>
        </div>
    </form>
</div>
@endsection
