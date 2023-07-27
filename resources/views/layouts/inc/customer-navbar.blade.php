<!-- Navbar -->
<div class="top-navbar">
    <nav class="navbar sticky-top navbar-expand-lg">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-block d-block more-button">
                <i class="material-icons-outlined">menu</i>
            </button>
            <button id="sidebarCollapse" type="button" class="d-xl-block d-lg-block d-md-block d-block w-auto" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <i class="las la-user-circle fs-3"></i> --}}
                @if (auth()->user()->photo == null)
                    <img id="preview" class="img-responsive d-flex mx-auto w-100" src="{{url('assets/images/pet-logo.png')}}" alt="" style="width: 50px !important; height:  50px;border-radius:50%;padding: 5px;">
                @else
                    <img id="preview" class="img-responsive d-flex mx-auto w-100" src="{{asset('storage/images/profile')}}/{{auth()->user()->photo}}" alt="" style="width: 50px !important; height:  50px;border-radius:50%;padding: 5px;">
                @endif

            </button>
            <!-- Dropdown - User Information -->
            <div class="profile dropdown-menu dropdown-menu-end me-2 shadow dropend" aria-labelledby="userDropdown">
                <p class="admin-name text-center m-0 text-secondary fw-bold">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </p>
                <p class="admin-pos text-center m-0 text-secondary">
                    <span>Customer</span>
                    @if (auth()->user()->status == 1)
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-danger">Not Verified</span>
                    @endif
                </p>
                                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item user-dd text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#profile_modal">
                    <i class="las la-user-edit fs-6"></i> Edit Profile
                </a>
                <a class="dropdown-item user-dd text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#password_modal">
                    <i class="las la-user-cog fs-6"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item user-dd text-secondary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="las la-sign-out-alt fs-5"></i> Logout
                </a>
            </div>
        </div>
    </nav>
</div>
<!-- /Navbar -->

<!-- Edit Profile Modal-->
<div class="modal fade" id="profile_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 photo-container">
                        <label class="form-label text-center">Preview Photo</label>
                        @if (auth()->user()->photo == null)
                            <img id="preview" class="img-responsive d-flex mx-auto w-100" src="{{url('assets/images/pet-logo.png')}}" alt="" style="max-width: 150px; height:  150px;border: 1px solid #333;border-radius:50%;padding: 5px;">
                        @else
                            <img id="preview" class="img-responsive d-flex mx-auto w-100" src="{{asset('storage/images/profile')}}/{{auth()->user()->photo}}" alt="" style="max-width: 150px; height:  150px;border: 1px solid #333;border-radius:50%;padding: 5px;">
                        @endif
                    </div>

                    <div class="col-md-6 mb-2 photo-container">
                        <div class="form-group">
                            <label for="photo" class="form-label">Photo</label>
                            <input class="form-control" type="file" accept="image/png" name="photo" placeholder="Choose photo" id="photo" onchange="previewPhoto(event)"/>
                        </div>
                    </div>

                    <div class="col-md-4 position-relative my-2">
                        <label for="profile_first_name" class="form-label">First name</label>
                        <input type="text" class="form-control" id="profile_first_name" placeholder="First name" required value="{{auth()->user()->first_name}}">
                        <div class="invalid-feedback profile-first-name-error"></div>
                    </div>
                     <div class="col-md-4 position-relative my-2">
                        <label for="profile_middle_name" class="form-label">Middle name</label>
                        <input type="text" class="form-control" id="profile_middle_name" placeholder="Middle name" required value="{{auth()->user()->middle_name}}">
                        <div class="invalid-feedback profile-middle-name-error"></div>
                    </div>  
                    <div class="col-md-4 position-relative my-2">
                        <label for="profile_last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="profile_last_name" placeholder="Last name" required value="{{auth()->user()->last_name}}">
                        <div class="invalid-feedback profile-last-name-error"></div>
                    </div>

                    <div class="col-md-4 position-relative my-2">
                        <label for="profile_sex" class="form-label">Sex</label>
                        <select class="form-control" id="profile_sex">
                            <option disabled selected>Select sex</option>
                            <option value="0" @if(auth()->user()->sex == 0) selected @endif>Male</option>
                            <option value="1" @if(auth()->user()->sex == 1) selected @endif>Female</option>
                        </select>
                        <div class="invalid-feedback profile-sex-error"></div>
                    </div>

                    <div class="col-md-4 position-relative my-2">
                        <label for="profile_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="profile_username" placeholder="Username" required value="{{auth()->user()->username}}">
                        <div class="invalid-feedback profile-username-error"></div>
                    </div>

                    <div class="col-md-4 position-relative my-2">
                        <label for="profile_email_address" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="profile_email_address" placeholder="user@sample.com" required value="{{auth()->user()->email_address}}">
                        <div class="invalid-feedback profile-email-address-error"></div>
                    </div>
                    
                    <div class="col-md-6 position-relative my-2">
                        <label for="profile_contact_no" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" id="profile_contact_no" pattern="[0][9][0-9]{9}" placeholder="09XXXXXXXXX" required value="{{auth()->user()->contact_no}}">
                        <div class="invalid-feedback profile-contact-no-error"></div>
                    </div>

                    <div class="col-md-6 position-relative my-2">
                        <label for="profile_address" class="form-label">Complete Address</label>
                        <input type="tel" class="form-control" id="profile_address" placeholder="Enter complete address" required value="{{auth()->user()->address}}">
                        <div class="invalid-feedback profile-address-error"></div>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="btn_update_profile">Update Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Profile Modal-->

<!-- Change Password Modal-->
<div class="modal fade" id="password_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="col-12 position-relative">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" placeholder="Current Password" required>
                        <!-- Show Password -->
						<span class="show eye-icon-position">
                            <i class="las la-eye fs-5" id="show1" onclick="toggle1()"></i> 
						</span>
						<!-- //Show Password -->
                        <div class="invalid-feedback current-password-error"></div>
                    </div>
                    <div class="col-12 position-relative">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" placeholder="New Password" required>
                        <!-- Show Password -->
						<span class="show eye-icon-position">
                            <i class="las la-eye fs-5" id="show2" onclick="toggle2()"></i> 
						</span>
						<!-- //Show Password -->
                        <div class="invalid-feedback new-password-error"></div>
                    </div>
                    <div class="col-12 position-relative">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                        <!-- Show Password -->
						<span class="show eye-icon-position">
                            <i class="las la-eye fs-5" id="show3" onclick="toggle3()"></i> 
						</span>
						<!-- //Show Password -->
                        <div class="invalid-feedback confirm-password-error"></div>
                    </div>
                    <div class="col-12 text-end mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="btn_update_password">Update Password</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- /Change Password Modal-->

<div class="modal fade" id="password_success_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Password Updated</h5>
            </div>
            <div class="modal-body">
                <p>Password updated successfully!</p>
            </div>
            <div class="modal-footer">
                <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profile_success_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Updated</h5>
            </div>
            <div class="modal-body">
                <p>Profile updated successfully!</p>
            </div>
            <div class="modal-footer">
                <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="staticBackdropLabel">Ready to Leave?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Select <b>"Logout"</b> below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ url('customer/logout') }}" type="button" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- /Logout Modal-->

<script type="text/javascript">

    var previewPhoto = function(e) {
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(e.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };

    $('.photo-container').show()

    $(document).on('click', '#btn_update_password', function() {
        var url = "{{url('/customer/password/update')}}"
        var payload = {
            _token: "{{ csrf_token() }}",
            current_password: $('#current_password').val(),
            new_password: $('#new_password').val(),
            password_confirmation: $('#confirm_password').val(),
        }

        axios.post(url, payload)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var current_password_error = errors[i].indexOf('current') !== -1
                        var new_password_error     = errors[i].indexOf('new') !== -1
                        var confirm_password_error = errors[i].indexOf('confirmation') !== -1

                        if (current_password_error) {
                            $('#current_password').addClass('is-invalid')
                            $('.current-password-error').show().text(errors[i])
                            break
                        } else {
                            $('#current_password').removeClass('is-invalid')
                            $('.current-password-error').hide()
                        }

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
                    $('#password_modal').modal('hide')
                    $('#password_success_modal').modal('show')
                }
            })
    })

    $(document).on('click', '#btn_update_profile', function() {
        var url = "{{url('/customer/profile/update')}}"
        // var payload = {
        //     _token: "{{ csrf_token() }}",
        //     profile_first_name: $('#profile_first_name').val(),
        //     profile_middle_name: $('#profile_middle_name').val(),
        //     profile_last_name: $('#profile_last_name').val(),
        //     profile_gender: $('#profile_gender').val(),
        //     profile_username: $('#profile_username').val(),
        //     profile_email_address: $('#profile_email_address').val(),
        //     profile_contact_no: $('#profile_contact_no').val(),
        //     profile_address: $('#profile_address').val(),
        // }

        // axios.post(url, payload)


         var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('profile_first_name', $('#profile_first_name').val());
        formData.append('profile_middle_name', $('#profile_middle_name').val());
        formData.append('profile_last_name', $('#profile_last_name').val());
        formData.append('profile_sex', $('#profile_sex').val());
        formData.append('profile_username', $('#profile_username').val());
        formData.append('profile_email_address', $('#profile_email_address').val());
        formData.append('profile_contact_no', $('#profile_contact_no').val());
        formData.append('profile_address', $('#profile_address').val());
        formData.append('photo', document.querySelector("#photo").files[0]);

        var headers = {'Content-Type': 'multipart/form-data' } // to allow file uploads


        axios.post(url, formData, headers)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var profile_first_name_error = errors[i].indexOf('first') !== -1
                        var profile_last_name_error  = errors[i].indexOf('last') !== -1
                        var profile_sex_error        = errors[i].indexOf('sex') !== -1
                        var profile_username_error   = errors[i].indexOf('username') !== -1
                        var profile_email_error      = errors[i].indexOf('email') !== -1
                        var profile_contact_error    = errors[i].indexOf('contact') !== -1
                        var profile_address_error    = errors[i].indexOf('address') !== -1

                        if (profile_first_name_error) {
                            $('#profile-first_name').addClass('is-invalid')
                            $('.profile-first-name-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile-first_name').removeClass('is-invalid')
                            $('.profile-first-name-error').hide()
                        }

                        if (profile_last_name_error) {
                            $('#profile_last_name').addClass('is-invalid')
                            $('.profile-last-name-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile_last_name').removeClass('is-invalid')
                            $('.profile-last-name-error').hide()
                        }

                        if (profile_sex_error) {
                            $('#profile_sex').addClass('is-invalid')
                            $('.profile-sex-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile_sex').removeClass('is-invalid')
                            $('.profile-sex-error').hide()
                        }

                        if (profile_username_error) {
                            $('#profile_username').addClass('is-invalid')
                            $('.profile-username-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile_username').removeClass('is-invalid')
                            $('.profile-username-error').hide()
                        }

                        if (profile_email_error) {
                            $('#profile-_mail_address').addClass('is-invalid')
                            $('.profile-email-address-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile_email_address').removeClass('is-invalid')
                            $('.profile-email-address-error').hide()
                        }

                        if (profile_contact_error) {
                            $('#profile_contact_no').addClass('is-invalid')
                            $('.profile-contact-no-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile_contact_no').removeClass('is-invalid')
                            $('.profile-contact-no-error').hide()
                        }

                        if (profile_address_error) {
                            $('#profile_address').addClass('is-invalid')
                            $('.profile-address-error').show().text(errors[i])
                            break
                        } else {
                            $('#profile_address').removeClass('is-invalid')
                            $('.profile-address-error').hide()
                        }

                    }
                } else {
                    $('#profile_modal').modal('hide')
                    $('#profile_success_modal').modal('show')
                    setTimeout(function() {
                        window.location.href = "{{url('/customer/appointments')}}" 
                    }, 3000)
                }
            })
    })
    
</script>

