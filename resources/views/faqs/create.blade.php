@extends('layouts.master')
@section('title', 'إضافة سؤال شائع')

@section('css')
<style>
    .faq-form-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 25px;
    }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border
            d-flex justify-content-between align-items-center flex-wrap gap-3"
     style="direction: rtl;">

    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary">
            <i class="bx bx-help-circle"></i> إضافة سؤال شائع
        </h4>
        <small class="text-muted">إدخال سؤال وإجابته (عربي / إنجليزي)</small>
    </div>

    <a href="{{ route('faqs.index') }}"
       class="btn btn-secondary btn-sm d-flex align-items-center gap-1">
        <i class="bx bx-arrow-back fs-5"></i>
        <span>رجوع</span>
    </a>
</div>
@endsection

@section('content')
<div class="faq-form-card">
<form action="{{ route('faqs.store') }}" method="POST">
@csrf

{{-- ================= السؤال ================= --}}
<div class="mb-3">
    <label class="form-label">السؤال (عربي)</label>
    <input type="text"
           name="question_ar"
           class="form-control"
           placeholder="أدخل السؤال باللغة العربية"
           required>
</div>

<div class="mb-3">
    <label class="form-label">السؤال (إنجليزي)</label>
    <input type="text"
           name="question_en"
           class="form-control"
           placeholder="Enter the question in English">
</div>

{{-- ================= الإجابة ================= --}}
<div class="mb-3">
    <label class="form-label">الإجابة (عربي)</label>
    <textarea name="answer_ar"
              class="form-control"
              rows="4"
              placeholder="أدخل الإجابة باللغة العربية"></textarea>
</div>

<div class="mb-3">
    <label class="form-label">الإجابة (إنجليزي)</label>
    <textarea name="answer_en"
              class="form-control"
              rows="4"
              placeholder="Enter the answer in English"></textarea>
</div>

{{-- ================= الترتيب والحالة ================= --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">ترتيب الظهور</label>
        <input type="number"
               name="sort_order"
               class="form-control"
               value="0">
    </div>

    <div class="col-md-6 mb-3 d-flex align-items-center">
        <div class="form-check mt-4">
            <input class="form-check-input"
                   type="checkbox"
                   name="is_active"
                   value="1"
                   checked>
            <label class="form-check-label">
                مفعل
            </label>
        </div>
    </div>
</div>

{{-- ================= الأزرار ================= --}}
<div class="d-flex justify-content-end gap-2 mt-4">
    <button type="submit"
            class="btn btn-primary"
            style="background-color:#c1953e;border:none;">
        <i class="bx bx-save"></i> حفظ
    </button>

    <a href="{{ route('faqs.index') }}"
       class="btn btn-light border">
        <i class="bx bx-x-circle"></i> إلغاء
    </a>
</div>

</form>
</div>
@endsection
