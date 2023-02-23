@extends('adminlte::page')

@section('content_header')
<h1>client {{ $client->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('manage.clients.edit', ['client' => $client]) }}" title="แก้ไข">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-pen" aria-hidden="true"></i></button>
                </a>
                <form method="POST" action="{{ route('manage.clients.destroy', ['client' => $client]) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-sm" title="ลบ" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $client->id }}</td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>{{ $client->name }}</td>
                    </tr>
                    <tr>
                        <th>api token</th>
                        <td>{{ $client->api_token }}</td>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <td>{{ $client->status }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $client->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $client->updated_at }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <form method="POST" action="{{ route('manage.clients.refresh_token', ['client' => $client]) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary" title="Refresh API Token" onclick="return confirm('Confirm refresh api token?')">Refresh API Token</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection