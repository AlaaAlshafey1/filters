@extends('layouts.master')
@section('title', 'الأسئلة الشائعة')

@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary">الأسئلة الشائعة</h4>
        <small class="text-muted">عرض جميع الأسئلة والتحكم بها</small>
    </div>

    <div class="d-flex flex-wrap justify-content-start gap-2">
        <a href="{{ route('faqs.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="background-color:#c1953e; border-color:#c1953e;">
            <i class="bx bx-plus-circle fs-5"></i> <span>إضافة سؤال جديد</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">قائمة الأسئلة</h5>
        <small class="text-muted">عرض جميع الأسئلة المسجلة</small>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table id="faqsTable" class="table table-hover table-striped text-center align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>السؤال (AR)</th>
                        <th>السؤال (EN)</th>
                        <th>الترتيب</th>
                        <th>الحالة</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $key => $faq)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $faq->question_ar }}</td>
                            <td>{{ $faq->question_en }}</td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                @if($faq->is_active)
                                    <span class="badge bg-success">مفعل</span>
                                @else
                                    <span class="badge bg-danger">غير مفعل</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>

                                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#faqsTable').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json' },
        pageLength: 10
    });
});
</script>
@endsection
