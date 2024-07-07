<div class="row g-2">
    <div class="form-group col-md-6">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', !empty($brand->title) ? $brand->title : null, [
            'class' => 'form-control',
            'id' => 'title',
        ]) !!}
    </div>
</div>
<div class="row mb-7 p-3" style="margin-top: 20px; margin-bottom: 55px;">
    <div class="form-group col-md-3">
        {!! Form::label('finput', 'Upload', ['class' => 'btn btn-primary btn-file']) !!}
        {!! Form::file('image', [
            'class' => 'form-control-file visually-hidden',
            'id' => 'finput',
            'accept' => 'image/*',
            'multiple' => false,
            'onchange' => 'uploadPreview(this)',
        ]) !!}
    </div>

    <div class="form-group col-md-6" id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;">
        @if (!empty($car->carImages))
            @foreach ($car->carImages as $image)
                <div class="image-container">
                    <img height="60px" src="{{ asset('storage/' . $image->image_path) }}" alt="Current Image"
                        style="max-width: 60px;">
                    <input type="hidden" name="existing_images[]" value="{{ $image->image_path }}">
                </div>
            @endforeach
        @endif
    </div>
</div>
