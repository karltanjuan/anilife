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
    
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <style>
        .eye-icon-position {
            display: block;
            margin-top: -53px;
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
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="mt-5 img-fluid border border-5 border-white mx-auto d-block" style="padding: 1px; width: 120px;">
                                <h5 class="fw-bold text-center text-white lh-base pt-4">{{ env('APP_NAME') }} Clinic</h5>
                            </div>
                        </div>
                        <div class="col-md-8 login-col">
                            <h5 class="fw-bold text-center pt-4 login-title pb-2">Administrator Login</h5>
                            <div class="mx-5">
                                <div class="flash-container">
                                     @if(Session::has('error'))
                                        <p class="p-2 bg-danger text-white">
                                            {{Session::get('error')}}
                                        </p>
                                     @endif
                                </div>
                                <!-- Input Fields -->
                                <label for="username">Username</label>
                                <input type="text" class="form-control my-2" id="username" placeholder="Enter username" aria-label="Username">

                                <label for="password">Password</label>
                                <input type="password" class="form-control my-2 mb-4" id="password" placeholder="Enter password" aria-label="Password">
                                <span class="show eye-icon-position">
                                    <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i> 
                                </span>

                                <!-- Captcha Image -->
                                <label for="captcha">Captcha</label>
                                <br>
                                <small class="text-secondary" style="font-size: 11px;">Just to prove you are a human, please answer the math equation.</small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="captcha_container mb-1">
                                            {!! captcha_img() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control mb-2" id="captcha" placeholder="Enter answer" aria-label="Captcha">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="btn_reload">
                                                    <i class="las la-sync"></i>
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                
                                <!-- Forgot Password -->
                                <a href="{{ url('/admin/forgot-password') }}" class="forgot-pass">Forgot Password?</a>
                            </div>

                            <!-- Login Button -->
                            <button class="text-center mx-auto d-block loginBtn py-2 px-5 my-3 fw-bold text-white" id="btn_login">Log In</button>

                            <!-- Copyright -->
                            <p class="copyright text-center">Copyright &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
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
        let hide1 = document.querySelector("#show1");

        function toggle1() {
            if (state1) {
                document.getElementById("password").setAttribute("type", "password");
                hide1.style.color = "#D0CECE";
                hide1.classList.replace("la-eye-slash", "la-eye");
                state1 = false;
            } else {
                document.getElementById("password").setAttribute("type", "text");
                hide1.style.color = "#1976D2";
                hide1.classList.replace("la-eye", "la-eye-slash");
                state1 = true;
            }
        }

        $(document).on('click', '#btn_reload', function() {
            var url = "{{ url('/admin/reload-captcha') }}"

            axios.get(url)
            .then(function(response) {
                $('.captcha_container').html(response.data.captcha)
            })
        })

        $(document).on('keypress', '#username', function(e) {
            if (e.keyCode == "13") {
                login()
            }
        })

        $(document).on('keypress', '#password', function(e) {
            if (e.keyCode == "13") {
                login()
            }
        })

        $(document).on('keypress', '#captcha', function(e) {
            if (e.keyCode == "13") {
                login()
            }
        })

        $(document).on('click', '#btn_login', function() {
            login()
        })

        function login() {
            var url = "{{ url('/admin/login') }}"
            var payload = {
                _token: "{{ csrf_token() }}",
                username: $('#username').val(),
                password: $('#password').val(),
                captcha: $('#captcha').val(),
            }

            axios.post(url, payload)
            .then(function(response) {
                if (response.data.code == "422") {
                    var msg_length = response.data.message.length
                    if (msg_length > 0) {
                        var html = ""
                        html += '<p class="p-2 bg-danger text-white">'
                        if (response.data.message != "Invalid username or password") {
                            for (var i = 0; i < msg_length; i++) {
                                if (response.data.message[i] == "validation.captcha") {
                                    html += '<span>Captcha is invalid.</span><br>'
                                } else {
                                    html += '<span>'+response.data.message[i]+'</span><br>'
                                }
                            }
                        } else {
                            html += '<span>'+response.data.message+'</span><br>'
                        }
                        html += '</p>'
                    } else {
                        var html = '<p class="p-2 bg-danger text-white">'+response.data.message+'</p>'
                    }

                    $('.flash-container').html(html)
                } else if (response.data.code == "429") {
                    var html = '<p class="p-2 bg-danger text-white">'+response.data.message+'</p>'
                    $('.flash-container').html(html)
                } else {
                    var html = '<p class="p-2 bg-success text-white">'+response.data.message+'</p>'
                    $('.flash-container').html(html)
                    setTimeout(function() {
                        window.location.href = "{{url('/admin/dashboard')}}"
                    }, 1000)
                }
            })
        }
    </script>

    <script src="{{ url('assets/js/admin/particles.js') }}"></script>
    <script src="{{ url('assets/js/admin/particles-config.js') }}"></script>
</body>
</html>