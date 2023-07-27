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
    
    <title>Forgot Password</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
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
                                <h5 class="fw-bold text-center text-white lh-base pt-4">{{ env('APP_NAME') }}</h5>
                            </div>
                        </div>
                        <div class="col-md-8 login-col">
                            <h5 class="fw-bold text-center pt-4 login-title pb-2">Forgot Password</h5>
                            <div class="mx-5">
                                <div class="flash-container"></div>
                                <!-- Input Fields -->
                                <label for="email_address" class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="email_address" placeholder="Enter email address" aria-label="Email Address">
                            </div>

                            <!-- Login Button -->
                            <button class="text-center mx-auto d-block forgotPasswordBtn py-2 px-5 my-3 fw-bold text-white" id="btn_send">Send</button>

                            <!-- Copyright -->
                            <p class="copyright text-center">Copyright &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on('click', '#btn_send', function() {
            var url = "{{ url('/admin/forgot-password') }}"
            var payload = {
                _token: "{{ csrf_token() }}",
                email_address: $('#email_address').val(),
            }

            axios.post(url, payload)
            .then(function(response) {
                if (response.data.code == "422") {
                    var html = '<p class="p-2 bg-danger text-white">'+response.data.message+'</p>'
                    $('.flash-container').html(html)
                } else {
                    $('#email_address').prop('disabled', true)
                    var html = '<p class="p-2 bg-success text-white">'+response.data.message+'</p>'
                    $('.flash-container').html(html)
                }
            })
        
        })
    </script>

    <script src="{{ url('assets/js/admin/particles.js') }}"></script>
    <script src="{{ url('assets/js/admin/particles-config.js') }}"></script>

</body>
</html>