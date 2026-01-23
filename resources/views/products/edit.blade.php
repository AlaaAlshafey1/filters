@extends('layouts.master')
@section('title', 'تعديل المنتج')

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
    .img-box {
        position: relative;
        display: inline-block;
        margin: 5px;
    }
    .img-box img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center">
    <div>
        <h4 class="fw-bold text-primary">
            <i class="bx bx-edit"></i> تعديل المنتج
        </h4>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
        رجوع
    </a>
</div>
@endsection

@section('content')
<div class="product-form-card">

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- ================= البيانات الأساسية ================= --}}
<div class="mb-3">
    <label class="form-label">اسم المنتج (عربي)</label>
    <input type="text" name="name_ar" class="form-control" value="{{ $product->name_ar }}" required>
</div>

<div class="mb-3">
    <label class="form-label">اسم المنتج (إنجليزي)</label>
    <input type="text" name="name_en" class="form-control" value="{{ $product->name_en }}">
</div>

<div class="mb-3">
    <label class="form-label">الوصف العام (عربي)</label>
    <textarea name="description_ar" class="form-control" rows="4">{{ $product->description_ar }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">الوصف العام (إنجليزي)</label>
    <textarea name="description_en" class="form-control" rows="4">{{ $product->description_en }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">الفئة</label>
    <select name="category_id" class="form-select" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name_ar }}
            </option>
        @endforeach
    </select>
</div>
{{-- ================= Technology ================= --}}
<div class="mb-3">
    <label class="form-label">هل هذا منتج تكنولوجي؟</label>
    <select name="is_tecnology" class="form-select">
        <option value="0" {{ $product->is_tecnology == 0 ? 'selected' : '' }}>لا</option>
        <option value="1" {{ $product->is_tecnology == 1 ? 'selected' : '' }}>نعم</option>
    </select>
</div>

{{-- ================= الصورة الرئيسية ================= --}}
<div class="mb-3">
    <label class="form-label">الصورة الرئيسية</label><br>

    @if($product->main_image)
        <img src="{{ asset('storage/'.$product->main_image) }}" width="120" class="mb-2 rounded border">
    @endif

    <input type="file" name="main_image" class="form-control" accept="image/*">
</div>

{{-- ================= صور الجاليري ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('gallery')">
        صور إضافية (Gallery)
    </div>

    <div class="section-content" id="gallery">

        {{-- الصور الحالية --}}
        @if($product->images->count())
            <div class="mb-3">
                @foreach($product->images as $image)
                    <div class="img-box">
                        <img src="{{ asset('storage/'.$image->image) }}">
                        <form action="{{ route('product-images.destroy', $image->id) }}"
                            method="POST"
                            onsubmit="return confirm('حذف الصورة؟')"
                            class="position-absolute top-0 end-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">×</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- إضافة صور جديدة --}}
        <div id="gallery-repeater">
            <div class="repeater-item">
                <input type="file" name="images[]" class="form-control" accept="image/*">
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-info mt-2" onclick="addGalleryImage()">
            إضافة صورة
        </button>
    </div>
</div>

{{-- ================= Eco ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('eco')">
        Telas eco-eficientes
    </div>
    <div class="section-content" id="eco">
        <textarea name="eco_description" class="form-control ckeditor">
            {{ $product->eco_description }}
        </textarea>
    </div>
</div>

{{-- ================= Finishes ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('finishes')">
        Acabados
    </div>
    <div class="section-content" id="finishes">
        <textarea name="finishes_description" class="form-control ckeditor">
            {{ $product->finishes_description }}
        </textarea>
    </div>
</div>

{{-- ================= PDFs ================= --}}
<div class="mb-3">
    <div class="form-section-title" onclick="toggleSection('pdfs')">
        ملفات PDF
    </div>
    <div class="section-content" id="pdfs">

        <input type="file" name="pdf_open_plate" class="form-control mb-2">
        <input type="file" name="pdf_offset_hole" class="form-control mb-2">
        <input type="file" name="pdf_closed_plate" class="form-control mb-2">

    </div>
</div>

<div class="d-flex justify-content-end mt-4">
    <button class="btn btn-primary">تحديث المنتج</button>
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
    ClassicEditor.create(el);
});
</script>
@endsection
