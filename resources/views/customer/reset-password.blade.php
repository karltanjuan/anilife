<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/login.css') }}">
    
    <title>Reset Password</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <style>
        .eye-icon-position {
            display: block;
            margin-top: -30px;
            float: right;
            margin-right: 10px;
        }

        .eye-icon-position2 {
            display: block;
            margin-top: -35px;
            float: right;
            margin-right: 10px;
        }
    </style> 
</head>
<body class="user-select-none">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-7 mx-auto">
                <div class="card shadow border">
                    <div class="row gx-0">
                        <div class="col-md-4 login-col1 p-3">
                            <div class="">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="mt-5 img-fluid border rounded-circle border-5 border-white mx-auto d-block" style="padding: 1px; width: 120px;">
                                <h5 class="fw-bold text-center text-white lh-base pt-4">{{env('APP_NAME')}}</h5>
                            </div>
                        </div>
                        <div class="col-md-8 login-col">
                            <h5 class="fw-bold text-center pt-4 login-title pb-2">Reset Password</h5>
                            <div class="mx-5">
                                <div class="flash-container"></div>
                                <!-- Input Fields -->
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" placeholder="New Password" required>
                                <span class="show eye-icon-position">
                                    <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i> 
                                </span>
                                <div class="invalid-feedback new-password-error"></div>

                                <label for="confirm_password" class="form-label mt-3">Confirm Password</label>
                                <input type="password" class="form-control mb-2" id="confirm_password" placeholder="Confirm Password" aria-label="Confirm Password">
                                <span class="show eye-icon-position2">
                                    <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i> 
                                </span>
                                <div class="invalid-feedback confirm-password-error"></div>
                            </div>

                            <!-- Login Button -->
                            <button class="text-center mx-auto d-block resetPasswordBtn py-2 px-5 my-3 fw-bold text-white" id="btn_reset">Reset</button>

                            <!-- Copyright -->
                            <p class="copyright text-center">Copyright &copy; {{ date('Y') }} {{env('APP_NAME')}}. All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        var state1 = false;
        var state2 = false;
        let hide1 = document.querySelector("#show1");
        let hide2 = document.querySelector("#show2");

        function toggle1() {
            if (state1) {
                document.getElementById("new_password").setAttribute("type", "password");
                hide1.style.color = "#D0CECE";
                hide1.classList.replace("la-eye-slash", "la-eye");
                state1 = false;
            } else {
                document.getElementById("new_password").setAttribute("type", "text");
                hide1.style.color = "#1976D2";
                hide1.classList.replace("la-eye", "la-eye-slash");
                state1 = true;
            }
        }

        function toggle2() {
            if (state2) {
                document.getElementById("confirm_password").setAttribute("type", "password");
                hide2.style.color = "#D0CECE";
                hide2.classList.replace("la-eye-slash", "la-eye");
                state2 = false;
            } else {
                document.getElementById("confirm_password").setAttribute("type", "text");
                hide2.style.color = "#1976D2";
                hide2.classList.replace("la-eye", "la-eye-slash");
                state2 = true;
            }
        }

        $(document).on('click', '#btn_reset', function() {
            var url = "{{ url('/admin/reset-password') }}/"
            var payload = {
                _token: "{{ csrf_token() }}",
                reset_token: "{{ app('request')->segment(3) }}",
                new_password: $('#new_password').val(),
                password_confirmation: $('#confirm_password').val()
            }

            axios.put(url, payload)
            .then(function(response) {
                if (response.data.code == "422") {
                    var html = '<p class="p-2 bg-danger text-white">'+response.data.error+'</p>'
                    if (response.data.error == "Token link is expired.") {
                        $('.flash-container-expired').html(html)
                        $('.container').hide();
                    }

                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var new_password_error    = errors[i].indexOf('new') !== -1
                        var confirm_password_error    = errors[i].indexOf('confirmation') !== -1

                        if (new_password_error) {
                            $('#new_password').addClass('is-invalid')
                            $('.new-password-error').show().text(errors[i])
                            break
                        } else {
                            $('#new_password').removeClass('is-invalid')
                            $('.new-password-error').hide()
                        }

                        if (confirm_password_error) {
                            $('#confirm_password').addClass('is-invalid')
                            $('.confirm-password-error').show().text(errors[i])
                            break
                        } else {
                            $('#confirm_password').removeClass('is-invalid')
                            $('.confirm-password-error').hide()
                        }
                    }

                } else {
                    var html = '<p class="p-2 bg-success text-white">'+response.data.message+'</p>'
                    $('.flash-container').html(html)
                    setTimeout(function() {
                        window.location.href = "{{url('/admin/login')}}"
                    }, 1000)
                }
            })
        
        })
    </script>

    <script src="{{ url('assets/js/admin/particles.js') }}"></script>
    <script src="{{ url('assets/js/admin/particles-config.js') }}"></script>

</body>
</html>