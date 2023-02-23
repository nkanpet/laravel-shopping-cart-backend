@section('plugins.FileInput', true)
@section('plugins.Select2', true)

<div class="form-group">
    {{ Form::label('product category') }}
    {{ Form::select('product_categories[]', $categories->pluck('name', 'id')->toArray(), $product->categories->pluck('category_id')->toArray(), ['class' => 'form-control', 'id' => 'product_categories', 'placeholder' => '', 'multiple' => 'multiple']) }}
</div>
<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name', $product->name ?? '', ['class' => 'form-control', 'id' => 'name']) }}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('detail') }}
    {{ Form::text('detail', $product->detail ?? '', ['class' => 'form-control', 'id' => 'detail']) }}
    {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('price') }}
    {{ Form::number('price', $product->price ?? '', ['class' => 'form-control']) }}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('quantity') }}
    {{ Form::number('quantity', $product->quantity ?? '', ['class' => 'form-control']) }}
    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('image') }}
    {{ Form::file('image', ['class' => 'form-control']) }}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {{ Form::label('status') }}
    {{ Form::select('status', Config::get('constants.product_status_options'), $product->status ?? '', ['class' => 'form-control', 'id' => 'status']) }}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

@section('custom-js')
<script>
    $("input[name='image']").fileinput({
        theme: "fa5",
        showUpload: false,
        showCancel: false,
        dropZoneEnabled: false,
        previewFileType: 'any',
        showClose: false,
        maxFileCount: 1,
        maxFileSize: 2048,
        allowedFileTypes: ['image'],
        allowedFileExtensions: ["jpg", "jpeg", "png"],
        overwriteInitial: true,
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        initialPreview: "{{ isset($product) ? url(Storage::url($product->image)) : '' }}"
    });

    $("select[name='product_categories[]']").select2({
        multiple: true,
        placeholder: ''
    });
</script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest(isset($product) ? 'App\Http\Requests\ProductUpdateRequest' : 'App\Http\Requests\ProductStoreRequest') !!}
@endsection