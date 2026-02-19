@extends('layouts.master')

@section('title', 'تعديل صفحة عن الشركة')

@section('css')
    <style>
        .company-form-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06)
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #0d6efd;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 8px;
            margin-bottom: 20px
        }

        .card {
            border-radius: 14px
        }

        .card-header {
            background: #f8f9fa;
            font-weight: 600
        }

        .image-preview img {
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .image-wrapper {
            position: relative
        }

        .remove-image-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            cursor: pointer;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center"
        style="direction:rtl">
        <div>
            <h4 class="fw-bold text-primary mb-0">
                <i class="bx bx-building"></i> تعديل صفحة عن الشركة
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

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('company-details.update', $companyDetail->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ===================== MAIN ABOUT ===================== --}}
            <div class="form-section-title">القسم الرئيسي – عن الشركة</div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>العنوان عربي</label>
                    <input type="text" name="title_ar" class="form-control"
                        value="{{ old('title_ar', $companyDetail->title_ar) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>العنوان إنجليزي</label>
                    <input type="text" name="title_en" class="form-control"
                        value="{{ old('title_en', $companyDetail->title_en) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>الوصف عربي</label>
                    <textarea name="description_ar" class="form-control"
                        rows="4">{{ old('description_ar', $companyDetail->description_ar) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>الوصف إنجليزي</label>
                    <textarea name="description_en" class="form-control"
                        rows="4">{{ old('description_en', $companyDetail->description_en) }}</textarea>
                </div>
            </div>

            <hr>

            {{-- ===================== VISIONS ===================== --}}
            <div class="form-section-title">Vision / Mission / Values</div>

            <div id="visionRepeater">
                @foreach($visions as $index => $vision)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            عنصر
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="this.closest('.card').remove()">حذف</button>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="visions[{{ $index }}][title_ar]" value="{{ $vision->title_ar }}"
                                    class="form-control" placeholder="عنوان عربي">
                            </div>

                            <div class="col-md-4 mb-2">
                                <input type="text" name="visions[{{ $index }}][title_en]" value="{{ $vision->title_en }}"
                                    class="form-control" placeholder="Title EN">
                            </div>

                            <div class="col-md-6 mb-2">
                                <textarea name="visions[{{ $index }}][description_ar]" class="form-control"
                                    placeholder="وصف عربي">{{ $vision->description_ar }}</textarea>
                            </div>

                            <div class="col-md-6 mb-2">
                                <textarea name="visions[{{ $index }}][description_en]" class="form-control"
                                    placeholder="Description EN">{{ $vision->description_en }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addVision()">
                <i class="bx bx-plus"></i> إضافة عنصر
            </button>

            <hr>

            {{-- ===================== IMAGES ===================== --}}
            <div class="form-section-title">الصور</div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        @if($companyDetail->images)
                            @foreach($companyDetail->images as $img)
                                <div class="col-md-2 mb-2 image-wrapper" id="img-{{ $loop->index }}">
                                    <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail"
                                        style="height: 100px; width: 100%; object-fit: cover;">
                                    <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                    <button type="button" class="remove-image-btn"
                                        onclick="removeExistingImage('{{ $img }}', 'img-{{ $loop->index }}')">×</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div id="deletedImagesContainer"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>إضافة صور جديدة</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <hr>

    {{-- ===================== VIDEO ===================== --}}
    <div class="form-section-title">الفيديو</div>

    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $companyDetail->video_url) }}">

    <hr>



    <div class="text-end">
        <button class="btn btn-primary px-5">
            <i class="bx bx-save"></i> حفظ التعديلات
        </button>
    </div>

    </form>
    </div>
@endsection

@section('js')
    <script>
        let visionIndex = {{ $visions->count() }};
        let contentIndex = {{ $contents->count() }};

        function addVision() {
            document.getElementById('visionRepeater').insertAdjacentHTML('beforeend', `
                                        <div class="card mb-3">
                                            <div class="card-header d-flex justify-content-between">
                                                عنصر
                                                <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.card').remove()">حذف</button>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-md-4 mb-2">
                                                    <input type="text" name="visions[${visionIndex}][title_ar]" placeholder="عنوان عربي" class="form-control">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <input type="text" name="visions[${visionIndex}][title_en]" placeholder="Title EN" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <textarea name="visions[${visionIndex}][description_ar]" placeholder="وصف عربي" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <textarea name="visions[${visionIndex}][description_en]" placeholder="Description EN" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>`);
            visionIndex++;
        }

        function addContent() {
            document.getElementById('contentRepeater').insertAdjacentHTML('beforeend', `
                                        <div class="card mb-3">
                                            <div class="card-header d-flex justify-content-between">
                                                قسم
                                                <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.card').remove()">حذف</button>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" name="contents[${contentIndex}][title_ar]" placeholder="عنوان عربي" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <input type="text" name="contents[${contentIndex}][title_en]" placeholder="Title EN" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <textarea name="contents[${contentIndex}][description_ar]" placeholder="الوصف عربي" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <textarea name="contents[${contentIndex}][description_en]" placeholder="الوصف الانجليزي" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>`);
            contentIndex++;
        }


        function removeExistingImage(path, id) {
            if (confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
                document.getElementById(id).remove();
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'deleted_images[]';
                input.value = path;
                document.getElementById('deletedImagesContainer').appendChild(input);
            }
        }
    </script>
@endsection