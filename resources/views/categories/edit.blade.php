@extends('layouts.master')
@section('title', 'تعديل الفئة')

@section('css')
<style>
.category-form-card { background-color: #fff; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px; }
.form-section-title { font-size: 16px; font-weight: 600; color: #0d6efd; margin-bottom: 15px; border-bottom: 2px solid #e9ecef; padding-bottom: 5px; }
label.form-label { font-weight: 500; color: #333; }
input.form-control, select.form-select { border-radius: 10px; padding: 10px 14px; min-height: 45px; width: 100%; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-edit"></i> تعديل الفئة</h4>
        <small class="text-muted">قم بتحديث بيانات الفئة</small>
    </div>
    <div>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center gap-1">
            <i class="bx bx-arrow-back fs-5"></i> <span>رجوع</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="category-form-card">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-section mb-4">
            <h6 class="form-section-title">📦 معلومات الفئة</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">اسم الفئة (عربي)</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $category->name_ar }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">اسم الفئة (إنجليزي)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $category->name_en }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">الفئة الأصلية (اختياري)</label>
                    <select name="parent_id" class="form-select">
                        <option value="">بدون فئة أصلية</option>
                        @foreach($categories as $parent)
                            <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">وصف الفئة (عربي)</label>
                    <textarea name="description_ar" class="form-control" rows="4">
                {{ $category->description_ar }}</textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label">وصف الفئة (English)</label>
                    <textarea name="description_en" class="form-control" rows="4">
                {{ $category->description_en }}</textarea>
                </div>

            <div class="col-md-12">
                <label class="form-label">صورة الفئة</label>

                @if($category->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$category->image) }}"
                            width="120" class="rounded border">
                    </div>
                @endif

                <input type="file" name="image" class="form-control">
            </div>
            
            <div class="col-md-12 mt-3">
                <div class="form-check">
                    <input type="checkbox" name="is_home" class="form-check-input" id="is_home"
                        value="1" {{ old('is_home', $category->is_home ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_home">عرض في الصفحة الرئيسية</label>
                </div>
            </div>

            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary" style="background-color:#c1953e; border:none;">
                <i class="bx bx-save"></i> حفظ التعديلات
            </button>
            <a href="{{ route('categories.index') }}" class="btn btn-light border">
                <i class="bx bx-x-circle"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection
