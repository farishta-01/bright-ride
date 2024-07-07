<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.partials.css')
    @yield('css')
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('admin.home') }}">Admin Panel</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        @if (auth()->check())
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    @else
                        <li class="nav-item px-1">
                            <a class="nav-link" href="{{ route('login.page') }}">Login</a>
                        </li>
        @endif
        </ul>
        </li>
        </ul>




    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('admin.home') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="{{ route('admin.client') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            User
                        </a>
                        {{-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div> --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Lists
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="{{ route('admin.cars') }}">
                                    Cars
                                </a>
                                <a class="nav-link" href="{{ route('admin.brands') }}">
                                    Brands
                                </a>
                            </nav>
                        </div>
                        {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div> --}}
                        <div class="sb-sidenav-footer" style="margin-top: 200px">
                            <div class="small">Logged in as:</div>
                            @auth
                                <div>{{ Auth::user()->name }}</div>
                            @else
                                <div>Guest</div>
                            @endauth
                        </div>
            </nav>
        </div>
        @yield('content')
        <div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
    </div>



    @include('admin.layout.partials.js')
    @yield('js')
    <script>
        $(document).ready(function() {
            // Function for handling click on '.btn-modal' elements
            $(document).on('click', '.btn-modal', function(e) {
                e.preventDefault();
                var container_modal = $(this).data('container_modal');
                $.ajax({
                    url: $(this).data('href'),
                    dataType: 'html',
                    success: function(result) {
                        $(container_modal).html(result).modal('show');

                        // Attach form submission handler after modal content is loaded
                        $(container_modal).find('form').on('submit', function(event) {
                            event.preventDefault(); // Prevent default form submission
                            $(this)
                                .find('button[type="submit"]')
                                .attr('disabled', true);
                            var formData = new FormData(this); // Create FormData object
                            var datatableSelector = $(this).data(
                                'datatable'); // Get DataTable selector

                            $.ajax({
                                url: $(this).attr('action'),
                                method: $(this).attr('method'),
                                data: formData,
                                contentType: false, // Ensure this is false when using FormData
                                processData: false, // Ensure this is false when using FormData

                                success: function(response) {
                                    $(container_modal).modal(
                                        'hide'); // Hide the modal
                                    if (response.success) {
                                        // alert(response.success)
                                        toastr.success(response
                                            .success
                                        ); // Show success message
                                    } else if (response.error) {
                                        toastr.error(response
                                            .error); // Show error message
                                    }

                                    if (datatableSelector) {
                                        $(datatableSelector).DataTable()
                                            .ajax
                                            .reload(); // Reload the specific DataTable
                                    }
                                },
                                error: function(xhr, status, error) {
                                    var errorMessage = xhr.responseJSON ?
                                        xhr.responseJSON.message :
                                        'Form submission failed';
                                    toastr.error(errorMessage);
                                    // Optionally, display an error message to the user
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Failed to load modal content');
                        // Optionally, display an error message to the user
                    }
                });
            });
        });

        $(document).on('click', '.modal_edit', function(e) {
            e.preventDefault();
            var container_edit = $(this).data('container_edit');

            $.ajax({
                url: $(this).data('href'),
                dataType: 'html',
                success: function(result) {
                    $('.car_modal_edit')
                        .html(result)
                        .modal('show');

                    // Initialize select2 inside the modal
                    $(container_edit).find('.select2').each(function() {
                        $(this).select2({
                            width: '100%'
                        });
                    });

                    // Attach form submission handler after modal content is loaded
                    $('#update-car-form').on('submit', function(event) {
                        event.preventDefault(); // Prevent default form submission

                        var formData = $(this).serialize(); // Serialize form data
                        var editdatatableSelector = $(this).data(
                            'datatable'); // Get DataTable selector
                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: formData,
                            success: function(response) {
                                $('.car_modal_edit').modal(
                                    'hide');
                                toastr.success(
                                    'Form submitted successfully');
                                $(editdatatableSelector).DataTable().ajax
                                    .reload(); // Reload DataTable
                            },
                            error: function(xhr, status, error) {
                                toastr.error('Form submission failed');
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    toastr.error('AJAX Error:', error);
                }
            });

        });
    </script>




</body>

</html>
