@extends('layouts.admin')

@section('content_header')
<h1>Client : เพิ่ม</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-default">

            <form method="POST" action="{{ route('manage.clients.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card-body">
                    @include ('manage.clients.form', ['formMode' => 'create'])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection