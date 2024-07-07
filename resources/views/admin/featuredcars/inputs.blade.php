<div class="row g-2">
    <div class="form-group col-md-6">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', !empty($car->title) ? $car->title : null, [
            'class' => 'form-control',
            'id' => 'title',
        ]) !!}
    </div>
    @php
        $currentYear = date('Y');
        $years = range(2000, $currentYear);
        $yearOptions = array_combine($years, $years);
    @endphp

    <div class="form-group col-md-4">
        {!! Form::label('model', 'Model:') !!}
        {!! Form::select('model', $yearOptions, !empty($car->model) ? $car->model : null, [
            'class' => 'form-control',
            'id' => 'model',
        ]) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('transmission', 'Transmission:') !!}
        {!! Form::select(
            'transmission',
            ['manual' => 'Manual', 'auto' => 'Auto'],
            !empty($car->transmission) ? $car->transmission : null,
            [
                'class' => 'form-control',
                'id' => 'transmission',
                'placeholder' => 'Select Transmission',
            ],
        ) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', !empty($car->description) ? $car->description : null, [
        'class' => 'form-control',
        'id' => 'description',
        'rows' => 3,
    ]) !!}
</div>

<div class="row g-3">
    <div class="form-group col-md-4">
        {!! Form::label('brand_id', 'Select Brand:') !!}
        {!! Form::select('brand_id', $brands->pluck('name', 'id'), !empty($brands->id) ? $brands->id : null, [
            'class' => 'form-control',
            'placeholder' => 'Select Brand',
        ]) !!}
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('mileage', 'Mileage:') !!}
        {!! Form::number('mileage', !empty($car->mileage) ? $car->mileage : null, [
            'class' => 'form-control',
            'id' => 'mileage',
        ]) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('price', 'Price:') !!}
        {!! Form::number('price', !empty($car->price) ? $car->price : null, [
            'class' => 'form-control',
            'id' => 'price',
        ]) !!}
    </div>
</div>

<div class="row mb-7 p-3" style="margin-top: 20px; margin-bottom: 55px;">
    <div class="form-group col-md-3">
        {!! Form::label('finput', 'Upload', ['class' => 'btn btn-primary btn-file']) !!}
        {!! Form::file('images[]', [
            'class' => 'form-control-file visually-hidden',
            'id' => 'finput',
            'accept' => 'image/*',
            'multiple' => true,
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
