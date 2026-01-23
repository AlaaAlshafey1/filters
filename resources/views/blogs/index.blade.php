@extends('layouts.master')
@section('title', 'المدونة')

@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />

<style>
.table-blog tr.unread { background-color: #f9f9f9; font-weight: bold; }
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
        <h4 class="content-title mb-1 fw-bold text-primary">المدونة</h4>
        <small class="text-muted">عرض جميع المقالات وإدارتها</small>
    </div>
    <div>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm" style="background-color:#c1953e; border:none;">
            <i class="bx bx-plus-circle fs-5"></i> إضافة مقال جديد
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
            <table id="blogsTable" class="table table-hover table-striped text-center align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>الملخص</th>
                        <th>الصورة</th>
                        <th>تاريخ النشر</th>
                        <th>الحالة</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $key => $blog)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $blog->title_ar }} / {{ $blog->title_en }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($blog->excerpt_ar ?? $blog->excerpt_en, 50) }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/'.$blog->image) }}" class="img-thumb">
                            @endif
                        </td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>{{ $blog->is_active ? 'مفعل' : 'معطل' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-info btn-sm"><i class="bx bx-show-alt"></i></a>
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit-alt"></i></a>
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل تريد حذف المقال؟');">
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
    $('#blogsTable').DataTable({
        language: { url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/ar.json' },
        pageLength: 10
    });
});
</script>
@endsection
