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
    
    <title>Verify Email</title>
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
    <div class="bg-success text-white p-3 text-center">Congratulations! Your account is now verified. Redirecting you to login page. </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var url = "{{ url('/customer/verify-email') }}/"
            var payload = {
                _token: "{{ csrf_token() }}",
                verify_token: "{{ app('request')->segment(3) }}"
            }

            axios.put(url, payload)
            .then(function(response) {
                if (response.data.code == "422") {
                    console.log('Something went wrong')
                } else {
                    console.log('Your account is now verified, redirecting to login')
                    setTimeout(function() {
                        window.location.href = "{{url('/customer/login')}}"
                    }, 5000)
                }
            })
    </script>

    <script src="{{ url('assets/js/admin/particles.js') }}"></script>
    <script src="{{ url('assets/js/admin/particles-config.js') }}"></script>

</body>
</html>