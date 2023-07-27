@extends('layouts.master')

@section('title', 'Pet Types')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Pet Types</h5>
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
                            <i class="las la-plus fs-6 fw-bolder"></i>Pet Type
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pet Types Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="pet_type_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Pet Type</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pet_types) > 0)
                            @foreach ($pet_types as $pet_type)
                            <tr>
                                <td>{{ $pet_type->type }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($pet_type->created_at)) }}</td>
                                <td>
                                    <a id="btn_edit" class="btn_edit" data-id="{{$pet_type->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
                                    </a>
                                    <a id="btn_delete" class="btn_delete" data-id="{{$pet_type->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
    <!-- /Pet Types Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title pet-type-modal-title" id="staticBackdropLabel">Create Pet Type</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">
                        <div class="col-md-12 mb-2">
                            <label for="type" class="form-label">Pet Type</label>
                            <input id="type" type="text" class="form-control" placeholder="Enter pet type">
                            <div class="invalid-feedback type-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success pet-type-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Delete Pet Type</h6>
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
                    <h5 class="modal-title">Pet Type Created</h5>
                </div>
                <div class="modal-body">
                    <p>Pet Type created successfully!</p>
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
                    <h5 class="modal-title">Pet Type Updated</h5>
                </div>
                <div class="modal-body">
                    <p>Pet Type updated successfully!</p>
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
                    <h5 class="modal-title">Pet Type Deleted</h5>
                </div>
                <div class="modal-body">
                    <p>Pet Type deleted successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var pet_type_id = 0

    function getPetTypeById(id) {
        var url = "{{ url('/admin/pet-types') }}/"+pet_type_id

        var payload = {
            id: pet_type_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.pet_type, function(x,y) {
                $('#type').val(y.type)
            })
        })
    }

    $(document).on('click', '#btn_add', function() {
        $('.pet-type-modal-title').text('Create Pet Type')
        $('.pet-type-modal-btn').text('Save')
        $('#add-edit-modal input').val("")
        $('#add-edit-modal').modal('show')
    })

    let pet_type = {}

    $(document).on('click', '.btn_edit', function() {
        pet_type_id = $(this).attr('data-id')
        $('.pet-type-modal-title').text('Update Pet Type')
        $('.pet-type-modal-btn').text('Update')

        getPetTypeById(pet_type_id)

        $('#add-edit-modal').modal('show')
    })

    $(document).on('click', '.pet-type-modal-btn', function() {

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/admin/pet-types/store')}}"
            event = "save"
        } else {
            var url = "{{url('/admin/pet-types/update')}}"
            event = "update"
        }

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', pet_type_id);
        formData.append('type', $('#type').val());

        var headers = {'Content-Type': 'multipart/form-data' } // to allow file uploads

        axios.post(url, formData, headers)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var type_error    = errors[i].indexOf('type') !== -1

                        if (type_error) {
                            $('#type').addClass('is-invalid')
                            $('.type-error').show().text(errors[i])
                            break
                        } else {
                            $('#type').removeClass('is-invalid')
                            $('.type-error').hide()
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
                        window.location.href = "{{url('/admin/pet-types')}}" 
                    }, 3000)
                }
            })
    })

    $(document).on('click', '.btn_delete', function() {
        pet_type_id = $(this).attr('data-id')
        $('#delete-modal').modal('show')  
    })

    $(document).on('click', '#btn_remove', function() {
        var url = "{{ url('/admin/pet-types/delete') }}"
        var payload = {
            id: pet_type_id
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#delete-modal').modal('hide')
            $('#delete_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/admin/pet-types')}}" 
            }, 3000)
        })
    
    })

</script>

@endsection