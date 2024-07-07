<div class="modal-dialog">
    <div class="modal-content" style="background: linear-gradient(0deg, #ffffff 0%, #99e59a 100%)">
        <div class="modal-header" style="background-color: #5aeb5c">
            <h5 class="modal-title" id="exampleModalLabel">Add Car</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body-content">

            {!! Form::open([
                'route' => 'admin.brands.store',
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'id' => 'add-brand-form',
                'data-datatable' => '#brand_table',
            ]) !!}
            @include('admin.brands.inputs')
            {!! Form::submit('Add Car', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>

{{-- <h1>Hey This is me</h1> --}}
