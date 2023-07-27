@extends('layouts.master')

@section('title', 'Services')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Services</h5>
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
                            <i class="las la-plus fs-6 fw-bolder"></i>Service
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Services Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="service_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Price (PHP)</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($services) > 0)
                            @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($service->created_at)) }}</td>
                                <td class="text-center">
                                    <a id="btn_edit" class="btn_edit" data-id="{{$service->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
                                    </a>
                                    <a id="btn_delete" class="btn_delete" data-id="{{$service->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
    <!-- /Services Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title service-modal-title" id="staticBackdropLabel">Create Service</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Service Name</label>
                            <input id="name" type="text" class="form-control" placeholder="Enter service name">
                            <div class="invalid-feedback name-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="price" class="form-label">Price</label>
                            <input id="price" class="form-control" placeholder="Enter price">
                            <div class="invalid-feedback price-error"></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control" placeholder="Enter description"></textarea>
                             <div class="invalid-feedback description-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success service-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Delete Service</h6>
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
                    <h5 class="modal-title">Service Created</h5>
                </div>
                <div class="modal-body">
                    <p>Service created successfully!</p>
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
                    <h5 class="modal-title">Service Updated</h5>
                </div>
                <div class="modal-body">
                    <p>Service updated successfully!</p>
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
                    <h5 class="modal-title">Service Deleted</h5>
                </div>
                <div class="modal-body">
                    <p>Service deleted successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('assets/js/jquery.masknumber.min.js') }}"></script>
<script>

    $(document).ready(function() {
        $('#price').maskNumber({decimal: '.', thousands: ','});
    });

    var service_id = 0

    function getServiceById(id) {
        var url = "{{ url('/admin/services') }}/"+service_id

        var payload = {
            id: service_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.service, function(x,y) {
                $('#name').val(y.name)
                $('#description').val(y.description)
                $('#price').val(y.price)
            })
        })
    }

    $(document).on('click', '#btn_add', function() {
        $('.service-modal-title').text('Create Service')
        $('.service-modal-btn').text('Save')
        $('#add-edit-modal input').val("")
        $('#add-edit-modal').modal('show')
    })

    let service = {}

    $(document).on('click', '.btn_edit', function() {
        service_id = $(this).attr('data-id')
        $('.service-modal-title').text('Update Service')
        $('.service-modal-btn').text('Update')

        getServiceById(service_id)

        $('#add-edit-modal').modal('show')
    })

    $(document).on('click', '.service-modal-btn', function() {

        return false;

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/admin/services/store')}}"
            event = "save"
        } else {
            var url = "{{url('/admin/services/update')}}"
            event = "update"
        }

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', service_id);
        formData.append('name', $('#name').val());
        formData.append('description', $('#description').val());
        formData.append('price', $('#price').val());

        var headers = {'Content-Type': 'multipart/form-data' } // to allow file uploads
        
        axios.post(url, formData, headers)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var name_error    = errors[i].indexOf('name') !== -1
                        var description_error     = errors[i].indexOf('description') !== -1
                        var price_error      = errors[i].indexOf('price') !== -1

                        if (name_error) {
                            $('#name').addClass('is-invalid')
                            $('.name-error').show().text(errors[i])
                            break
                        } else {
                            $('#name').removeClass('is-invalid')
                            $('.name-error').hide()
                        }

                        if (description_error) {
                            $('#description').addClass('is-invalid')
                            $('.description-error').show().text(errors[i])
                            break
                        } else {
                            $('#description').removeClass('is-invalid')
                            $('.description-error').hide()
                        }

                        if (price_error) {
                            $('#price').addClass('is-invalid')
                            $('.price-error').show().text(errors[i])
                            break
                        } else {
                            $('#price').removeClass('is-invalid')
                            $('.price-error').hide()
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
                        window.location.href = "{{url('/admin/services')}}" 
                    }, 3000)
                }
            })
    })

    $(document).on('click', '.btn_delete', function() {
        service_id = $(this).attr('data-id')
        $('#delete-modal').modal('show')  
    })

    $(document).on('click', '#btn_remove', function() {
        var url = "{{ url('/admin/services/delete') }}"
        var payload = {
            id: service_id
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#delete-modal').modal('hide')
            $('#delete_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/admin/services')}}" 
            }, 3000)
        })
    
    })

</script>

@endsection