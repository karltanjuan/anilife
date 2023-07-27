<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Inquiries</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Logo -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/inquiry.css') }}">
</head>
<body>

    <!-- Navigation Bar -->
    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"> <img src="{{URL::asset('assets/images/logo.png')}}" alt="logo" height="50" width="50">&ensp; Anilife</a>
                <button class="navbar-toggler" type="button"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 float-end text-end">
                        <li class="nav-item">
                           <a class="nav-link ms-4 menuBtn text-end" href="/"> <strong>Home</strong></a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>
    </header>
    <!-- /Navigation Bar -->
    
    <!-- Inquiries -->
    <section id="inquiry">
        <div class="container">         
            <div class="row align-items-center">
                    <div class="col-lg-5 text-center">
                        <img src="{{ asset('assets/images/inquiry.svg') }}" alt="bg" class="img-fluid fbbg">
                    </div>
                    <div class="col-lg-7 text-center text-md-start text-lg-start text-xl-start">
                        <div class="form-container">
                            <div class="outerbox">
                                <div class="innerbox">
                                    <h2 class="text-center"><b>Got any questions for us?</b></h2>
                                    <p class="text-center">@lang('auth.fb_desc')</p>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input type="text" pattern="^[a-z A-Z,-]{4,30}\b$" class="form-control" id="full_name" name="full_name" placeholder="@lang('auth.fb_fullname')" required="">
                                            <div class="invalid-feedback fullname-error"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <input type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" message="Example: sample@gmail.com" title="Please follow the format" class="form-control" id="email_address" name="email_address" placeholder="@lang('auth.fb_email')" required="">
                                            <div class="invalid-feedback email-error"></div>
                                           
                                        </div>

                                        <div class="col-md-6">
                                            <input type="tel" pattern="^[0][1-9]\d{9}$|^[1-9]\d{9}$" class="form-control" id="contact_no" name="contact_no" placeholder="@lang('auth.fb_contact_no')" required="numeric" type="hiddem">
                                            <div class="invalid-feedback contact-error"></div>
                                        </div>

                                        <div class="col-12">
                                            <textarea class="form-control" id="message" rows="5" name="message" placeholder="@lang('auth.fb_comment')" required></textarea>
                                            <div class="invalid-feedback message-error"></div>
                                        </div>

                                        <div class="col-12">
                                            <center>
                                                <button class="btn_submit" id="btn_submit">@lang('auth.fb_submit_btn')</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="inquiry_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('auth.fbSuccess_modal_header')</h5>
                </div>
                <div class="modal-body">
                    <p>@lang('auth.fbSuccess_modal_body')</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_back" data-bs-dismiss="modal">@lang('auth.fbSuccess_modal_okay')</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <p class="copyright">Copyright &copy; {{date('Y')}} {{ env('APP_NAME') }}. All rights reserved.</p>
    </footer>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 

    <!-- Axios JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(activateJS());

        function activateJS() {
            
        }

        // submit inquiry ajax
        $('#btn_submit').on('click', function() {
            var url = "{{url('/inquiry')}}";

            var payload = {
                _token: "{{ csrf_token() }}",
                full_name: $('#full_name').val(),
                email_address: $('#email_address').val(),
                contact_no: $('#contact_no').val(),
                message: $('#message').val()
            }

            axios.post(url, payload)
                 .then(function(response) {
                    if (response.data.code == 422) {
                        var errors = response.data.error
                        for (var i = 0; i < errors.length; i++) {
                            var fullname_error = errors[i].indexOf('full name') !== -1
                            var email_error    = errors[i].indexOf('email') !== -1
                            var contact_error  = errors[i].indexOf('contact') !== -1
                            var message_error  = errors[i].indexOf('message') !== -1

                            if (fullname_error) {
                                $('#full_name').addClass('is-invalid')
                                $('.fullname-error').show().text(errors[i])
                                break
                            } else {
                                $('#full_name').removeClass('is-invalid')
                                $('.fullname-error').hide()
                            }

                            if (email_error) {
                                $('#email_address').addClass('is-invalid')
                                $('.email-error').show().text(errors[i])
                                break
                            } else {
                                $('#email_address').removeClass('is-invalid')
                                $('.email-error').hide()
                            }

                            if (contact_error) {
                                $('#contact').addClass('is-invalid')
                                $('.contact-error').show().text(errors[i])
                                break
                            } else {
                                $('#contact').removeClass('is-invalid')
                                $('.contact-error').hide()
                            }

                            if (message_error) {
                                $('#message').addClass('is-invalid')
                                $('.message-error').show().text(errors[i])
                                break
                            } else {
                                $('#message').removeClass('is-invalid')
                                $('.message-error').hide()
                            }
                        }
                    } else {
                        // display modal
                        $('#full_name').removeClass('is-invalid')
                        $('.fullname-error').hide()

                        $('#email_address').removeClass('is-invalid')
                        $('.email-error').hide()

                        $('#contact').removeClass('is-invalid')
                        $('.contact-error').hide()

                        $('#message').removeClass('is-invalid')
                        $('.message-error').hide()

                        $('#inquiry_modal').modal('show')
                        setTimeout(function() {
                            location.href = "{{url('/')}}" // back to homepage
                        }, 3000)
                    }
                 })
        })

        $(document).on('click', '.btn_back', function() {
            location.href = "{{url('/')}}" // back to homepage
        })
    </script>

</body>
</html>