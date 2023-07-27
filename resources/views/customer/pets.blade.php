@extends('layouts.customer-master')

@section('title', 'Pets')
@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Pets</h5>
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
                            <i class="las la-plus fs-6 fw-bolder"></i>Pet
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
                <table id="pet_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Pet Name</th>
                            <th>Pet Photo</th>
                            <th>Pet Type</th>
                            <th>Pet Breed</th>
                            <th>Other Breed</th>
                            <th>Pet Age</th>
                            <th>Pet Medical History</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pets) > 0)
                            @foreach ($pets as $pet)
                            <tr>
                                <td>{{ $pet->name }}</td>
                                <td>
                                    @if ($pet->photo != null)
                                        <img id="preview" class="img-responsive d-flex mx-auto w-100" src="{{asset('storage/images/pets')}}/{{$pet->photo}}" alt="" style="width: 50px !important; height:  50px;border-radius:50%;padding: 5px;">
                                    @else
                                        <img id="preview" class="img-responsive d-flex mx-auto w-100" src="{{url('assets/images/pet-logo.png')}}" alt="" style="width: 50px !important; height:  50px;border-radius:50%;padding: 5px;">
                                    @endif
                                </td>
                                <td>{{ $pet->type }}</td>
                                <td>{{ $pet->breed }}</td>
                                <td>{{ $pet->other_breed }}</td>
                                <td>{{ $pet->age }}</td>
                                <td>{{ $pet->medical_history }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($pet->created_at)) }}</td>
                                <td>
                                    <a id="btn_edit" class="btn_edit" data-id="{{$pet->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
                                    </a>
                                    <a id="btn_delete" class="btn_delete" data-id="{{$pet->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title pet-modal-title" id="staticBackdropLabel">Create Pet</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">

                        <div class="col-md-12 pet-photo-container">
                            <label class="form-label text-center d-block">Preview Pet Photo</label>
                            <img id="pet-preview" class="img-responsive d-flex mx-auto w-100" src="{{url('assets/images/pet-logo.png')}}" alt="" style="max-width: 150px; height:  150px;border: 1px solid #333;border-radius:50%;padding: 5px;">
                        </div>

                        <div class="col-md-4 mb-2 pet-photo-container">
                            <div class="form-group">
                                <label for="pet-photo" class="form-label">Pet Photo</label>
                                <input class="form-control" type="file" placeholder="Choose pet photo" id="pet-photo" onchange="previewPetPhoto(event)"/>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="name" class="form-label">Pet Name</label>
                            <input id="name" type="text" class="form-control" placeholder="Enter pet name">
                            <div class="invalid-feedback name-error"></div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="age" class="form-label">Pet Age</label>
                            <input id="age" type="number" class="form-control" placeholder="Enter pet age">
                            <div class="invalid-feedback age-error"></div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="type" class="form-label">Pet Type</label>
                            <select class="form-control" id="type">
                                {{-- <option disabled selected value="">Select type</option> --}}
                                @foreach($types as $type)
                                    <option value="{{$type->type}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback type-error"></div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="breed" class="form-label">Pet Breed</label>
                            <select class="form-control" id="breed">
                                {{-- <option disabled selected>Select type first</option> --}}
                            </select>
                            <div class="invalid-feedback breed-error">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2 other_breed_container">
                            <label for="other_breed" class="form-label">Other Breed</label>
                            <input id="other_breed" type="text" class="form-control" placeholder="Enter other pet breed" readonly>
                            <div class="invalid-feedback other-breed-error"></div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="medical_history" class="form-label">Pet Medical History</label>
                            <input id="medical_history" type="text" class="form-control" placeholder="Enter pet medical history">
                            <div class="invalid-feedback medical-history-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success pet-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Delete Pet</h6>
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
                    <h5 class="modal-title">Pet Created</h5>
                </div>
                <div class="modal-body">
                    <p>Pet created successfully!</p>
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
                    <h5 class="modal-title">Pet Updated</h5>
                </div>
                <div class="modal-body">
                    <p>Pet updated successfully!</p>
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
                    <h5 class="modal-title">Pet Deleted</h5>
                </div>
                <div class="modal-body">
                    <p>Pet deleted successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var pet_id = 0

    $(document).ready(function() {
        // $('.other_breed_container').hide()

        showPetBreed()

    });

    function showPetBreed() {
        var url = "{{ url('/customer/pets-breed') }}"

        var payload = {
            type: $('#type').val(),
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            // html += '<option disabled selected>Select breed</option>'

            $.each(response.data.breeds, function(x,y) {
                html += `<option value="${y.breed}">${y.breed}</option>`
            })

            $('#breed').html(html)
            
            if ($('#breed').val() == "Other") {
                $('#other_breed').prop('disabled', false)
            }
        })
    }

    function getPetById(id) {
        var url = "{{ url('/customer/pets') }}/"+pet_id

        var payload = {
            id: pet_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.pet, function(x,y) {
                $('#name').val(y.name)
                $('#age').val(y.age)
                $('#type').val(y.type)


                if (y.breed == "Other") {
                    $('#other_breed').val(y.other_breed).prop('readonly', false)
                } else {
                    $('#other_breed').val("").prop('readonly', true)
                }

                var url = "{{ url('/customer/pets-breed') }}"

                var payload = {
                    type: y.type,
                }

                axios.post(url, payload)
                .then(function(response) {
                    var html = ""

                    // html += '<option disabled selected>Select breed</option>'

                    $.each(response.data.breeds, function(a,b) {
                        if (y.type == b.type && y.breed == b.breed) {
                            html += `<option value="${b.breed}" selected>${b.breed}</option>`
                        } else {
                            html += `<option value="${b.breed}">${b.breed}</option>`
                        }
                    })

                    $('#breed').html(html)
                })

                // $(`#breed[option="${y.breed}"]`).prop('selected', 'selected')
                $('#medical_history').val(y.medical_history)
                $('#pet-preview').attr("src", "{{asset('storage/images/pets')}}/"+y.photo)
            })
        })
    }

    var previewPetPhoto = function(e) {
        var output = document.getElementById('pet-preview');
        output.src = URL.createObjectURL(e.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };

    $('.pet-photo-container').show()

    $('#other_breed').on('keypress', function(event) {
        var inputValue = event.key;

        if(!/^[a-zA-Z'\-]+$/.test(inputValue)) {
            event.preventDefault();
        }
    });

    $(document).on('change', '#type', function() {
        var url = "{{ url('/customer/pets-breed') }}"

        var payload = {
            type: $(this).val(),
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            // html += '<option disabled selected>Select breed</option>'

            $.each(response.data.breeds, function(x,y) {
                html += `<option value="${y.breed}">${y.breed}</option>`
            })

            $('#breed').html(html)
        })
    })

    $(document).on('click', '#btn_add', function() {
        $('.pet-modal-title').text('Create Pet')
        $('.pet-modal-btn').text('Save')
        $('#add-edit-modal input').val("")
        $('#add-edit-modal').modal('show')
    })

    let pet = {}

    $(document).on('click', '.btn_edit', function() {
        pet_id = $(this).attr('data-id')
        $('.pet-modal-title').text('Update Pet')
        $('.pet-modal-btn').text('Update')

        getPetById(pet_id)

        $('#add-edit-modal').modal('show')
    })

    $(document).on('change', '#breed', function() {
        if ($(this).val() == "Other") {
            $('#other_breed').prop('readonly', false)
        } else {
            $('#other_breed').prop('readonly', true).val("")
        }
    })

    $(document).on('click', '.pet-modal-btn', function() {

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/customer/pets/store')}}"
            event = "save"
        } else {
            var url = "{{url('/customer/pets/update')}}"
            event = "update"
        }

        // payload
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', pet_id);
        formData.append('name', $('#name').val());
        formData.append('age', $('#age').val());
        formData.append('type', $('#type').val());
        formData.append('breed', $('#breed').val());
        formData.append('other_breed', $('#other_breed').val());
        formData.append('medical_history', $('#medical_history').val());
        formData.append('photo', document.querySelector("#pet-photo").files[0]);

        var headers = {'Content-Type': 'multipart/form-data' } // to allow file uploads

        axios.post(url, formData, headers)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error

                    for (var i = 0; i < errors.length; i++) {
                        var name_error            = errors[i].indexOf('name') !== -1
                        var age_error             = errors[i].indexOf('age') !== -1
                        // var type_error            = errors[i].indexOf('type') !== -1
                        // var breed_error           = errors[i].indexOf('breed') !== -1
                        var other_breed_error     = errors[i].indexOf('other_breed') !== -1
                        var medical_history_error = errors[i].indexOf('medical') !== -1

                        if (name_error) {
                            $('#name').addClass('is-invalid')
                            $('.name-error').show().text(errors[i])
                            break
                        } else {
                            $('#name').removeClass('is-invalid')
                            $('.name-error').hide()
                        }

                        if (age_error) {
                            $('#age').addClass('is-invalid')
                            $('.age-error').show().text(errors[i])
                            break
                        } else {
                            $('#age').removeClass('is-invalid')
                            $('.age-error').hide()
                        }

                        // if (type_error) {
                        //     $('#type').addClass('is-invalid')
                        //     $('.type-error').show().text(errors[i])
                        //     break
                        // } else {
                        //     $('#type').removeClass('is-invalid')
                        //     $('.type-error').hide()
                        // }

                        // if (breed_error) {
                        //     $('#breed').addClass('is-invalid')
                        //     $('.breed-error').show().text(errors[i])
                        //     break
                        // } else {
                        //     $('#breed').removeClass('is-invalid')
                        //     $('.breed-error').hide()
                        // }

                        if ($('#breed').val() == "Other") {
                        
                            if (other_breed_error) {
                                $('#other_breed').addClass('is-invalid')
                                $('.other-breed-error').show().text(errors[i])
                                break
                            } else {
                                $('#other_breed').removeClass('is-invalid')
                                $('.other-breed-error').hide()
                            }
                        }

             

                        if (medical_history_error) {
                            $('#medical_history').addClass('is-invalid')
                            $('.medical-history-error').show().text(errors[i])
                            break
                        } else {
                            $('#medical_history').removeClass('is-invalid')
                            $('.medical-history-error').hide()
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
                        window.location.href = "{{url('/customer/pets')}}" 
                    }, 3000)
                }
            })
    })

    $(document).on('click', '.btn_delete', function() {
        pet_id = $(this).attr('data-id')
        $('#delete-modal').modal('show')  
    })

    $(document).on('click', '#btn_remove', function() {
        var url = "{{ url('/customer/pets/delete') }}"
        var payload = {
            id: pet_id
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#delete-modal').modal('hide')
            $('#delete_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/customer/pets')}}" 
            }, 3000)
        })
    
    })

</script>

@endsection