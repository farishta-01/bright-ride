<div class="modal-dialog">
    <div class="modal-content" style="background: linear-gradient(0deg, #ffffff 0%, #99e59a 100%)">
        <div class="modal-header" style="background-color: #5aeb5c">
            <h5 class="modal-title" id="exampleModalLabel">Add Car</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            {!! Form::open([
                'route' => 'admin.cars.store',
                'method' => 'POST',
                'enctype' => 'multipart/form-data', // Ensure enctype is set correctly
                'id' => 'add-car-form',
                'data-datatable' => '#car_table',
            ]) !!}
            @include('admin.featuredcars.inputs')
            {!! Form::submit('Add Car', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>



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
