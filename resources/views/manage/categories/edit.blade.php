@extends('layouts.admin')

@section('content_header')
<h1>หมวดหมู่สินค้า : แก้ไข</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-default">

            <form method="POST" action="{{ route('manage.categories.update', ['category' => $category]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="card-body">
                    @include ('manage.categories.form', ['formMode' => 'update'])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection