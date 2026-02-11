@extends('layouts.master')
@section('title', 'الأدوار والصلاحيات')

@section('css')
    <!-- Datatables -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" />

    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .badge {
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 12px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px;
            padding: 5px 12px;
        }

        .dataTables_wrapper .dt-buttons .btn {
            border-radius: 20px;
            margin-left: 5px;
        }

        .import-form input[type="file"] {
            display: none;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3"
        style="direction: rtl;">

        {{-- العنوان والوصف --}}
        <div class="d-flex flex-column">
            <h4 class="content-title mb-1 fw-bold text-primary">إدارة الأدوار والصلاحيات</h4>
            <small class="text-muted">تحكم بالأدوار وتوزيع الصلاحيات بسهولة</small>
        </div>

        {{-- الأزرار (محاذاة للشمال) --}}
        <div class="d-flex flex-wrap justify-content-start gap-2">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                <i class="bx bx-plus-circle fs-5"></i> <span>إضافة دور جديد</span>
            </a>

            {{-- <a href="{{ route('roles.export') }}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                <i class="bx bx-export fs-5"></i> <span>تصدير</span>
            </a>

            <form action="{{ route('roles.import') }}" method="POST" enctype="multipart/form-data"
                class="import-form d-flex align-items-center">
                @csrf
                <label for="importFile" class="btn btn-info btn-sm d-flex align-items-center gap-1 mb-0">
                    <i class="bx bx-import fs-5"></i> <span>استيراد</span>
                </label>
                <input type="file" id="importFile" name="file" accept=".xlsx,.csv" onchange="this.form.submit()">
            </form> --}}
        </div>

    </div>
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">قائمة الأدوار</h5>
            <small class="text-muted">عرض جميع الأدوار مع الصلاحيات الخاصة بها</small>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="rolesTable" class="table table-hover table-borderless table-striped text-center align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>اسم الدور</th>
                            <th>الصلاحيات</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td><strong>{{ $key + 1 }}</strong></td>
                                <td class="text-dark fw-semibold">{{ $role->name }}</td>
                                <td>
                                    @if ($role->permissions->count())
                                        @foreach ($role->permissions as $perm)
                                            <span class="badge bg-primary">{{ translate_permission($perm->name) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">بدون صلاحيات</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
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
    <!-- Datatables JS -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>


@endsection