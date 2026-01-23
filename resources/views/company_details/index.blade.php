@extends('layouts.master')
@section('title', 'بيانات الشركة')

@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />
<style>
.page-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px; }
.dt-buttons .btn { background-color: #c1953e !important; border: none !important; color: #fff !important; border-radius: 8px !important; padding: 6px 12px !important; }
.dt-buttons .btn:hover { background-color: #a67f31 !important; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary">إدارة بيانات الشركة</h4>
        <small class="text-muted">عرض جميع الأقسام والتحكم بها</small>
    </div>
    <div>
        <a href="{{ route('company-details.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1" style="background-color:#c1953e; border-color:#c1953e;">
            <i class="bx bx-plus-circle fs-5"></i> إضافة قسم جديد
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table id="companyTable" class="table table-hover table-striped text-center align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>القسم</th>
                        <th>العنوان (عربي)</th>
                        <th>العنوان (إنجليزي)</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $key => $detail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $detail->section_key }}</td>
                            <td>{{ $detail->title_ar }}</td>
                            <td>{{ $detail->title_en }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('company-details.edit', $detail->id) }}" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit-alt"></i></a>

                                    <form action="{{ route('company-details.destroy', $detail->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bx bx-trash"></i></button>
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
    $('#companyTable').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json' },
        pageLength: 10
    });
});
</script>
@endsection
