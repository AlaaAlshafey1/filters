@extends('layouts.master')
@section('title', 'إعدادات الموقع')

@section('css')
<style>
.settings-form-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
input.form-control, textarea.form-control { border-radius: 10px; padding: 10px; }
.img-preview { max-width: 150px; border-radius: 10px; margin-bottom: 10px; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-cog"></i> إعدادات الموقع</h4>
        <small class="text-muted">تحكم في جميع إعدادات المشروع الأساسية</small>
    </div>
</div>
@endsection

@section('content')
<div class="settings-form-card">
    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Logo --}}
        <div class="mb-3">
            <label class="form-label">شعار الموقع</label>
            <input type="file" name="logo" class="form-control">
            @if(isset($settings['logo']) && $settings['logo'])
                <img src="{{ asset('storage/'.$settings['logo']) }}" class="img-preview">
            @endif
        </div>

        {{-- Favicon --}}
        <div class="mb-3">
            <label class="form-label">Favicon</label>
            <input type="file" name="favicon" class="form-control">
            @if(isset($settings['favicon']) && $settings['favicon'])
                <img src="{{ asset('storage/'.$settings['favicon']) }}" class="img-preview">
            @endif
        </div>

        {{-- Contact Info --}}
        <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ $settings['phone'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control" value="{{ $settings['address'] ?? '' }}">
        </div>

        {{-- Social --}}
        <div class="mb-3">
            <label class="form-label">فيسبوك</label>
            <input type="url" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">تويتر</label>
            <input type="url" name="twitter" class="form-control" value="{{ $settings['twitter'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">إنستجرام</label>
            <input type="url" name="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">لينكدإن</label>
            <input type="url" name="linkedin" class="form-control" value="{{ $settings['linkedin'] ?? '' }}">
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary" style="background-color:#c1953e; border:none;">
                <i class="bx bx-save"></i> حفظ الإعدادات
            </button>
        </div>
    </form>
</div>
@endsection
