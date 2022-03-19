@extends('dashboard.layouts.master')

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <form class="form" method="POST" action="{{ route('dashboard.config.createTimeTable') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-body">
            <h4 class="form-section"><i class="ft-user"></i> تحديث صورة الأزمنة (الجدول الزمني)</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الصورة - عربي</label>
                        <input type="file" id="code" class="form-control" name="time_table_image_ar">
                        <img src="{{ url($time_table_image_ar) }}" width="100px;" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الصورة - انجلش</label>
                        <input type="file" id="code" class="form-control" name="time_table_image_en">
                        <img src="{{ url($time_table_image_en) }}" width="100px;" alt="">
                    </div>
                </div>

            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> تحديث
            </button>
            <button type="reset" class="btn btn-warning mr-1">
                <i class="ft-x"></i> إلغاء
            </button>
        </div>

    </form>

@endsection
