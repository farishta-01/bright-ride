<div class="modal-dialog">
    <div class="modal-content" style="background: linear-gradient(180deg, #31cae8 0%, #ffffff 100%)">
        <div class="modal-header" style="background-color: rgb(113, 232, 240)">
            <h5 class="modal-title" id="exampleModalLabel">Update Car</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            {!! Form::open([
                'url' => route('admin.cars.update', $car->id),
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
                'id' => 'update-car-form',
                'data-datatable' => '#car_table',
            ]) !!}
            @include('admin.featuredcars.inputs')


            {!! Form::submit('Update Car', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>
<script>
    function uploadPreview(input) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        for (const file of input.files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }

    }
</script>
