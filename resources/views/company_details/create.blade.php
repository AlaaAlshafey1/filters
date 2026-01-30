@extends('layouts.master')

@section('title', 'صفحة عن الشركة')

@section('css')
<style>
.company-form-card{
    background:#fff;
    border-radius:16px;
    padding:30px;
    box-shadow:0 6px 20px rgba(0,0,0,.06)
}
.form-section-title{
    font-size:16px;
    font-weight:700;
    color:#0d6efd;
    border-bottom:2px solid #e9ecef;
    padding-bottom:8px;
    margin-bottom:20px
}
.card{border-radius:14px}
.card-header{background:#f8f9fa;font-weight:600}
.image-preview img{
    height:90px;
    object-fit:cover;
    border-radius:10px
}
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center" style="direction:rtl">
    <div>
        <h4 class="fw-bold text-primary mb-0">
            <i class="bx bx-building"></i> صفحة عن الشركة
        </h4>
        <small class="text-muted">إدارة محتوى صفحة About Us</small>
    </div>
    <a href="{{ route('company-details.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bx bx-arrow-back"></i> رجوع
    </a>
</div>
@endsection

@section('content')
<div class="company-form-card">

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('company-details.store') }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- ===================== SECTION 1 ===================== --}}
<div class="form-section-title">القسم الرئيسي – عن الشركة</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>العنوان عربي</label>
        <input type="text" name="main[title_ar]" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label>العنوان إنجليزي</label>
        <input type="text" name="main[title_en]" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label>الوصف عربي</label>
        <textarea name="main[description_ar]" class="form-control" rows="4"></textarea>
    </div>
    <div class="col-md-6 mb-3">
        <label>الوصف إنجليزي</label>
        <textarea name="main[description_en]" class="form-control" rows="4"></textarea>
    </div>
</div>

<hr>

{{-- ===================== SECTION 2 ===================== --}}
<div class="form-section-title">Vision / Mission / Values</div>

<div id="visionRepeater"></div>

<button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addVision()">
    <i class="bx bx-plus"></i> إضافة عنصر
</button>

<hr>

{{-- ===================== SECTION 3 ===================== --}}
<div class="form-section-title">صور عن الشركة</div>

<input type="file" name="images[]" class="form-control mb-3" multiple accept="image/*" onchange="previewImages(event)">
<div class="row image-preview" id="imagePreview"></div>

<hr>

{{-- ===================== SECTION 4 ===================== --}}
<div class="form-section-title">الفيديو</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row">

            <div class="col-md-12">
                <label>رابط الفيديو</label>
                <input type="url" name="video[url]" class="form-control">
            </div>
        </div>
    </div>
</div>

<hr>

{{-- ===================== SECTION 5 ===================== --}}
<div class="form-section-title">أقسام إضافية</div>

<div id="contentRepeater"></div>

<button type="button" class="btn btn-sm btn-outline-secondary mb-4" onclick="addContent()">
    <i class="bx bx-plus"></i> إضافة قسم
</button>

<hr>

<div class="text-end">
    <button class="btn btn-primary px-5">
        <i class="bx bx-save"></i> حفظ صفحة عن الشركة
    </button>
</div>

</form>
</div>
@endsection

@section('js')
<script>
let visionIndex = 0;
let contentIndex = 0;

function addVision(){
    document.getElementById('visionRepeater').insertAdjacentHTML('beforeend',`
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            Vision / Mission
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.card').remove()">حذف</button>
        </div>
        <div class="card-body row">

            <div class="col-md-4 mb-2">
                <input type="text" name="visions[${visionIndex}][title_ar]" class="form-control" placeholder="عنوان عربي">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" name="visions[${visionIndex}][title_en]" class="form-control" placeholder="Title EN">
            </div>
            <div class="col-md-6 mb-2">
                <textarea name="visions[${visionIndex}][description_ar]" class="form-control" placeholder="وصف عربي"></textarea>
            </div>
            <div class="col-md-6 mb-2">
                <textarea name="visions[${visionIndex}][description_en]" class="form-control" placeholder="Description EN"></textarea>
            </div>
        </div>
    </div>`);
    visionIndex++;
}

function addContent(){
    document.getElementById('contentRepeater').insertAdjacentHTML('beforeend',`
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            قسم
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.card').remove()">حذف</button>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-2">
                <input type="text" name="contents[${contentIndex}][title_ar]" class="form-control" placeholder="عنوان عربي">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" name="contents[${contentIndex}][title_en]" class="form-control" placeholder="Title EN">
            </div>
            <div class="col-md-6 mb-2">
                <textarea name="contents[${contentIndex}][description_ar]" class="form-control" placeholder="وصف عربي"></textarea>
            </div>
            <div class="col-md-6 mb-2">
                <textarea name="contents[${contentIndex}][description_en]" class="form-control" placeholder="Description EN"></textarea>
            </div>
        </div>
    </div>`);
    contentIndex++;
}

function previewImages(e){
    let box=document.getElementById('imagePreview');
    box.innerHTML='';
    [...e.target.files].forEach(f=>{
        let r=new FileReader();
        r.onload=ev=>{
            box.innerHTML+=`<div class="col-md-2 mb-2"><img src="${ev.target.result}" class="img-fluid"></div>`;
        };
        r.readAsDataURL(f);
    });
}
</script>
@endsection
