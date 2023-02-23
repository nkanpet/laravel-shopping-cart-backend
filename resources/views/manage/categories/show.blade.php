@extends('adminlte::page')

@section('content_header')
<h1>หมวดหมู่สินค้า {{ $category->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('manage.categories.edit', ['category' => $category]) }}" title="แก้ไข">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-pen" aria-hidden="true"></i></button>
                </a>
                <form method="POST" action="{{ route('manage.categories.destroy', ['category' => $category]) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="ลบ" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <td>{{ $category->status }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection