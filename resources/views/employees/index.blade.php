@extends('layouts.master')
@section('title', 'الموظفين')

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />

<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}

.dt-buttons .btn {
    background-color: #c1953e !important;
    border: none !important;
    color: #fff !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
}

.dt-buttons .btn:hover {
    background-color: #a67f31 !important;
}
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary">إدارة الموظفين</h4>
        <small class="text-muted">عرض وإدارة القوى العاملة المتميزة</small>
    </div>

    <div class="d-flex flex-wrap justify-content-start gap-2">
        <a href="{{ route('employees.create') }}"  class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#addEmployeeModal" style="background-color:#c1953e; border-color:#c1953e;">
            <i class="bx bx-plus-circle fs-5"></i> <span>إضافة موظف جديد</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">قائمة الموظفين</h5>
        <small class="text-muted">عرض جميع الموظفين المسجلين</small>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table id="employeesTable" class="table table-hover table-striped text-center align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الوظيفة</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($employee->image)
                                    <img src="{{ asset('storage/'.$employee->image) }}" width="50" height="50" class="rounded-circle object-fit-cover">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->job_title }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEmployee{{ $employee->id }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editEmployee{{ $employee->id }}">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">تعديل موظف</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>الاسم</label>
                                            <input type="text" name="name" class="form-control" value="{{ $employee->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>الوظيفة</label>
                                            <input type="text" name="job_title" class="form-control" value="{{ $employee->job_title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>الصورة</label>
                                            <input type="file" name="image" class="form-control">
                                            @if($employee->image)
                                                <img src="{{ asset('storage/'.$employee->image) }}" class="mt-2 rounded" width="70">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addEmployeeModal">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">إضافة موظف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label>الوظيفة</label>
                    <input type="text" name="job_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label>الصورة</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">إضافة</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<!-- DataTables Scripts -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

<script>
$(document).ready(function() {
    let table = $('#employeesTable').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json' },
        pageLength: 10,
        dom: '<"d-flex justify-content-between align-items-center mb-3"<"btn-left"B><"search-box"f>>rtip',
        buttons: [
            { extend: 'copy', text: '📋 نسخ', className: 'btn-sm mx-1' },
            { extend: 'excel', text: '📊 Excel', className: 'btn-sm mx-1' },
            { extend: 'pdf', text: '📄 PDF', className: 'btn-sm mx-1' },
            { extend: 'print', text: '🖨️ طباعة', className: 'btn-sm mx-1' }
        ]
    });

    $('.dt-buttons').addClass('d-flex flex-wrap gap-2 align-items-center');
    $('.dt-buttons .btn').addClass('btn-primary').css({
        'background-color': '#c1953e',
        'border-color': '#c1953e',
        'color': '#fff'
    });
});
</script>
@endsection
