@extends('layouts.master')
@section('title', 'القطاعات')

@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />

<style>
.dt-buttons .btn {
    background-color: #c1953e !important; border: none; color: #fff; border-radius: 8px; padding: 6px 12px;
}
.dt-buttons .btn:hover { background-color: #a67f31 !important; }
.img-thumb { max-width: 100px; border-radius: 5px; }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary">القطاعات</h4>
        <small class="text-muted">عرض جميع القطاعات وإدارتها</small>
    </div>
    <div>
        <a href="{{ route('sectors.create') }}" class="btn btn-primary btn-sm" style="background-color:#c1953e; border:none;">
            <i class="bx bx-plus-circle fs-5"></i> إضافة قطاع جديد
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table id="sectorsTable" class="table table-hover table-striped text-center align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>الوصف</th>
                        <th>الصورة</th>
                        <th>تاريخ الإضافة</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sectors as $key => $sector)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $sector->title_ar }} / {{ $sector->title_en }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($sector->desc_ar ?? $sector->desc_en, 50) }}</td>
                        <td>
                            @if($sector->image)
                                <img src="{{ asset('storage/'.$sector->image) }}" class="img-thumb shadow-sm">
                            @else
                                <span class="text-muted">لا يوجد صورة</span>
                            @endif
                        </td>
                        <td>{{ $sector->created_at->format('Y-m-d') }}</td>
                        <td>
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-outline-warning btn-sm" title="تعديل"><i class="bx bx-edit-alt"></i></a>
                                <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل تريد حذف هذا القطاع؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="حذف"><i class="bx bx-trash"></i></button>
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
    $('#sectorsTable').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json' },
        pageLength: 10,
        order: [[0, 'asc']]
    });
});
</script>
@endsection
