@extends('layouts.master')
@section('title', 'إضافة قطاع جديد')

@section('css')
<style>
.form-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    padding: 30px;
}
label.form-label { font-weight: 600; color: #444; margin-bottom: 8px; }
input.form-control, textarea.form-control { border-radius: 10px; padding: 12px; border: 1px solid #ddd; }
input.form-control:focus, textarea.form-control:focus { border-color: #c1953e; box-shadow: 0 0 0 0.2rem rgba(193, 149, 62, 0.25); }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-plus-circle"></i> إضافة قطاع جديد</h4>
        <small class="text-muted">قم بإدخال بيانات القطاع الجديد</small>
    </div>
    <div>
        <a href="{{ route('sectors.index') }}" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back fs-5"></i> رجوع</a>
    </div>
</div>
@endsection

@section('content')
<div class="form-card mx-auto" style="max-width: 800px;">
    <form action="{{ route('sectors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">عنوان القطاع (عربي) <span class="text-danger">*</span></label>
                <input type="text" name="title_ar" class="form-control" placeholder="مثال: قطاع الفلاتر" required>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">عنوان القطاع (إنجليزي) <span class="text-danger">*</span></label>
                <input type="text" name="title_en" class="form-control" placeholder="Example: Filters Sector" required style="direction: ltr;">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">محتوى القطاع (عربي)</label>
            <textarea name="desc_ar" class="form-control" rows="4" placeholder="أدخل وصفاً تفصيلياً للقطاع..."></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">محتوى القطاع (إنجليزي)</label>
            <textarea name="desc_en" class="form-control" rows="4" placeholder="Enter detailed description in English..." style="direction: ltr;"></textarea>
        </div>

        <div class="mb-5">
            <label class="form-label">صورة القطاع</label>
            <div class="input-group">
                <input type="file" name="image" class="form-control" id="inputGroupFile02" accept="image/*">
                <label class="input-group-text" for="inputGroupFile02" style="background-color: #c1953e; color: white; border: none;">رفع</label>
            </div>
            <small class="text-muted">يفضل استخدام صور عالية الجودة (PNG, JPG, WebP)</small>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <button type="submit" class="btn btn-primary px-4 py-2" style="background-color:#c1953e; border:none; border-radius: 8px;">
                <i class="bx bx-save"></i> حفظ القطاع
            </button>
            <a href="{{ route('sectors.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px;"><i class="bx bx-x-circle"></i> إلغاء</a>
        </div>
    </form>
</div>
@endsection
