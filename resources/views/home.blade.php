<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{url('template/images/favicon.png')}}" type="image/x-icon">

  <title>{{ env('APP_NAME') }}</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{url('template/css/bootstrap.css') }}" />
  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />


  <!-- Custom styles for this template -->
  <link href="{{ url('template/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ url('template/css/responsive.css') }}" rel="stylesheet" />

  <style>
    html {
      scroll-behavior: smooth;
    }

    #header_nav {
     
    }

    #header_nav > li {
      margin-right: 25px;
      font-size:  18px;
      margin-top:  10px;
    }

    #header_nav > li a {
      color: #333;
      font-weight:  bold;
    }

    #header_nav > li a:hover {
      color: #7E0000;

    }


    #header_nav{
      list-style-type: none;
    }
  </style>
</head>

<body>
  <div class="hero_area " id="home">
    <div class="hero_bg_box">
      <img src="{{ url('template/images/hero-bg.jpg') }}" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <span>{{env('APP_NAME')}} CLINIC VET</span>
          </a>
          <div class="" id="">
            <ul id="header_nav" style="display:flex">
              <li><a href="#home">HOME</a></li>
              <li><a href="{{url('customer/login')}}">BOOK NOW</a></li>
              <li><a href="#services">SERVICES</a></li>
              <li><a href="#about">ABOUT US</a></li>
              <li><a href="#inquiry">INQUIRY</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

    <!-- slider section -->
    <section class="slider_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ">
            <div class="detail-box">
              <h1>
                We Will Take Care <br>
                Of Your Pets
              </h1>
              <h3>Treating your pets, just like our pets.</h3>
              <h3>Compassionate and high quality care.</h3>
              <h3>Committed to excellence in practice.</h3>
              <h6>"Pets are not our whole life, but they make our life whole."</h6>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <div class="main_content">
    <div class="main_content_bg">
      <img src="{{url('template/images/content-bg.jpg')}}" alt="">
    </div>

    <!-- service section -->
    <section class="service_section layout_padding" id="services">
      <div class="container py_mobile_45">
        <div class="heading_container heading_center">
          <h2> Our Services </h2>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="box ">
              <div class="img-box">
                <img src="{{url('template/images/s5.png')}}" alt="">
              </div>
              <div class="detail-box">
                <h5>Vaccination</h5>
                <p>We provide different kinds of vaccine including 5in1, 6in1, 8in1, Kennel Cough & Anti Rabies.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box ">
              <div class="img-box">
                <img src="{{url('template/images/s8.png')}}" alt="">
                
              </div>
              <div class="detail-box">
                <h5>Deworming</h5>
                <p>We removed parasites and bacteria inside your pet's tummy to make them feel more alive and better.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box ">
              <div class="img-box">
                <img src="{{url('template/images/s7.png')}}" alt="">
              </div>
              <div class="detail-box">
                <h5>Consultation</h5>
                <p>Discuss any questions you have with your pet. It's our opportunity to give your pet a thorough examination from head to tail.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="btn-box">
          <a href="{{url('customer/login')}}">Book Now</a>
        </div>
      </div>
    </section>

    <!-- end service section -->

    <!-- about section -->

    <section class="about_section" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img src="{{url('template/images/about-img.jpg')}}" alt="" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  About Us
                </h2>
              </div>
              <p>Anilife Veterinary Clinic is a full-service clinic that caters vaccination, consultation and deworming/heartworming service for your beloved four legged pets.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end about section -->

    <!-- schedule section -->

    <section class="care_section layout_padding" id="schedule">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>Clinic Schedule</h2>
              </div>
              <p>
                <h4><b>STRICTLY BY APPOINTMENT ONLY</b></h4>
                <h5>Clinic Hours:</h5><br>
                <h6>[9:00AM-04:00PM *ONLY]</h6>
                <h6>(Monday to Friday)</h6>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="{{url('template/images/care.jpg')}}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- schedule section -->

  


    <!-- inquiry section -->

    <section class="contact_section layout_padding" id="inquiry">
      <div class="container">
        <div class="heading_container">
          <h2>Got any questions for us? Inquire now</h2>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form_container">
                <span class="text-danger full-name-error"></span>
                <div>
                  <input type="text" id="full_name" placeholder="Full Name " />
                </div>
                <span class="text-danger email-error"></span>
                <div>
                  <input type="email" id="email_address" placeholder="Email Address" />
                </div>
                <span class="text-danger contact-error"></span>
                <div>
                  <input type="text" id="contact_no" placeholder="Contact Number" />
                </div>
                <span class="text-danger message-error"></span>
                <div>
                  <input type="text" class="message-box" id="message" placeholder="Message" style="height: 75px;"/>
                </div>
                <div class="d-flex">
                  <button id="btn_submit">SEND</button>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            {{-- <div class="map_container">
              <div class="mt-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1930.6047079983007!2d121.01103009596721!3d14.587139718351615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9c039a874d1%3A0x7b7398ad46764215!2sBrgy.%20899%2C%20Santa%20Ana%2C%20Manila%2C%20Metro%20Manila%2C%20Philippines!5e0!3m2!1sen!2sus!4v1637064974730!5m2!1sen!2sus" 
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </div>  
            </div> --}}
            <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=76-C%20Lopez%20Jaena%20Street,%20Brgy.%20Bagong%20Katipunan,%20Pasig,%20Philippines,%201600&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://2piratebay.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">add google maps html</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:600px;}</style></div></div>
          </div>
        </div>
      </div>
    </section>

    <!-- end inquiry section -->
  </div>

  <div class="modal fade" id="inquiry_modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Inquiry Submitted</h5>
        </div>
        <div class="modal-body">
          <p>We gratefully appreciate your inquiry!</p>
        </div>
      </div>
    </div>
  </div>

  <!-- info section -->

  <section class="info_section layout_padding2">
    <div class="info_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h6>
              About
            </h6>
            <p>
              Anilife Veterinary Clinic is a full-service clinic that caters vaccination, consultation and deworming/heartworming service for your beloved four legged pets.</p>
          </div>
          <div class="col-md-4">
            <h6>
              Useful Link
            </h6>
            <div class="info_link-box">
              <ul>
                <li class="active">
                  <a href="#home">
                    Home
                  </a>
                </li>
                <li>
                  <a href="#book">
                    Book Now
                  </a>
                </li>
                <li>
                  <a href="#services">
                    Services
                  </a>
                </li>
                <li>
                  <a href="#about">
                    About
                  </a>
                </li>
                <li>
                  <a href="#inquiry">
                    Inquiry
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <h6>
              Address
            </h6>
            <div class="contact_items">
              <a href="">
                <div class="item ">
                  <div class="img-box ">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <div class="detail-box">
                    <p>76-C Lopez Jaena Street, Brgy. Bagong Katipunan, Pasig, Philippines, 1600</p>
                  </div>
                </div>
              </a>
              <a href="">
                <div class="item ">
                  <div class="img-box ">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                  </div>
                  <div class="detail-box">
                    <p>Call +286422105</p>
                  </div>
                </div>
              </a>
              <a href="">
                <div class="item ">
                  <div class="img-box ">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                  </div>
                  <div class="detail-box">
                    <p>anilife.vet.clinic@gmail.com</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <footer class="container-fluid footer_section ">
    <p>
      &copy; <span id="displayDate"></span> All Rights Reserved. <span>{{env('APP_NAME')}} Clinic</span>
    </p>
  </footer>
  <!-- end  footer section -->

  <script src="{{ url('template/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ url('template/js/bootstrap.js') }}"></script>
  <!-- End Google Map -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="{{ url('template/js/custom.js') }}"></script>
  <!-- Axios JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
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
                            $('.full-name-error').show().text(errors[i])
                            break
                        } else {
                            $('#full_name').removeClass('is-invalid')
                            $('.full-name-error').hide()
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
  </script>
</body>

</html>