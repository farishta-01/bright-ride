<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BrightRide - Login</title>
    <link href="{{ url('/admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            color: #8a8484;
            text-transform: initial;
            max-width: 1920px;
            margin: 0 auto;
            overflow-x: hidden;
            background: rgb(5, 2, 57);
            background: linear-gradient(90deg, rgba(5, 2, 57, 1) 16%, rgba(121, 9, 77, 1) 58%);
        }

        .card {
            background: rgb(54, 52, 90);
            /* background: linear-gradient(90deg, rgb(87, 84, 140) 16%, rgb(174, 109, 148) 58%); */
        }

        input {
            background-color: rgb(112, 174, 228);
            /* Set your desired input field background color */
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Login</h3>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <form id="loginForm" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        aria-describedby="usernameHelp" placeholder="Enter username">
                                    <small id="usernameHelp" class="form-text text-muted">We'll never share your
                                        username with anyone else.</small>
                                    <div class="invalid-feedback" id="username_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                        <span class="input-group-text" onclick="togglePasswordVisibility()">
                                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback" id="passwordError"></div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            let isValid = true;

            // Clear previous errors
            document.getElementById('username_error').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('username').classList.remove('is-invalid');
            document.getElementById('password').classList.remove('is-invalid');

            // Validate username
            const username = document.getElementById('username').value;
            if (!username) {
                isValid = false;
                document.getElementById('username_error').textContent = 'Username is required.';
                document.getElementById('username').classList.add('is-invalid');
            }

            // Validate password
            const password = document.getElementById('password').value;
            if (!password) {
                isValid = false;
                document.getElementById('passwordError').textContent = 'Password is required.';
                document.getElementById('password').classList.add('is-invalid');
            }

            // If the form is valid, submit it
            if (isValid) {
                this.submit();
            }
        });

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const isPassword = passwordField.getAttribute('type') === 'password';

            if (isPassword) {
                passwordField.setAttribute('type', 'text');
                togglePasswordIcon.classList.remove('fa-eye');
                togglePasswordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.setAttribute('type', 'password');
                togglePasswordIcon.classList.remove('fa-eye-slash');
                togglePasswordIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
