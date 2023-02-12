@extends('layouts.admin')

@section('content_header')
<h1>สินค้า : แก้ไข</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-default">

            <form method="POST" action="{{ route('manage.products.update', ['product' => $product]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="card-body">
                    @include ('manage.products.form', ['formMode' => 'update'])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection