@extends('layouts.master')

@section('title', 'Appointments')

@section('content')

<style>
   /* table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 30px;
    }*/
</style>

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Appointments</h5>
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
                </div>
            </div>
        </div>
    </div>
    
    <!-- Appointment Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="appointment_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Payment</th>
                            <th>Scheduled</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($appointments) > 0)
                            @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->code }}</td>
                                <td>{{ $appointment->customer_name }}</td>
                                <td>{{ $appointment->contact_no }}</td>
                                <td>{{ $appointment->email_address }}</td>
                                <td>{{ $appointment->payment_option }} - {{ $appointment->payment_amount}}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($appointment->scheduled_at)) }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($appointment->created_at)) }}</td>
                                <td>
                                    @if ($appointment->status == 0)
                                        <span>Pending</span>
                                    @elseif ($appointment->status == 1)
                                        <span>Confirmed</span>
                                    @elseif ($appointment->status == 2)
                                        <span>Canceled</span>
                                    @elseif ($appointment->status == 3)
                                        <span>Completed</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a id="btn_edit" class="btn_edit" data-status="{{$appointment->status}}" data-id="{{$appointment->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                        <i class="las la-eye text-primary"></i>
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
    <!-- /Appointments Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title appointment-modal-title" id="staticBackdropLabel">Create Appointment</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">

                        <div class="col-md-2">
                            <span class="badge bg-secondary ap-code"></span>
                        </div>
                        <br><br>
                        <hr>
                        <h6 class="mb-0">Customer Details:</h6>
                        <div class="col-md-4 mb-2">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input id="customer_name" type="text" class="form-control" readonly>
                            <div class="invalid-feedback customer-name-error"></div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="customer_contact_no" class="form-label">Customer Contact Number</label>
                            <input id="customer_contact_no" type="text" class="form-control" readonly>
                            <div class="invalid-feedback customer-contact-no-error"></div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="customer_email_address" class="form-label">Customer Email Address</label>
                            <input id="customer_email_address" type="text" class="form-control" readonly>
                            <div class="invalid-feedback customer-email-address-error"></div>
                        </div>
                        <br><br>
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Other Details (Maximum 3 Pets):</h6>
                            <button class="btn btn-primary btn-sm btn-add-appointment">Add Appointment Details</button>    
                        </div>

                        <span class="error-message"></span>
                        <div class="pet-service-container mb-5"></div>  

                        <hr>

                        <div class="col-md-2 mb-2">
                            <label for="amount" class="form-label">Payment Amount</label>
                            <input id="amount" type="text" class="form-control" value="">
                            <div class="invalid-feedback amount-error"></div>
                        </div>

                        <div class="col-md-2 mb-2">
                            <label for="payment_option" class="form-label">Payment Option</label>
                            <div class="form-group">
                                <select class="form-control" id="payment_option">
                                    <option disabled value="">Select option</option>
                                    <option value="Cash" selected>Cash</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                            <div class="invalid-feedback payment-option-error"></div>
                        </div>

                        <div class="col-md-3 mb-2 reference-no-container">
                            <label for="reference_no" class="form-label">GCash Reference Number</label>
                            <input id="reference_no" type="text" class="form-control">
                            <div class="invalid-feedback reference-no-error"></div>
                        </div>

                        <div class="col-md-3 mb-2 screenshot-container">
                            <div class="form-group">
                                <label for="screenshot" class="form-label">Payment Screenshot</label>
                                <input class="form-control" type="file" accept="image/png" name="screenshot" placeholder="Choose screenshot" id="screenshot" onchange="previewScreenshot(event)"/>
                                <div class="invalid-feedback screenshot-error"></div>
                            </div>
                        </div>

                        <div class="col-md-2 screenshot-container">
                            <label class="form-label text-center">Preview Screenshot</label>
                            <a href="javascript:void(0)" id="zoom_screenshot">
                                <img id="preview-screenshot" class="img-responsive d-flex mx-auto w-100" src="#" alt="" style="border: 1px solid #333;border-radius:5%;padding: 5px;">
                            </a>
                        </div>

                        <div class="calendar-container my-2">
                            <div class="col-md-12">
                                <label class="form-label">Select schedule</label>
                                <p>Selected schedule: <span class="selected-schedule"></span></p>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button class="btn btn-success appointment-modal-btn">Book</button> --}}
                    <div class="form-group">
                        <select class="form-control appointment-modal-btn">
                            <option disabled selected>Select status</option>
                            <option value="1">Confirm</option>
                            <option value="2">Cancel</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create_success_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment Created</h5>
                </div>
                <div class="modal-body">
                    <p>Appointment created successfully!</p>
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
                    <h5 class="modal-title">Appointment Updated</h5>
                </div>
                <div class="modal-body">
                    <p>Appointment updated successfully</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="screenshot_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">GCash Screenshot</h5>
                </div>
                <div class="modal-body">
                    <img class="img-fluid screenshot-img" src="#" alt="">
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    var appointment_id = 0;
    var price = 0;

    $(document).ready(function() {
        getCustomerDetails()
    });

    function getAppointmentById(id) {
        var url = "{{ url('/admin/appointments') }}/"+appointment_id

        var payload = {
            id: appointment_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.appointment, function(x,y) {
                $('.ap-code').text(`Appointment Code: ${y.code}`).css('font-size', '15px')
                $('#customer_name').val(y.customer_name)
                $('#customer_contact_no').val(y.contact_no)
                $('#customer_email_address').val(y.email_address)

                var html  = ""
                var other_details = JSON.parse(y.appointment_details)

                $.each(other_details, function(a,b) {
                    html += `
                    <div class="row pet-count">
                        <div class="col-md-6 mb-2">
                            <label for="pet_name" class="form-label">Pet Name</label>
                            <div class="form-group" id="pet_name">
                                <select class="form-control pet" disabled>
                                    <option disabled selected>${b.pet_name} (${b.pet_type} - ${b.pet_breed}) (${b.pet_age} Yr/s. old) (${b.pet_medical_history})</option>
                                </select>
                            </div>
                            <div class="invalid-feedback pet-error"></div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="service" class="form-label">Service</label>
                            <div class="form-group">
                                <select class="form-control service" disabled>
                                    <option disabled selected>${b.service_name} - ${b.service_description} - (${b.service_price} PHP)</option>
                                </select>
                            </div>
                            <div class="invalid-feedback service-error"></div>
                        </div>
                    </div>
                    `
                })


                $('.pet-service-container').html(html)

                $('#amount').val(y.payment_amount+".00").prop('disabled', true)
                $('#payment_option').prop('disabled', true)
                $(`#payment_option[option="${y.payment_option}"]`).prop('selected', true)

                if (y.payment_option == "Cash") {
                    $('.reference-no-container').hide();
                    $('.screenshot-container').hide()
                } else {
                    $('.reference-no-container').show();
                    $('.screenshot-container').show()

                    $('#reference_no').val(y.payment_reference_no).prop('disabled', true)
                    $('#screenshot').prop('disabled', true)
                    $('#preview-screenshot').attr('src', '{{asset('storage/images/screenshot')}}/'+y.payment_screenshot)
                    $('.screenshot-img').attr('src', '{{asset('storage/images/screenshot')}}/'+y.payment_screenshot)
                }

                $('.selected-schedule').html(`<span style="font-weight:bold;">${moment(y.scheduled_at).format('LLL')}</span>`)

            })
        })
    }

    function getCustomerDetails() {
        if ($('#payment_option').val() == "Cash") {
            $('.reference-no-container').hide()
            $('.screenshot-container').hide()
        } else {
            $('.reference-no-container').show()
            $('.screenshot-container').show()
        }
    }

    function getPets(owner_id) {
        var url = "{{ url('/admin/appointments/pets') }}/"+owner_id

        axios.get(url)
        .then(function(response) {
            var html = ""

            html += '<option disabled selected>Select pet</option>'
            $.each(response.data.pets, function(x,y) {
                html += `<option data-name="${y.name}" data-type="${y.type}" data-breed="${y.breed}" data-age="${y.age}" value="${y.name}">${y.name} (${y.type} - ${y.breed}) (${y.age} Yr/s. old)</option>`
            })

            $('.pet:last').html(html)
        })
    }

    function getServices() {
        var url = "{{ url('/admin/appointments/services') }}"

        axios.get(url)
        .then(function(response) {
            var service_html = ""

            service_html += '<option disabled selected>Select service</option>'
            $.each(response.data.services, function(x,y) {
                service_html += `<option data-name="${y.name}" data-description="${y.description}" data-price="${y.price}" value="1">${y.name} - ${y.description} - (${y.price} PHP)</option>`
            })

            $('.service:last').html(service_html)
        })
    }

    var previewScreenshot = function(e) {
        var output = document.getElementById('preview-screenshot');
        output.src = URL.createObjectURL(e.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };

    $('.screenshot-container').show()

    $(document).on('click', '#zoom_screenshot', function() {
        $('#screenshot_modal').modal('show')
    })

    $(document).on('click', '#btn_add', function() {
        getCustomerDetails()
        $('.appointment-modal-title').text('Create Appointment')
        $('.appointment-modal-btn').text('Book')
        $('#add-edit-modal input').val("")
        $('#add-edit-modal').modal('show')
        $('.pet-service-container').html('')
        $('.error-message').hide()
        $('.btn-add-appointment').show();
    });

    $(document).on('click', '.btn_edit', function() {
        appointment_id = $(this).attr('data-id')
        $('.appointment-modal-title').text('Update Appointment')
        $('.btn-add-appointment').hide();

        // Pending - 0, Confirmed - 1, Canceled = 2, Completed = 3
        var status = parseInt($(this).attr('data-status'))

        $('.appointment-modal-btn').show()
        if (status == 1) {
            $('.appointment-modal-btn > option[value="1"]').prop('disabled', true)
            $('.appointment-modal-btn > option[value="2"]').prop('disabled', false)
            $('.appointment-modal-btn > option[value="3"]').prop('disabled', false)
        } else if (status == 2) {
            $('.appointment-modal-btn > option[value="1"]').prop('disabled', true)
            $('.appointment-modal-btn > option[value="2"]').prop('disabled', true)
            $('.appointment-modal-btn > option[value="3"]').prop('disabled', false)
        } else if (status == 3) {
            $('.appointment-modal-btn').hide()
        }

        getAppointmentById(appointment_id)

        $('#add-edit-modal').modal('show')
    })


    $(document).on('change', '.appointment-modal-btn', function() {
        var event = "";
        var url = "{{url('/admin/appointments/update')}}"
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', appointment_id);
        formData.append('status', $(this).val())

        var headers = {'Content-Type': 'multipart/form-data' }

        axios.post(url, formData, headers)
        .then(function(response) {
            $('#add-edit-modal').modal('hide')
            $('#update_success_modal').modal('show')

            setTimeout(function() {
                window.location.href = "{{url('/admin/appointments')}}" 
            }, 3000)
            
        })
    })
</script>

@endsection