@extends('admin.layout.app')
@section('css')
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Featured Cars</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Featured Cars</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            All Cars
                        </div>
                        {{-- <a class="btn btn-primary btn-modal" data-href="/admin/featured-cars/create"
                            data-container=".car_modal">
                            <i class="fas fa-plus"></i> Add Car
                        </a> --}}

                        <button type="button" class=" btn btn-success btn-modal"
                            data-href="{{ route('admin.cars.create') }}" data-container_modal=".view_modal">
                            <i class="fa fa-plus"></i>
                            Add Car</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="car_table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Images</th>
                                    <th>Milage</th>
                                    <th>Brand</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    {{-- <div class="modal fade car_modal_edit" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div> --}}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var roles_table = $('#car_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/featured-cars',
                columnDefs: [{
                    targets: [1],
                    orderable: false,
                    searchable: false,
                }, ],
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        render: function(data, type, row) {
                            return data + ' £'; // Append pound sign (£) to the price value
                        }
                    },
                    {
                        data: 'images',
                        name: 'images',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'mileage',
                        name: 'mileage',
                        render: function(data, type, row) {
                            return data + ' m/h'; // Append ' m/h' to the mileage value
                        }
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name',
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });

            $(document).on('click', 'button.delete_car_button', function() {
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
                                    $('#car_table').DataTable().ajax.reload();
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
