@extends('adminlte::page')

@section('content_header')
<h1>หมวดหมู่สินค้า {{ $user->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection