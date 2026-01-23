@extends('layouts.master')
@section('title', 'إضافة قسم للشركة')

@section('css')
<style>
.company-form-card { background-color: #fff; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px; }
.form-section-title { font-size: 16px; font-weight: 600; color: #0d6efd; margin-bottom: 15px; border-bottom: 2px solid #e9ecef; padding-bottom: 5px; }
input.form-control, textarea.form-control { border-radius: 10px; padding: 10px; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-plus-circle"></i> إضافة قسم للشركة</h4>
        <small class="text-muted">أدخل بيانات القسم الجديد</small>
    </div>
    <div>
        <a href="{{ route('company-details.index') }}" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back fs-5"></i> رجوع</a>
    </div>
</div>
@endsection

@section('content')
<div class="company-form-card">
    <form action="{{ route('company-details.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">المفتاح الخاص بالقسم (section_key)</label>
            <input type="text" name="section_key" class="form-control" placeholder="مثل: vision, mission, values, what_we_do" required>
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان (عربي)</label>
            <input type="text" name="title_ar" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان (إنجليزي)</label>
            <input type="text" name="title_en" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف (عربي)</label>
            <textarea name="description_ar" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف (إنجليزي)</label>
            <textarea name="description_en" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">صور القسم</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label class="form-label">رابط فيديو (اختياري)</label>
            <input type="url" name="video_url" class="form-control" placeholder="https://youtube.com/...">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
            <label class="form-check-label">مفعل</label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary"><i class="bx bx-save"></i> حفظ</button>
            <a href="{{ route('company-details.index') }}" class="btn btn-light border"><i class="bx bx-x-circle"></i> إلغاء</a>
        </div>
    </form>
</div>
@endsection
