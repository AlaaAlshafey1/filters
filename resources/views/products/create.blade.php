@extends('layouts.master')
@section('title', 'إضافة منتج جديد')

@section('css')
<style>
    .product-form-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 25px;
    }
    .form-section-title {
        font-size: 16px;
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 10px;
        cursor: pointer;
    }
    .section-content {
        display: none;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        padding: 15px;
        border-radius: 10px;
    }
    .repeater-item {
        border: 1px dashed #ddd;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
    }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div>
        <h4 class="fw-bold text-primary">
            <i class="bx bx-plus-circle"></i> إضافة منتج جديد
        </h4>
        <small class="text-muted">قم بإدخال بيانات المنتج</small>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
        <i class="bx bx-arrow-back"></i> رجوع
    </a>
</div>
@endsection

@section('content')
<div class="product-form-card">
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- ================= البيانات الأساسية ================= --}}
<div class="mb-3">
    <label class="form-label">اسم المنتج (عربي)</label>
    <input type="text" name="name_ar" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">اسم المنتج (إنجليزي)</label>
    <input type="text" name="name_en" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">الوصف العام (عربي)</label>
    <textarea name="description_ar" class="form-control" rows="4"></textarea>
</div>

<div class="mb-3">
    <label class="form-label">الوصف العام (إنجليزي)</label>
    <textarea name="description_en" class="form-control" rows="4"></textarea>
</div>

<div class="mb-3">
    <label class="form-label">الفئة</label>
    <select name="category_id" class="form-select" required>
        <option value="">اختر الفئة</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
        @endforeach
    </select>
</div>
{{-- ================= Technology ================= --}}
<div class="mb-3">
    <label class="form-label">هل هذا منتج تكنولوجي؟</label>
    <select name="is_tecnology" class="form-select">
        <option value="0">لا</option>
        <option value="1">نعم</option>
    </select>
</div>

{{-- ================= الصورة الرئيسية ================= --}}
<div class="mb-3">
    <label class="form-label">الصورة الرئيسية (Hero)</label>
    <input type="file" name="main_image" class="form-control" accept="image/*">
</div>

{{-- ================= الصور الإضافية ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('gallery')">
        صور إضافية (Gallery)
    </div>

    <div class="section-content" id="gallery">
        <div id="gallery-repeater">
            <div class="repeater-item">
                <input type="file" name="images[]" class="form-control" accept="image/*">
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-info" onclick="addGalleryImage()">
            إضافة صورة
        </button>
    </div>
</div>

{{-- ================= Eco Efficiency ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('eco')">
        Telas eco-eficientes
    </div>

    <div class="section-content" id="eco">
        <textarea name="eco_description" class="form-control ckeditor" rows="5"></textarea>
    </div>
</div>

{{-- ================= Finishes ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('finishes')">
        Acabados
    </div>

    <div class="section-content" id="finishes">
        <textarea name="finishes_description" class="form-control ckeditor" rows="5"></textarea>
    </div>
</div>

{{-- ================= PDFs ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('pdfs')">
        ملفات PDF (Croquis)
    </div>

    <div class="section-content" id="pdfs">
        <div class="mb-2">
            <label>Croquis de placa abierta (PDF)</label>
            <input type="file" name="pdf_open_plate" class="form-control" accept="application/pdf">
        </div>

        <div class="mb-2">
            <label>Croquis de placa con agujero desplazado (PDF)</label>
            <input type="file" name="pdf_offset_hole" class="form-control" accept="application/pdf">
        </div>

        <div class="mb-2">
            <label>Croquis de placa cerrada (PDF)</label>
            <input type="file" name="pdf_closed_plate" class="form-control" accept="application/pdf">
        </div>
    </div>
</div>

{{-- ================= أزرار الحفظ ================= --}}
<div class="d-flex justify-content-end gap-2 mt-4">
    <button type="submit" class="btn btn-primary" style="background:#c1953e;border:none">
        <i class="bx bx-save"></i> حفظ المنتج
    </button>
    <a href="{{ route('products.index') }}" class="btn btn-light border">
        إلغاء
    </a>
</div>

</form>
</div>
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
function toggleSection(id) {
    let el = document.getElementById(id);
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

function addGalleryImage() {
    let container = document.getElementById('gallery-repeater');
    let div = document.createElement('div');
    div.classList.add('repeater-item');
    div.innerHTML = `<input type="file" name="images[]" class="form-control" accept="image/*">`;
    container.appendChild(div);
}

document.querySelectorAll('.ckeditor').forEach(el => {
    ClassicEditor.create(el).catch(err => console.error(err));
});
</script>
@endsection
