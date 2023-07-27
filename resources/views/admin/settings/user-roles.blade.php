@extends('layouts.master')

@section('title', 'User Role Management')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">User Role Management</h5>
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
                            <i class="las la-plus fs-6 fw-bolder"></i>
                            <span>User Role</span>
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
                <table id="user_role_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Role Name</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($user_roles) > 0)
                            @foreach ($user_roles as $role)
                            <tr>
                                <td>{{ $role->role_name }}</td>
                                <td>{{ $role->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($role->created_at)) }}</td>
                                <td class="text-center">
                                    <a id="btn_edit" class="btn_edit" data-id="{{$role->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
                                    </a>
                                    <a id="btn_delete" class="btn_delete" data-id="{{$role->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        <i class="las la-trash text-danger"></i>
                                    </a>
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
                    <h6 class="modal-title user-role-modal-title" id="staticBackdropLabel">Create User Role</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">
                        <div class="col-md-6 mb-2">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input id="role_name" type="text" class="form-control" placeholder="Enter role name">
                            <div class="invalid-feedback role-name-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
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
                    <button class="btn btn-success user-role-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Delete User Role</h6>
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
                    <h5 class="modal-title">User Role Created</h5>
                </div>
                <div class="modal-body">
                    <p>User role created successfully!</p>
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
                    <h5 class="modal-title">User Role Updated</h5>
                </div>
                <div class="modal-body">
                    <p>User role updated successfully!</p>
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
                    <h5 class="modal-title">User Role Deleted</h5>
                </div>
                <div class="modal-body">
                    <p>User role deleted successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    var user_role_id = 0

    function getUserRoleById(id) {
        var url = "{{ url('/admin/settings/user-roles') }}/"+user_role_id
        var payload = {
            id: user_role_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.user_role, function(x,y) {
                $('#role_name').val(y.role_name)
                $('#status option[value="'+y.status+'"]').attr('selected','selected')
            })
        })
    }

    $(document).on('click', '#btn_add', function() {
        $('.user-role-modal-title').text('Create User Role')
        $('.user-role-modal-btn').text('Save')
        $('#add-edit-modal input').val("")
        $('#status > option:first').prop('selected', true)
        $('#add-edit-modal').modal('show')
    })

    let user_role = {}

    $(document).on('click', '.btn_edit', function() {
        user_role_id = $(this).attr('data-id')
        $('.user-role-modal-title').text('Update User Role')
        $('.user-role-modal-btn').text('Update')
        getUserRoleById(user_role_id)

        $('#add-edit-modal').modal('show')
        $('#password').parent().hide()
    })

    $(document).on('click', '.user-role-modal-btn', function() {

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/admin/settings/user-roles/store')}}"
            event = "save"
        } else {
            var url = "{{url('/admin/settings/user-roles/update')}}"
            event = "update"
        }

        var payload = {
            _token: "{{ csrf_token() }}",
            id: user_role_id,
            role_name: $('#role_name').val(),
            status: $('#status').val()
        }

        axios.post(url, payload)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var role_name_error  = errors[i].indexOf('role') !== -1
                        var status_error      = errors[i].indexOf('status') !== -1

                        if (role_name_error) {
                            $('#role_name').addClass('is-invalid')
                            $('.role-name-error').show().text(errors[i])
                            break
                        } else {
                            $('#role_name').removeClass('is-invalid')
                            $('.role-name-error').hide()
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
                        window.location.href = "{{url('/admin/settings/user-roles')}}" 
                    }, 3000)
                }
            })
    })

    $(document).on('click', '.btn_delete', function() {
        user_role_id = $(this).attr('data-id')
        $('#delete-modal').modal('show')  
    })

    $(document).on('click', '#btn_remove', function() {
        var url = "{{ url('/admin/settings/user-roles/deleteUserRole') }}"
        var payload = {
            id: user_role_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#delete-modal').modal('hide')
            $('#delete_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/admin/settings/user-roles')}}"
            }, 3000)
        })
    })


</script>

@endsection