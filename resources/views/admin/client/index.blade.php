@extends('admin.layout.app')
@section('css')
@endsection
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Registered Clients</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Clients
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="client_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            @endsection
            @section('js')
                <script>
                    $(document).ready(function() {
                        // console.log('123');

                        var client_table = $('#client_table').DataTable({
                            processing: true,
                            serverSide: true,
                            // console('hellow');
                            ajax: '/admin/clients',
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
                                    data: 'email',
                                    name: 'email'
                                },
                                {
                                    data: 'username',
                                    name: 'username'
                                },
                                {
                                    data: 'role',
                                    name: 'role'
                                },
                                {
                                    data: 'action',
                                    name: 'action'
                                },
                            ],
                        });

                        $(document).on('click', 'button.delete_user_button', function() {
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
                                                $('#client_table').DataTable().ajax.reload();
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
