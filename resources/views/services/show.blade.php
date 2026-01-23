@extends('layouts.master')
@section('title', 'عرض الخدمة')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">تفاصيل الخدمة</h5>
        <small class="text-muted">عرض بيانات الخدمة كاملة</small>
    </div>

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <h6>العنوان 1 (عربي)</h6>
                <p>{{ $service->title1_ar }}</p>
            </div>
            <div class="col-md-6">
                <h6>العنوان 1 (إنجليزي)</h6>
                <p>{{ $service->title1_en }}</p>
            </div>

            <div class="col-md-6">
                <h6>العنوان 2 (عربي)</h6>
                <p>{{ $service->title2_ar }}</p>
            </div>
            <div class="col-md-6">
                <h6>العنوان 2 (إنجليزي)</h6>
                <p>{{ $service->title2_en }}</p>
            </div>

            <div class="col-md-6">
                <h6>الوصف 1 (عربي)</h6>
                <p>{{ $service->desc1_ar }}</p>
            </div>
            <div class="col-md-6">
                <h6>الوصف 1 (إنجليزي)</h6>
                <p>{{ $service->desc1_en }}</p>
            </div>

            <div class="col-md-6">
                <h6>العنوان 3 (عربي)</h6>
                <p>{{ $service->title3_ar }}</p>
            </div>
            <div class="col-md-6">
                <h6>العنوان 3 (إنجليزي)</h6>
                <p>{{ $service->title3_en }}</p>
            </div>

            <div class="col-md-6">
                <h6>الوصف 2 (عربي)</h6>
                <p>{{ $service->desc2_ar }}</p>
            </div>
            <div class="col-md-6">
                <h6>الوصف 2 (إنجليزي)</h6>
                <p>{{ $service->desc2_en }}</p>
            </div>

            <div class="col-md-12">
                <h6>العناصر (Items)</h6>
                @if($service->items && count($service->items) > 0)
                    <ul class="list-group">
                        @foreach($service->items as $item)
                            <li class="list-group-item">
                                <b>{{ $item['title_ar'] }}</b> - {{ $item['desc_ar'] }}
                                <br>
                                <small class="text-muted">{{ $item['title_en'] }} - {{ $item['desc_en'] }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>لا يوجد عناصر.</p>
                @endif
            </div>

            <div class="col-md-12">
                <h6>الصورة</h6>
                @if($service->image)
                    <img src="{{ asset('storage/'.$service->image) }}" width="200" class="rounded border">
                @else
                    <p>لا يوجد صورة.</p>
                @endif
            </div>

            <div class="col-md-12">
                <h6>الحالة</h6>
                <p>
                    @if($service->is_active)
                        مفعل
                    @else
                        غير مفعل
                    @endif
                </p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('services.index') }}" class="btn btn-secondary">
                رجوع
            </a>
        </div>
    </div>
</div>
@endsection
