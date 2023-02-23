@extends('layouts.admin')

@section('content_header')
<h1>จัดการ user</h1>
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

            </div>

            <div class="card-body">
                <table class="table" id="table-users">
                    <thead>
                        <form>
                            <tr id="filters">
                                <th></th>
                                <th>
                                    <input name="name" class="form-control" value="{{ request()->get('name', '') }}" />
                                </th>
                                <th>
                                    <input name="email" class="form-control" value="{{ request()->get('email', '') }}" />
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
                            <th>email</th>
                            <th>สร้างเมื่อ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('manage.users.show', ['user' => $user]) }}" title="ดู">
                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {!! $users->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>
        </div>
    </div>
@stop

@section('custom-js')
<script type="text/javascript">
    $('#table-users').DataTable({
        bSort: false,
        searching: false,
        autoWidth: false,
        bPaginate: false,
        info: false
    });
</script>
@endsection