@extends('admin.layout.app')
@section('css')
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Brands</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            All brands
                        </div>
                        {{-- <a href="javascript:void(0)" id="brands-modal" class="btn btn-primary btn-modal-brand"
                            data-href="/admin/brands/create" data-container_brand=".brand_modal">
                            <i class="fas fa-plus"></i> Add Brand
                        </a> --}}


                        <button type="button" class="btn btn-success btn-modal"
                            data-href="{{ route('admin.brands.create') }}" data-container_modal=".view_modal">
                            <i class="fa fa-plus"></i>
                            Add Brand
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="brand_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade brand_modal_edit" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            </div>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var roles_table = $('#brand_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/brands',
                columnDefs: [{
                    targets: [1],
                    orderable: false,
                    searchable: false,
                }, ],
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });

            $(document).on('click', 'button.delete_brand_button', function() {
                swal({
                    title: 'Sure',
                    text: 'Confirm Delete User',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = {
                            _token: '{{ csrf_token() }}' // Ensure the CSRF token is included
                        };

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.success);
                                    $('#brand_table').DataTable().ajax.reload();
                                } else {
                                    toastr.error(result.error);
                                }
                            },
                            error: function(result) {
                                toastr.error(
                                    'An error occurred while deleting the user.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
