<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BrightRide - Register</title>
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
        }

        input {
            background-color: rgb(112, 174, 228);
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
                            <h3 class="text-center font-weight-light my-4">Register</h3>
                        </div>
                        <div class="card-body">
                            <form id="registerForm" method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name">
                                    <div class="invalid-feedback" id="name_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter username (optional)">
                                    <div class="invalid-feedback" id="username_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter email">
                                    <div class="invalid-feedback" id="email_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                        <span class="input-group-text"
                                            onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
                                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback" id="password_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm password">
                                        <span class="input-group-text"
                                            onclick="togglePasswordVisibility('password_confirmation', 'toggleConfirmPasswordIcon')">
                                            <i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback" id="password_confirmation_error"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="{{ route('login.page') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            let isValid = true;

            // Clear previous errors
            ['name_error', 'username_error', 'email_error', 'password_error', 'password_confirmation_error'].forEach
                (id => {
                    document.getElementById(id).textContent = '';
                });
            ['name', 'username', 'email', 'password', 'password_confirmation'].forEach(id => {
                document.getElementById(id).classList.remove('is-invalid');
            });

            // Validate name
            const name = document.getElementById('name').value;
            if (!name) {
                isValid = false;
                document.getElementById('name_error').textContent = 'Name is required.';
                document.getElementById('name').classList.add('is-invalid');
            }

            // Validate username (optional)
            const username = document.getElementById('username').value;
            if (username && !/^[a-zA-Z0-9]+$/.test(username)) {
                isValid = false;
                document.getElementById('username_error').textContent = 'Username must be alphanumeric.';
                document.getElementById('username').classList.add('is-invalid');
            }

            // Validate email
            const email = document.getElementById('email').value;
            if (!email) {
                isValid = false;
                document.getElementById('email_error').textContent = 'Email is required.';
                document.getElementById('email').classList.add('is-invalid');
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                isValid = false;
                document.getElementById('email_error').textContent = 'Email format is invalid.';
                document.getElementById('email').classList.add('is-invalid');
            }

            // Validate password
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            if (!password) {
                isValid = false;
                document.getElementById('password_error').textContent = 'Password is required.';
                document.getElementById('password').classList.add('is-invalid');
            }

            // Validate confirm password
            if (password !== passwordConfirmation) {
                isValid = false;
                document.getElementById('password_confirmation_error').textContent = 'Passwords do not match.';
                document.getElementById('password_confirmation').classList.add('is-invalid');
            }

            // If the form is valid, submit it
            if (isValid) {
                this.submit();
            }
        });

        function togglePasswordVisibility(id, iconId) {
            const passwordField = document.getElementById(id);
            const togglePasswordIcon = document.getElementById(iconId);
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
