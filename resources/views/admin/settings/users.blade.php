@extends('layouts.master')

@section('title', 'User Management')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">User Management</h5>
        </div>
        <div class="col-lg-8 text-middle">
            <div class="text-lg-end text-center me-0 me-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group input-group-sm float-lg-end" style="width: 300px;">
                            <span class="input-group-text iconS" id="basic-addon1"><span class="material-icons-outlined text-secondary">search</span></span>
                            <input type="search" class="form-control" id="filterbox" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-outline-primary rounded-pill border-2 tableBtn" id="btn_add">
                            <i class="las la-plus fs-6 fw-bolder"></i>User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="user_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email Address</th>
                            <th>Contact No.</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email_address }}</td>
                                <td>{{ $user->contact_no }}</td>
                                <td>{{ $user->role == 1 ? 'Admin' : 'Staff' }}</td>
                                <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($user->created_at)) }}</td>
                                
                                <td class="text-center">
                                    <a id="btn_edit" class="btn_edit" data-id="{{$user->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
                                    </a>
                                    @if ($user->id != 1)
                                    <a id="btn_delete" class="btn_delete" data-id="{{$user->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        <i class="las la-trash text-danger"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">No records found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /User Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title user-modal-title" id="staticBackdropLabel">Create User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">
                        <div class="col-md-4 mb-2">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" type="text" class="form-control" placeholder="Enter first name">
                            <div class="invalid-feedback first-name-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input id="middle_name" type="text" class="form-control" placeholder="Enter middle name">
                            <div class="invalid-feedback middle-name-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control" placeholder="Enter last name">
                             <div class="invalid-feedback last-name-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" placeholder="Enter username">
                            <div class="invalid-feedback username-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="email_address" class="form-label">Email</label>
                            <input id="email_address" type="text" class="form-control" placeholder="Enter email address">
                            <div class="invalid-feedback email-address-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" placeholder="Enter password">
                            <div class="invalid-feedback password-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input id="contact_no" type="text" class="form-control" placeholder="Enter contact number">
                            <div class="invalid-feedback contact-no-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" class="form-control" placeholder="Enter role">
                                <option disabled selected>Select role...</option>
                                <option value="1">Admin</option>
                                <option value="2">Staff</option>
                            </select>
                            <div class="invalid-feedback role-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-control" placeholder="Enter status">
                                <option disabled selected>Select status...</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                            <div class="invalid-feedback status-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success user-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Delete User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-danger" id="btn_remove">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create_success_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Created</h5>
                </div>
                <div class="modal-body">
                    <p>User created successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_success_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Updated</h5>
                </div>
                <div class="modal-body">
                    <p>User updated successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_success_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Deleted</h5>
                </div>
                <div class="modal-body">
                    <p>User deleted successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    var user_id = 0

    function getUserById(id) {
        var url = "{{ url('/admin/settings/users') }}/"+user_id
        var payload = {
            id: user_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.user, function(x,y) {
                $('#first_name').val(y.first_name)
                $('#middle_name').val(y.middle_name)
                $('#last_name').val(y.last_name)
                $('#username').val(y.username)
                $('#email_address').val(y.email_address)
                $('#contact_no').val(y.contact_no)
                $('#role option[value="'+y.role+'"]').attr('selected','selected')
                $('#status option[value="'+y.status+'"]').attr('selected','selected')
            })
        })
    }

    $(document).on('click', '#btn_add', function() {
        $('.user-modal-title').text('Create User')
        $('.user-modal-btn').text('Save')
        $('#add-edit-modal input').val("")
        $('#role > option:first').prop('selected', true)
        $('#status > option:first').prop('selected', true)

        $('#add-edit-modal').modal('show')
        $('#password').parent().show()
    })

    let user = {}

    $(document).on('click', '.btn_edit', function() {
        user_id = $(this).attr('data-id')
        $('.user-modal-title').text('Update User')
        $('.user-modal-btn').text('Update')

        if (user_id == 1) {
            $('#role').attr('disabled', true)
            $('#status').attr('disabled', true)
        } else {
            $('#role').attr('disabled', false)
            $('#status').attr('disabled', false)
        }

        getUserById(user_id)

        $('#add-edit-modal').modal('show')
        $('#password').parent().hide()
    })

    $(document).on('click', '.user-modal-btn', function() {

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/admin/settings/users/store')}}"
            event = "save"

            $('#password').show()
        } else {
            var url = "{{url('/admin/settings/users/update')}}"
            event = "update"
        }

        var payload = {
            _token: "{{ csrf_token() }}",
            id: user_id,
            first_name: $('#first_name').val(),
            middle_name: $('#middle_name').val(),
            last_name: $('#last_name').val(),
            username: $('#username').val(),
            email_address: $('#email_address').val(),
            password: $('#password').val(),
            contact_no: $('#contact_no').val(),
            role: $('#role').val(),
            status: $('#status').val()
        }


        axios.post(url, payload)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var first_name_error  = errors[i].indexOf('first') !== -1
                        var last_name_error   = errors[i].indexOf('last') !== -1
                        var username_error    = errors[i].indexOf('username') !== -1
                        var email_error       = errors[i].indexOf('email') !== -1
                        var password_error    = errors[i].indexOf('password') !== -1
                        var contact_error     = errors[i].indexOf('contact') !== -1
                        var role_error        = errors[i].indexOf('role') !== -1
                        var status_error      = errors[i].indexOf('status') !== -1

                        if (first_name_error) {
                            $('#first_name').addClass('is-invalid')
                            $('.first-name-error').show().text(errors[i])
                            break
                        } else {
                            $('#first_name').removeClass('is-invalid')
                            $('.first-name-error').hide()
                        }

                        if (last_name_error) {
                            $('#last_name').addClass('is-invalid')
                            $('.last-name-error').show().text(errors[i])
                            break
                        } else {
                            $('#last_name').removeClass('is-invalid')
                            $('.last-name-error').hide()
                        }

                        if (username_error) {
                            $('#username').addClass('is-invalid')
                            $('.username-error').show().text(errors[i])
                            break
                        } else {
                            $('#username').removeClass('is-invalid')
                            $('.username-error').hide()
                        }

                        if (email_error) {
                            $('#email_address').addClass('is-invalid')
                            $('.email-address-error').show().text(errors[i])
                            break
                        } else {
                            $('#email_address').removeClass('is-invalid')
                            $('.email-address-error').hide()
                        }

                        if (password_error) {
                            $('#password').addClass('is-invalid')
                            $('.password-error').show().text(errors[i])
                            break
                        } else {
                            $('#password').removeClass('is-invalid')
                            $('.password-error').hide()
                        }

                        if (contact_error) {
                            $('#contact_no').addClass('is-invalid')
                            $('.contact-no-error').show().text(errors[i])
                            break
                        } else {
                            $('#contact_no').removeClass('is-invalid')
                            $('.contact-no-error').hide()
                        }

                        if (role_error) {
                            $('#role').addClass('is-invalid')
                            $('.role-error').show().text(errors[i])
                            break
                        } else {
                            $('#role').removeClass('is-invalid')
                            $('.role-error').hide()
                        }

                        if (status_error) {
                            $('#status').addClass('is-invalid')
                            $('.status-error').show().text(errors[i])
                            break
                        } else {
                            $('#status').removeClass('is-invalid')
                            $('.status-error').hide()
                        }
                    }
                } else {
                    $('#add-edit-modal').modal('hide')

                    if (event == "save") {
                        $('#create_success_modal').modal('show')
                    } else {
                        $('#update_success_modal').modal('show')
                    }

                    setTimeout(function() {
                        window.location.href = "{{url('/admin/settings/users')}}" 
                    }, 3000)
                }
            })
    })

    $(document).on('click', '.btn_delete', function() {
        user_id = $(this).attr('data-id')
        $('#delete-modal').modal('show')  
    })

    $(document).on('click', '#btn_remove', function() {
        var url = "{{ url('/admin/settings/users/deleteUser') }}"
        var payload = {
            id: user_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#delete-modal').modal('hide')
            $('#delete_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/admin/settings/users')}}" 
            }, 3000)
        })
    })


</script>

@endsection