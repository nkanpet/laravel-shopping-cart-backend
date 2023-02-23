@extends('layouts.admin')

@section('content_header')
<h1>หมวดหมู่สินค้า : เพิ่ม</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-default">

            <form method="POST" action="{{ route('manage.categories.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-body">
                    @include ('manage.categories.form', ['formMode' => 'create'])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection