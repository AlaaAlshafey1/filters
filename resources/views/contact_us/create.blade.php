@extends('layouts.master')
@section('title', 'إرسال رسالة جديدة')

@section('css')
<style>
.form-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    padding: 25px;
    max-width: 600px;
    margin: auto;
}

input.form-control, textarea.form-control {
    border-radius: 10px;
    padding: 10px;
}
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-message-square-add"></i> إرسال رسالة جديدة</h4>
        <small class="text-muted">يمكن للزوار إرسال رسالة من هنا</small>
    </div>
</div>
@endsection

@section('content')
<div class="form-card">
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الموضوع</label>
            <input type="text" name="subject" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">الرسالة</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <button class="btn btn-primary" style="background-color:#c1953e; border:none;">
                <i class="bx bx-send"></i> إرسال
            </button>
            <a href="{{ route('admin.contact.index') }}" class="btn btn-light border">
                <i class="bx bx-x-circle"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection
