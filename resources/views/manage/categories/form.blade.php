@section('plugins.FileInput', true)

<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name', $category->name ?? '', ['class' => 'form-control', 'id' => 'name']) }}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('parent_id') }}
    {{ Form::select('parent_id', $categories->pluck('name', 'id')->toArray(), $category->parent_id ?? '', ['class' => 'form-control', 'id' => 'parent_id', 'placeholder' => '']) }}
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('status') }}
    {{ Form::select('status', Config::get('constants.client_status_options'), $category->status ?? '', ['class' => 'form-control', 'id' => 'status']) }}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

@section('custom-js')
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest(isset($product) ? 'App\Http\Requests\ProductUpdateRequest' : 'App\Http\Requests\ProductStoreRequest') !!}
@endsection