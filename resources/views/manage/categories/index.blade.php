@extends('layouts.admin')

@section('content_header')
<h1>จัดการหมวดหมู่สินค้า</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
        @if(Session::has('flash_message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
            {{ Session::get('flash_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <a href="{{ route('manage.categories.create') }}" class="btn btn-success btn-sm" title="เพิ่ม">
                    เพิ่ม
                </a>
            </div>

            <div class="card-body">
                <table class="table" id="table-categories">
                    <thead>
                        <form>
                            <tr id="filters">
                                <th></th>
                                <th></th>
                                <th>
                                    <input name="name" class="form-control" value="{{ request()->get('name', '') }}" />
                                </th>
                                <th></th>
                                <th>
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </th>
                            </tr>
                        </form>
                        <tr>
                            <th>ID</th>
                            <th>ชื่อ</th>
                            <th>สถานะ</th>
                            <th>สร้างเมื่อ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                <a href="{{ route('manage.categories.show', ['category' => $category]) }}" title="ดู">
                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </a>
                                <a href="{{ route('manage.categories.edit', ['category' => $category]) }}" title="แก้ไข">
                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                </a>
                                <form method="POST" action="{{ route('manage.categories.destroy', ['category' => $category]) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="ลบ" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {!! $categories->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>
        </div>
    </div>
@stop

@section('custom-js')
<script type="text/javascript">
    $('#table-categories').DataTable({
        bSort: false,
        searching: false,
        autoWidth: false,
        bPaginate: false,
        info: false
    });
</script>
@endsection