@extends('layouts.master')
@section('title', 'السلايدر')

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
    <div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3"
        style="direction: rtl;">
        <div class="d-flex flex-column">
            <h4 class="content-title mb-1 fw-bold text-primary">إدارة السلايدر</h4>
            <small class="text-muted">عرض جميع السلايدرز والتحكم بها</small>
        </div>

        <div class="d-flex flex-wrap justify-content-start gap-2">
            @can('sliders_create')
                <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1"
                    style="background-color:#c1953e; border-color:#c1953e;">
                    <i class="bx bx-plus-circle fs-5"></i>
                    <span>إضافة سلايدر جديد</span>
                </a>
            @endcan
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">قائمة السلايدر</h5>
            <small class="text-muted">عرض جميع السلايدرز المسجلة</small>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table id="slidersTable" class="table table-hover table-striped text-center align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>العنوان</th>
                            <th>الحالة</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $key => $slider)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $slider->image) }}" width="90" class="rounded shadow-sm">
                                </td>
                                <td>{{ $slider->title_ar }}</td>
                                <td>
                                    @if($slider->is_active)
                                        <span class="badge bg-success">مفعّل</span>
                                    @else
                                        <span class="badge bg-danger">غير مفعّل</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @can('sliders_edit')
                                            <a href="{{ route('sliders.edit', $slider->id) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                        @endcan

                                        @can('sliders_delete')
                                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
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


@endsection