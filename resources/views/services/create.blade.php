@extends('layouts.master')
@section('title', 'إضافة خدمة جديدة')

@section('css')
<style>
    .service-form-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 25px;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 5px;
    }

    label.form-label {
        font-weight: 500;
        color: #333;
    }

    input.form-control, textarea.form-control, select.form-select {
        border-radius: 10px;
        padding: 10px 14px;
        min-height: 45px;
        width: 100%;
    }
</style>
@endsection

@section('page-header')
<div class="page-header py-3 px-3 mt-3 mb-3 bg-white shadow-sm rounded-3 border d-flex justify-content-between align-items-center flex-wrap gap-3" style="direction: rtl;">
    <div class="d-flex flex-column">
        <h4 class="content-title mb-1 fw-bold text-primary"><i class="bx bx-category"></i> إضافة خدمة جديدة</h4>
        <small class="text-muted">قم بإدخال بيانات الخدمة الجديدة</small>
    </div>
    <div>
        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center gap-1">
            <i class="bx bx-arrow-back fs-5"></i> <span>رجوع</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="service-form-card">
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section mb-4">
            <h6 class="form-section-title">📌 بيانات الخدمة</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">العنوان 1 (عربي)</label>
                    <input type="text" name="title1_ar" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">العنوان 1 (إنجليزي)</label>
                    <input type="text" name="title1_en" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">العنوان 2 (عربي)</label>
                    <input type="text" name="title2_ar" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">العنوان 2 (إنجليزي)</label>
                    <input type="text" name="title2_en" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">الوصف 1 (عربي)</label>
                    <textarea name="desc1_ar" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">الوصف 1 (إنجليزي)</label>
                    <textarea name="desc1_en" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">العنوان 3 (عربي)</label>
                    <input type="text" name="title3_ar" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">العنوان 3 (إنجليزي)</label>
                    <input type="text" name="title3_en" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">الوصف 2 (عربي)</label>
                    <textarea name="desc2_ar" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">الوصف 2 (إنجليزي)</label>
                    <textarea name="desc2_en" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label">صورة الخدمة</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label">حالة الخدمة</label>
                    <select name="is_active" class="form-select">
                        <option value="1">مفعل</option>
                        <option value="0">غير مفعل</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Repeater items -->
        <div class="form-section mb-4">
            <h6 class="form-section-title">🧩 العناصر (Items)</h6>

            <div id="itemsContainer"></div>

            <div class="mt-3">
                <button type="button" id="addItemBtn" class="btn btn-success btn-sm">
                    <i class="bx bx-plus-circle"></i> إضافة عنصر جديد
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary" style="background-color:#c1953e; border:none;">
                <i class="bx bx-save"></i> حفظ الخدمة
            </button>
            <a href="{{ route('services.index') }}" class="btn btn-light border">
                <i class="bx bx-x-circle"></i> إلغاء
            </a>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    let itemIndex = 0;

    function addItem(data = null) {
        const html = `
            <div class="card mb-3 p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">عنصر ${itemIndex + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm removeItemBtn">
                        <i class="bx bx-trash"></i> حذف
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">عنوان (عربي)</label>
                        <input type="text" name="items[${itemIndex}][title_ar]" class="form-control" value="${data?.title_ar ?? ''}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">عنوان (إنجليزي)</label>
                        <input type="text" name="items[${itemIndex}][title_en]" class="form-control" value="${data?.title_en ?? ''}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">وصف (عربي)</label>
                        <textarea name="items[${itemIndex}][desc_ar]" class="form-control" rows="2">${data?.desc_ar ?? ''}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">وصف (إنجليزي)</label>
                        <textarea name="items[${itemIndex}][desc_en]" class="form-control" rows="2">${data?.desc_en ?? ''}</textarea>
                    </div>
                </div>
            </div>
        `;

        $('#itemsContainer').append(html);
        itemIndex++;
    }

    $(document).on('click', '#addItemBtn', function() {
        addItem();
    });

    $(document).on('click', '.removeItemBtn', function() {
        $(this).closest('.card').remove();
    });

    // add first item by default
    addItem();
</script>
@endsection
