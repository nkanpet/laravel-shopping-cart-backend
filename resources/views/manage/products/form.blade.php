@section('plugins.FileInput', true)

<div class="form-group">
    {{ Form::label('name') }}
    {{ Form::text('name', $product->name ?? '', ['class' => 'form-control', 'id' => 'name']) }}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
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
</script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest(isset($product) ? 'App\Http\Requests\ProductUpdateRequest' : 'App\Http\Requests\ProductStoreRequest') !!}
@endsection