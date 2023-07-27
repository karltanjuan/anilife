@extends('layouts.master')

@section('title', 'Pet Breeds')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Pet Breeds</h5>
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
                            <i class="las la-plus fs-6 fw-bolder"></i>Pet Breed
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pet Breeds Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="pet_breed_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Pet Type</th>
                            <th>Pet Breed</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pet_breeds) > 0)
                            @foreach ($pet_breeds as $pet_breed)
                            <tr>
                                <td>{{ $pet_breed->type }}</td>
                                <td>{{ $pet_breed->breed }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($pet_breed->created_at)) }}</td>
                                <td>
                                    <a id="btn_edit" class="btn_edit" data-id="{{$pet_breed->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
                                    </a>
                                    <a id="btn_delete" class="btn_delete" data-id="{{$pet_breed->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
    <!-- Pet Types Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title pet-breed-modal-title" id="staticBackdropLabel">Create Pet Breed</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">
                        <div class="col-md-6 mb-2">
                            <label for="type" class="form-label">Pet Type</label>
                            <select id="type" class="form-control"></select>
                            <div class="invalid-feedback type-error"></div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="breed" class="form-label">Pet Breed</label>
                            <input id="breed" type="text" class="form-control" placeholder="Enter pet breed">
                            <div class="invalid-feedback breed-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success pet-breed-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Delete Pet Breed</h6>
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
                    <h5 class="modal-title">Pet Breed Created</h5>
                </div>
                <div class="modal-body">
                    <p>Pet Breed created successfully!</p>
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
                    <h5 class="modal-title">Pet Breed Updated</h5>
                </div>
                <div class="modal-body">
                    <p>Pet Breed updated successfully!</p>
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
                    <h5 class="modal-title">Pet Breed Deleted</h5>
                </div>
                <div class="modal-body">
                    <p>Pet Breed deleted successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var pet_breed_id = 0

    $(document).ready(function() {
        getPetTypes()
    })

    function getPetTypes()
    {
        var url = "{{ url('/admin/pet-breeds/types') }}"

        var payload = {
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            html += '<option selected disabled>Please select...</option>'
            $.each(response.data.pet_types, function(x,y) {
                html += `<option value="${y.type}" data-id="${y.id}">${y.type}</option>`
            })

            $('#type').html(html)
        })
    }

    function getPetBreedById(id) {
        var url = "{{ url('/admin/pet-breeds') }}/"+pet_breed_id

        var payload = {
            id: pet_breed_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.pet_breed, function(x,y) {
                $('#type').val(y.type)
                $('#breed').val(y.breed)
            })
        })
    }

    $(document).on('click', '#btn_add', function() {
        $('.pet-breed-modal-title').text('Create Pet Breed')
        $('.pet-breed-modal-btn').text('Save')
        $('#add-edit-modal input').val("")
        $('#add-edit-modal').modal('show')
    })

    let pet_breed = {}

    $(document).on('click', '.btn_edit', function() {
        pet_breed_id = $(this).attr('data-id')
        $('.pet-breed-modal-title').text('Update Pet Breed')
        $('.pet-breed-modal-btn').text('Update')

        getPetBreedById(pet_breed_id)

        $('#add-edit-modal').modal('show')
    })

    $(document).on('click', '.pet-breed-modal-btn', function() {

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/admin/pet-breeds/store')}}"
            event = "save"
        } else {
            var url = "{{url('/admin/pet-breeds/update')}}"
            event = "update"
        }

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', pet_breed_id);
        formData.append('type', $('#type').val());
        formData.append('breed', $('#breed').val());

        var headers = {'Content-Type': 'multipart/form-data' } // to allow file uploads

        axios.post(url, formData, headers)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var type_error    = errors[i].indexOf('type') !== -1
                        var breed_error    = errors[i].indexOf('breed') !== -1

                        if (type_error) {
                            $('#type').addClass('is-invalid')
                            $('.type-error').show().text(errors[i])
                            break
                        } else {
                            $('#type').removeClass('is-invalid')
                            $('.type-error').hide()
                        }

                        if (breed_error) {
                            $('#breed').addClass('is-invalid')
                            $('.breed-error').show().text(errors[i])
                            break
                        } else {
                            $('#breed').removeClass('is-invalid')
                            $('.breed-error').hide()
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
                        window.location.href = "{{url('/admin/pet-breeds')}}" 
                    }, 3000)
                }
            })
    })

    $(document).on('click', '.btn_delete', function() {
        pet_breed_id = $(this).attr('data-id')
        $('#delete-modal').modal('show')  
    })

    $(document).on('click', '#btn_remove', function() {
        var url = "{{ url('/admin/pet-breeds/delete') }}"
        var payload = {
            id: pet_breed_id
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#delete-modal').modal('hide')
            $('#delete_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/admin/pet-breeds')}}" 
            }, 3000)
        })
    
    })

</script>

@endsection