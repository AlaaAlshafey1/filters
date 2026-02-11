@extends('layouts.master')
@section('title', 'إدارة المستخدمين')

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

        #colvisList {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        #colvisList .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            /* المسافة بين الـ checkbox والكلمة */
            margin: 0;
        }

        #colvisList .form-check-input {
            margin: 0;
            transform: scale(1.1);
            cursor: pointer;
        }

        #colvisList .form-check-label {
            margin: 0;
            line-height: 1;
            font-size: 14px;
            color: #333;
            cursor: pointer;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3"
        style="direction: rtl;">
        <div class="d-flex flex-column">
            <h4 class="content-title mb-1 fw-bold text-primary">إدارة المستخدمين</h4>
            <small class="text-muted">عرض جميع المستخدمين والتحكم بهم</small>
        </div>

        <div class="d-flex flex-wrap justify-content-start gap-2">
            @can('users_create')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1"
                    style="background-color:#c1953e; border-color:#c1953e;">
                    <i class="bx bx-plus-circle fs-5"></i> <span>إضافة مستخدم جديد</span>
                </a>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">قائمة المستخدمين</h5>
            <small class="text-muted">عرض جميع المستخدمين مع بياناتهم</small>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover table-striped text-center align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>الدور</th>
                            <th>الحالة</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ $user->image ? asset('uploads/users/' . $user->image) : URL::asset('assets/img/faces/default.png') }}"
                                        width="40" height="40" class="rounded-circle" alt="user">
                                </td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>{{ $user->role->name ?? '-' }}</td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-danger">غير نشط</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @can('users_edit')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                        @endcan

                                        @can('users_delete')
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>





@endsection