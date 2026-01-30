@extends('layouts.master')

@section('title','تعديل موظف')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            <i class="bx bx-edit"></i> تعديل موظف
        </h4>
        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
            رجوع
        </a>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update',$employee) }}"
          method="POST"
          enctype="multipart/form-data"
          class="card shadow-sm">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">اسم الموظف</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name',$employee->name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">المسمى الوظيفي</label>
                <input type="text"
                       name="job_title"
                       class="form-control"
                       value="{{ old('job_title',$employee->job_title) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">الصورة</label>
                <input type="file"
                       name="image"
                       class="form-control"
                       accept="image/*"
                       onchange="previewImage(event)">
            </div>

            @if($employee->image)
                <div class="mb-3">
                    <label class="form-label d-block">الصورة الحالية</label>
                    <img src="{{ asset('storage/'.$employee->image) }}"
                         width="120"
                         class="rounded">
                </div>
            @endif

            <div id="imagePreview"></div>

        </div>

        <div class="card-footer text-end">
            <button class="btn btn-primary px-4">
                <i class="bx bx-save"></i> تحديث
            </button>
        </div>
    </form>

</div>
@endsection

@section('js')
<script>
function previewImage(e){
    let preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    let img = document.createElement('img');
    img.src = URL.createObjectURL(e.target.files[0]);
    img.className = 'rounded mt-2';
    img.style.width = '120px';
    preview.appendChild(img);
}
</script>
@endsection
