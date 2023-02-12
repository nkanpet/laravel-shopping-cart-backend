@extends('adminlte::page')

@section('content_header')
<h1>สินค้า {{ $product->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('manage.products.edit', ['product' => $product]) }}" title="แก้ไข">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-pen" aria-hidden="true"></i></button>
                </a>
                <form method="POST" action="{{ route('manage.products.destroy', ['product' => $product]) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="ลบ" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>ราคา</th>
                        <td>{{ number_format($product->price, 0) }}</td>
                    </tr>
                    <tr>
                        <th>จำนวน</th>
                        <td>{{ number_format($product->quantity, 0) }}</td>
                    </tr>
                    <tr>
                        <th>รูปภาพ</th>
                        <td><img src="{{ url(Storage::url($product->image)) }}" width="80" height="80" /></td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $product->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection