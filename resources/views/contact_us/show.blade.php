@extends('layouts.master')
@section('title', 'عرض الرسالة')

@section('content')
<div class="card mt-4" style="max-width:700px; margin:auto;">
    <div class="card-body">
        <h4 class="fw-bold text-primary mb-3"><i class="bx bx-show-alt"></i> عرض الرسالة</h4>

        <div class="mb-2"><strong>الاسم:</strong> {{ $contactUsMessage->name }}</div>
        <div class="mb-2"><strong>البريد الإلكتروني:</strong> {{ $contactUsMessage->email }}</div>
        <div class="mb-2"><strong>الموضوع:</strong> {{ $contactUsMessage->subject ?? '-' }}</div>
        <div class="mb-2"><strong>تاريخ الإرسال:</strong> {{ $contactUsMessage->created_at->format('Y-m-d H:i') }}</div>
        <div class="mb-3"><strong>الرسالة:</strong> <p>{{ $contactUsMessage->message }}</p></div>

        <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> رجوع</a>

        <form action="{{ route('admin.contact.destroy', $contactUsMessage->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل تريد حذف الرسالة؟');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"><i class="bx bx-trash"></i> حذف</button>
        </form>
    </div>
</div>
@endsection
