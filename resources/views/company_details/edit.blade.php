@extends('layouts.master')
@section('title', 'تعديل قسم الشركة')

@section('css')
<style>
.company-form-card { background-color: #fff; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px; }
.form-section-title { font-size: 16px; font-weight: 600; color: #0d6efd; margin-bottom: 15px; border-bottom: 2px solid #e9ecef; padding-bottom: 5px; }
input.form-control, textarea.form-control { border-radius: 10px; padding: 10px; }
.img-preview { max-width: 150px; margin-right: 10px; margin-bottom: 10px; border-radius: 10px; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-edit"></i> تعديل القسم</h4>
        <small class="text-muted">تحديث بيانات القسم</small>
    </div>
    <div>
        <a href="{{ route('company-details.index') }}" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back fs-5"></i> رجوع</a>
    </div>
</div>
@endsection

@section('content')
<div class="company-form-card">
    <form action="{{ route('company-details.update', $companyDetail->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">المفتاح الخاص بالقسم (section_key)</label>
            <input type="text" name="section_key" class="form-control" value="{{ $companyDetail->section_key }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان (عربي)</label>
            <input type="text" name="title_ar" class="form-control" value="{{ $companyDetail->title_ar }}">
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان (إنجليزي)</label>
            <input type="text" name="title_en" class="form-control" value="{{ $companyDetail->title_en }}">
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف (عربي)</label>
            <textarea name="description_ar" class="form-control" rows="4">{{ $companyDetail->description_ar }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف (إنجليزي)</label>
            <textarea name="description_en" class="form-control" rows="4">{{ $companyDetail->description_en }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">صور القسم الحالية</label>
            <div class="d-flex flex-wrap">
                @if($companyDetail->images)
                    @foreach($companyDetail->images as $img)
                        <img src="{{ asset('storage/'.$img) }}" class="img-preview">
                    @endforeach
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">إضافة صور جديدة</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label class="form-label">رابط فيديو</label>
            <input type="url" name="video_url" class="form-control" value="{{ $companyDetail->video_url }}">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $companyDetail->is_active ? 'checked' : '' }}>
            <label class="form-check-label">مفعل</label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary"><i class="bx bx-save"></i> حفظ التعديلات</button>
            <a href="{{ route('company-details.index') }}" class="btn btn-light border"><i class="bx bx-x-circle"></i> إلغاء</a>
        </div>
    </form>
</div>
@endsection
