@extends('layouts.master')
@section('title', 'إضافة ميزة جديدة')

@section('css')
    <style>
        .feature-form-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            color: #0d6efd;
            margin-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 5px;
        }

        label.form-label {
            font-weight: 500;
            color: #333;
        }

        input.form-control,
        textarea.form-control,
        select.form-select {
            border-radius: 10px;
            padding: 10px 14px;
            min-height: 45px;
            width: 100%;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3"
        style="direction: rtl;">
        <div class="d-flex flex-column">
            <h4 class="content-title mb-1 fw-bold text-primary">
                <i class="bx bx-star"></i> إضافة ميزة جديدة
            </h4>
            <small class="text-muted">
                قم بإدخال بيانات الميزة لتظهر في السلايدر
            </small>
        </div>
        <div>
            <a href="{{ route('features.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center gap-1">
                <i class="bx bx-arrow-back fs-5"></i>
                <span>رجوع</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="feature-form-card">
        <form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section mb-4">
                <h6 class="form-section-title">📝 معلومات الميزة</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">العنوان (عربي)</label>
                        <input type="text" name="title_ar" class="form-control" placeholder="أدخل عنوان الميزة بالعربية"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">العنوان (إنجليزي)</label>
                        <input type="text" name="title_en" class="form-control" placeholder="Feature title in English">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الوصف (عربي)</label>
                        <textarea name="description_ar" class="form-control" placeholder="الوصف بالعربية"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الوصف (إنجليزي)</label>
                        <textarea name="description_en" class="form-control"
                            placeholder="Description in English"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">أيقونة الميزة</label>
                        <select name="icon" class="form-select select2" required>
                            <option value="" disabled selected>اختر أيقونة</option>
                            <optgroup label="Boxicons">
                                <option value="bx bx-star" {{ old('icon') == 'bx bx-star' ? 'selected' : '' }}>Star (bx
                                    bx-star)</option>
                                <option value="bx bx-heart" {{ old('icon') == 'bx bx-heart' ? 'selected' : '' }}>Heart (bx
                                    bx-heart)</option>
                                <option value="bx bx-check-circle" {{ old('icon') == 'bx bx-check-circle' ? 'selected' : '' }}>Check Circle (bx bx-check-circle)</option>
                                <option value="bx bx-info-circle" {{ old('icon') == 'bx bx-info-circle' ? 'selected' : '' }}>
                                    Info Circle (bx bx-info-circle)</option>
                                <option value="bx bx-cog" {{ old('icon') == 'bx bx-cog' ? 'selected' : '' }}>Cog (bx bx-cog)
                                </option>
                                <option value="bx bx-user" {{ old('icon') == 'bx bx-user' ? 'selected' : '' }}>User (bx
                                    bx-user)</option>
                                <option value="bx bx-home" {{ old('icon') == 'bx bx-home' ? 'selected' : '' }}>Home (bx
                                    bx-home)</option>
                                <option value="bx bx-bell" {{ old('icon') == 'bx bx-bell' ? 'selected' : '' }}>Bell (bx
                                    bx-bell)</option>
                                <option value="bx bx-cart" {{ old('icon') == 'bx bx-cart' ? 'selected' : '' }}>Cart (bx
                                    bx-cart)</option>
                                <option value="bx bx-search" {{ old('icon') == 'bx bx-search' ? 'selected' : '' }}>Search (bx
                                    bx-search)</option>
                                <option value="bx bx-lock" {{ old('icon') == 'bx bx-lock' ? 'selected' : '' }}>Lock (bx
                                    bx-lock)</option>
                                <option value="bx bx-shield" {{ old('icon') == 'bx bx-shield' ? 'selected' : '' }}>Shield (bx
                                    bx-shield)</option>
                                <option value="bx bx-trophy" {{ old('icon') == 'bx bx-trophy' ? 'selected' : '' }}>Trophy (bx
                                    bx-trophy)</option>
                                <option value="bx bx-medal" {{ old('icon') == 'bx bx-medal' ? 'selected' : '' }}>Medal (bx
                                    bx-medal)</option>
                                <option value="bx bx-gift" {{ old('icon') == 'bx bx-gift' ? 'selected' : '' }}>Gift (bx
                                    bx-gift)</option>
                            </optgroup>
                            <optgroup label="FontAwesome">
                                <option value="fa fa-star" {{ old('icon') == 'fa fa-star' ? 'selected' : '' }}>Star (fa
                                    fa-star)</option>
                                <option value="fa fa-heart" {{ old('icon') == 'fa fa-heart' ? 'selected' : '' }}>Heart (fa
                                    fa-heart)</option>
                                <option value="fa fa-check" {{ old('icon') == 'fa fa-check' ? 'selected' : '' }}>Check (fa
                                    fa-check)</option>
                                <option value="fa fa-info" {{ old('icon') == 'fa fa-info' ? 'selected' : '' }}>Info (fa
                                    fa-info)</option>
                                <option value="fa fa-cog" {{ old('icon') == 'fa fa-cog' ? 'selected' : '' }}>Cog (fa fa-cog)
                                </option>
                                <option value="fa fa-user" {{ old('icon') == 'fa fa-user' ? 'selected' : '' }}>User (fa
                                    fa-user)</option>
                                <option value="fa fa-home" {{ old('icon') == 'fa fa-home' ? 'selected' : '' }}>Home (fa
                                    fa-home)</option>
                                <option value="fa fa-bell" {{ old('icon') == 'fa fa-bell' ? 'selected' : '' }}>Bell (fa
                                    fa-bell)</option>
                                <option value="fa fa-shopping-cart" {{ old('icon') == 'fa fa-shopping-cart' ? 'selected' : '' }}>Cart (fa fa-shopping-cart)</option>
                                <option value="fa fa-search" {{ old('icon') == 'fa fa-search' ? 'selected' : '' }}>Search (fa
                                    fa-search)</option>
                                <option value="fa fa-phone" {{ old('icon') == 'fa fa-phone' ? 'selected' : '' }}>Phone (fa
                                    fa-phone)</option>
                                <option value="fa fa-envelope" {{ old('icon') == 'fa fa-envelope' ? 'selected' : '' }}>
                                    Envelope (fa fa-envelope)</option>
                                <option value="fa fa-globe" {{ old('icon') == 'fa fa-globe' ? 'selected' : '' }}>Globe (fa
                                    fa-globe)</option>
                            </optgroup>
                        </select>
                        <small class="text-muted">اختر أيقونة لتمثيل هذه الميزة</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الحالة</label>
                        <select name="is_active" class="form-select">
                            <option value="1">مفعّل</option>
                            <option value="0">غير مفعّل</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn btn-primary" style="background-color:#c1953e; border:none;">
                    <i class="bx bx-save"></i> حفظ الميزة
                </button>

                <a href="{{ route('features.index') }}" class="btn btn-light border">
                    <i class="bx bx-x-circle"></i> إلغاء
                </a>
            </div>
        </form>
    </div>
@endsection