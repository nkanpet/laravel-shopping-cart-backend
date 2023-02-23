@section('plugins.FileInput', true)

<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name', $client->name ?? '', ['class' => 'form-control', 'id' => 'name']) }}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('status') }}
    {{ Form::select('status', Config::get('constants.category_status_options'), $category->status ?? '', ['class' => 'form-control', 'id' => 'status']) }}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

@section('custom-js')
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\ClientStoreRequest') !!}
@endsection