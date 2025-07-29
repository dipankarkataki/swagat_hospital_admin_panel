<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>
        Login | Swagat Hospital Admin Panel
    </title>

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-styles.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
</head>

<body>
    <!-- App Start-->
    <div id="root">
        <!-- App Layout-->
        <div class="app-layout-blank flex flex-auto flex-col h-[100vh]">
            <main class="h-full">
                <div class="page-container relative h-full flex flex-auto flex-col">
                    <div class="h-full">
                        <div class="container mx-auto flex flex-col flex-auto items-center justify-center min-w-0 h-full">
                            <div class="card min-w-[320px] md:min-w-[450px] card-shadow" role="presentation">
                                <div class="card-body md:p-10">
                                    <div class="text-center">
                                        <div class="logo">
                                            <img class="mx-auto" src="{{ asset('assets/img/logo/swagat-logo.png') }}"
                                                alt="Swagat logo">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="mb-4 mt-4">
                                            <h3 class="mb-1">Welcome back!</h3>
                                            <p>Please enter your credentials to sign in!</p>
                                        </div>
                                        <div>
                                            <form id="loginForm">
                                                <div class="form-container vertical">
                                                    <div class="form-item vertical">
                                                        <label class="form-label mb-2">Email</label>
                                                        <div>
                                                            <input class="input" type="email" name="email" id="email" autocomplete="off" placeholder="e.g jhon doe">
                                                        </div>
                                                        <div class="error-message"></div>
                                                    </div>
                                                    <div class="form-item vertical">
                                                        <label class="form-label mb-2">Password</label>
                                                        <div>
                                                            <span class="input-wrapper">
                                                                <input class="input pr-8" type="password" name="password" id="password" autocomplete="off" placeholder="* * * * * * * *">
                                                                <div class="input-suffix-end">
                                                                    <span class="cursor-pointer text-xl" id="togglePassword">
                                                                        <svg id="eyeIcon" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="error-message"></div>
                                                    </div>
                                                    {{-- <div class="flex justify-between mb-6">
                                                        <label class="checkbox-label mb-0">
                                                            <input class="checkbox" type="checkbox" value="true"
                                                                checked>
                                                            <span class="ltr:ml-2 rtl:mr-2">Remember Me</span>
                                                        </label>
                                                        <a class="text-primary-600 hover:underline"
                                                            href="/">Forgot Password?</a>
                                                    </div> --}}
                                                    <button class="btn btn-solid w-full" type="submit" id="submitBtn">Sign In</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

    <!-- Core JS -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#togglePassword").click(function() {
                let passwordField = $("#password");
                let eyeIcon = $("#eyeIcon"); // Get the icon
                let type = passwordField.attr("type") === "password" ? "text" : "password";

                // Toggle the password field type
                passwordField.attr("type", type);

                // Toggle eye icon between "eye" (show) and "eye-off" (hide)
                if (type === "text") {
                    eyeIcon.html(
                        `
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        `
                        );
                } else {
                    eyeIcon.html(
                        `
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        `
                        );
                }
            });

            $('#loginForm').on('submit',function(e) {
                e.preventDefault();
                $('#submitBtn').prop('disabled', true);
                $('#submitBtn').text('Please wait...');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    url: "{{ route('login') }}",
                    type: "POST",
                    data:{
                        'email' : $('#email').val(),
                        'password' : $('#password').val(),
                    },
                    success:function(response){
                        if(response.success === true){
                            window.location.href = "{{ route('dashboard.index') }}";
                        }else{
                            toastr.error(response.message);
                            const errors = response.data;
                            for (const field in errors) {
                                const input = $(`[name="${field}"]`);
                                input.addClass('input-invalid');

                                input.closest('.form-item').find('.error-message').html(
                                    `<div class="text-red-500 mt-2">${errors[field][0]}</div>`
                                );
                            }
                            $('#submitBtn').prop('disabled', false);
                            $('#submitBtn').text('Sign In');
                        }
                    }, error:function(xhr){
                        if (xhr) {
                            toastr.error("Oops! Something went wrong. Please try later.");
                        }
                        $('#submitBtn').prop('disabled', false);
                        $('#submitBtn').text('Sign In');
                    }
                })
            });
        });
    </script>
</body>

</html>
