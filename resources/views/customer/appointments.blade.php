@extends('layouts.customer-master')

@section('title', 'Appointments')

@section('content')

<style>
    .fc-event-title-container{
        text-align:center;
    }
    .fc-event-title.fc-sticky{
        font-size:14px;
    }

    .modal-backdrop {
        z-index: 12;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<link rel="stylesheet" href="{{ url('/css/full-calendar5.min.css') }}"/>

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
                    <div class="col-lg-6">
                        <button class="btn btn-outline-primary rounded-pill border-2 tableBtn" id="btn_add">
                            <i class="las la-plus fs-6 fw-bolder"></i>Appointment
                        </button>
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
                            <th>Created</th>
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
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 999;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title appointment-modal-title" id="staticBackdropLabel">Create Appointment</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">

                        <small><b>Note:</b> Once appointment is booked, information submitted cannot be changed unless requested.</small>
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
                            <input id="amount" type="text" class="form-control" value="0" readonly>
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
                            <div class="form-group">
                                <label for="reference_no" class="form-label">GCash Reference Number</label>
                                <input id="reference_no" type="text" class="form-control">
                                <div class="invalid-feedback reference-no-error"></div>
                                <a href="javascript:void(0)" class="mt-2" style="color: #0d6ef !important;" id="btn_qrcode">View GCash QRCode</a>
                            </div>
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
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm btn-calendar">Open calendar</button>

                                    <input type="hidden" class="timeslot_input">
                                    <input type="hidden" class="date_input">
                                    <p>Selected schedule: <span class="selected-schedule"></span></p>

                                    {{-- <input type="date" class="form-control"> --}}
                                    <div id='appointment-calendar'></div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success reschedule-modal-btn">Reschedule</button>
                    <button class="btn btn-success continue-modal-btn">Continue</button>
                    <button class="btn btn-success appointment-modal-btn">Book</button>
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
                    <h5 class="modal-title">Appointment Cancelled</h5>
                </div>
                <div class="modal-body">
                    <p>Appointment cancelled successfully</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="zero_slot_modal" role="dialog" style="z-index: 99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">0 Slot Available</h5>
                </div>
                <div class="modal-body">
                    <p>Sorry, we are fully booked today. Please select another day.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="timeslot_modal" role="dialog" style="z-index: 99999;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select appointment time</h5>
                </div>
                <div class="modal-body">
                    <div class="timeslot-container"></div>
                </div>
                {{-- <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="gcash_qrcode_modal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">GCash QRCode</h5>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="{{asset('assets/images/anilife-gcash.jpg')}}" alt="">
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

    <div class="modal fade" id="reschedule_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to reschedule?</h5>
                </div>
                <div class="modal-body">
                    <p>Please be aware that this can only be done once.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_yes btn btn-success" data-bs-dismiss="modal">Yes</button>
                    <button class="btn_no btn btn-danger" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="timeslot_empty_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Timeslot Not Selected</h5>
                </div>
                <div class="modal-body">
                    <p>Please select new timeslot to continue.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reschedule_success_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment Rescheduled</h5>
                </div>
                <div class="modal-body">
                    <p>Appointment rescheduled successfully</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="{{url('/js/full-calendar5.min.js')}}"></script>

<script>

    var appointment_id = 0;
    var price = 0;

    var timeslots = [
        "9:00 am - 9:30 am",
        "9:30 am - 10:00 am", 
        "10:00 am - 10:30 am",
        "10:30 am - 11:00 am",
        "11:00 am - 11:30 am", 
        "11:30 am - 12:00 pm", 
        "1:00 pm - 1:30 pm",
        "1:30 pm - 2:00 pm", 
        "2:00 pm - 2:30 pm",
        "2:30 pm - 3:00 pm",
        "3:00 pm - 3:30 pm",
        "3:30 pm - 4:00 pm",
    ];

    $(document).ready(function() {
        $('.reschedule-modal-btn').hide()
        $('.continue-modal-btn').hide()
        getCustomerDetails()
    });

    var calendar;
    var appointment = $.parseJSON('<?= json_encode($appointment_arr) ?>') || {};
    var max_client = '{{$setting->max_client}}';
    initCalendar(appointment)

    function initCalendar(appointment) {
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()

        var Calendar = FullCalendar.Calendar;

        calendar = new Calendar(document.getElementById('appointment-calendar'), {
            headerToolbar: {
                left  : false,
                center: 'title',
                // left: 'prev,next today',
                // right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 500,
            allDaySlot: false,
            selectable: false,
            droppable: false,
            editable: false,
            disableDragging: false,
            themeSystem: 'bootstrap',
            weekends: false,
            //Random default events
            events: [
                {
                    daysOfWeek: [1,2,3,4,5], // these recurrent events move separately
                    title:`${max_client} Slots Available`,
                    allDay: true,
                }
            ],
            eventClick: function(info) {
                    if(parseInt($(info.el).find('.fc-sticky').text()) > 0) {
                        $('#timeslot_modal').modal('show')
                            timeslot_html = "";

                            timeslot_html += `<div class="row">`
                            timeslots.forEach(function (timeslot, index) {
                                
                                    timeslot_html += `<div class="col-md-3 my-2">`
                                    timeslot_html +=    `<button class="btn btn-sm btn-outline-primary btn-timeslot" style="width:170px">${timeslot}</button>`
                                    timeslot_html += `</div>`
                            });
                            timeslot_html += `</div>`

                            $('.timeslot-container').html(timeslot_html)

                    } else {
                        $('#zero_slot_modal').modal('show');
                    }

                },
            validRange:{
                start: moment(date).format("YYYY-MM-DD"),
            },
            eventDidMount:function(info){
                // console.log(appointment)
                if(!!appointment[info.event.startStr]){
                    var available = parseInt(info.event.title) - parseInt(appointment[info.event.startStr]);

                    $(info.el).find('.fc-event-title.fc-sticky').text('')
                    $(info.el).find('.fc-event-title.fc-sticky').text(available + " Slots Available")
                }
            },
            editable  : true
        });

        // calendar.render();
    }

    var date_input = "";

    $(document).on('click', '.fc-daygrid-day-events', function() {
        var day = $(this).prev().find('.fc-daygrid-day-number').text()
        var month = $('.fc-toolbar-title').text().split(" ")[0]
        var year = $('.fc-toolbar-title').text().split(" ")[1]
        var date_slot = `${month} ${day}, ${year}`

        $('.date_input').val(moment($(this).parents('td').attr('data-date')).format('Y-MM-D'))

        date_input = $('.date_input').val()

        var url = "{{ url('/customer/appointments/verify-timeslot') }}";

        axios.post(url, {date_slot: date_input})
        .then(function(response) {
            var booked_timeslots = response.data; // assuming the response contains an array of booked time slots
            var filtered_timeslots = [];

            for (var i = 0; i < timeslots.length; i++) {
                var timeslot = timeslots[i];
                var start_time = timeslot.split(' - ')[0];
                var end_time = timeslot.split(' - ')[1];
                var match_found = false;

                for (var j = 0; j < booked_timeslots.length; j++) {
                    var booked_time = booked_timeslots[j];
                    var date_obj = new Date('2000-01-01 ' + booked_time);
                    var time_in_minutes = date_obj.getHours() * 60 + date_obj.getMinutes();

                    date_obj = new Date('2000-01-01 ' + start_time);
                    var start_time_in_minutes = date_obj.getHours() * 60 + date_obj.getMinutes();

                    date_obj = new Date('2000-01-01 ' + end_time);
                    var end_time_in_minutes = date_obj.getHours() * 60 + date_obj.getMinutes();

                    if (time_in_minutes >= start_time_in_minutes && time_in_minutes < end_time_in_minutes) {
                        match_found = true;
                        break;
                    }
                }

                if (!match_found) {
                    filtered_timeslots.push(timeslot);
                }
            }

            timeslot_html = "";

            timeslot_html += `<div class="row">`
            filtered_timeslots.forEach(function (timeslot, index) {
                
                    timeslot_html += `<div class="col-md-3 my-2">`
                    timeslot_html +=    `<button class="btn btn-sm btn-outline-primary btn-timeslot" style="width:170px">${timeslot}</button>`
                    timeslot_html += `</div>`
            });
            timeslot_html += `</div>`

            $('.timeslot-container').html(timeslot_html)
            
        })
       
    })

    $(document).on('click', '.btn-timeslot', function() {
        $(this).removeClass('btn-primary').addClass('btn-success').css('color', '#fff')
        $('.timeslot_input').val($(this).text())

        $('.btn-timeslot').not(this).prop('disabled', true)
        $('#timeslot_modal').modal('hide')

        $('.selected-schedule').html('<span style="font-weight:bold;">'+moment($('.date_input').val()).format('LL') + " " + $('.timeslot_input').val()+'</span>')

        var converted_time = $(this).text().split(' -')[0]
        converted_time = moment(converted_time, 'hh:mm A').format('HH:mm')
        $('.timeslot_input').val(converted_time)

    })

    $(document).on('click', '.btn-calendar', function() {
        $(this).prop('disabled', true)

        if ($('.continue-modal-btn').is(':visible')) {
            $(this).prop('disabled', false)
        }

        calendar.render();
    })

    $(document).on('click', '#btn_qrcode', function() {
        $('#gcash_qrcode_modal').modal('show')
    })

    $(document).on('click', '#zoom_screenshot', function() {
        $('#screenshot_modal').modal('show')
    })

    function getAppointmentById(id) {
        var url = "{{ url('/customer/appointments') }}/"+appointment_id

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
                setTimeout(function() {
                    $('#payment_option').find('option').removeAttr("selected");
                    $(`#payment_option > option[value="${y.payment_option}"]`).prop('selected', true)
                }, 100)
                $('#payment_option').prop('disabled', true)

                if (y.payment_option == "Cash") {
                    $('.reference-no-container').hide();
                    $('.screenshot-container').hide()
                } else {
                    $('.reference-no-container').show();
                    $('.screenshot-container').show()

                    $('#reference_no').val(y.payment_reference_no).prop('disabled', true)
                    $('#screenshot').prop('disabled', true)
                    $('#preview-screenshot').attr('src', '{{asset('storage/images/screenshot')}}/'+y.payment_screenshot)
                }

                $('.selected-schedule').html(`<span style="font-weight:bold;">${moment(y.scheduled_at).format('LLL')}</span>`)

            })
        })
    }

    function getCustomerDetails() {
        setTimeout(function() {
            $('#customer_name').val('{{$customer['first_name']}} {{$customer['middle_name']}} {{$customer['last_name']}}')
            $('#customer_contact_no').val('{{$customer['contact_no']}}')
            $('#customer_email_address').val('{{$customer['email_address']}}')
        }, 1000)

        if ($('#payment_option').val() == "Cash") {
            $('.reference-no-container').hide()
            $('.screenshot-container').hide()
        } else {
            $('.reference-no-container').show()
            $('.screenshot-container').show()
        }
    }

    function getPets() {
        var url = "{{ url('/customer/appointments/pets') }}"

        axios.get(url)
        .then(function(response) {
            var html = ""

            html += '<option disabled selected>Select pet</option>'
            $.each(response.data.pets, function(x,y) {
                html += `<option data-id="${y.id}" data-name="${y.name}" data-type="${y.type}" data-breed="${y.breed}" data-age="${y.age}" data-history="${y.medical_history}" value="${y.name}">${y.name} (${y.type} - ${y.breed}) (${y.age} Yr/s. old) (${y.medical_history})</option>`
            })

            $('.pet:last').html(html)
        })
    }

    function getServices() {
        var url = "{{ url('/customer/appointments/services') }}"

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

    $(document).on('change', '#payment_option', function() {
        if ($('#payment_option').val() == "Cash") {
            $('.reference-no-container').hide()
            $('.screenshot-container').hide()
        } else {
            $('.reference-no-container').show()
            $('.screenshot-container').show()
        }
    });

    var previewScreenshot = function(e) {
        var output = document.getElementById('preview-screenshot');
        output.src = URL.createObjectURL(e.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }

        var output2 = document.querySelector('.screenshot-img')
        output2.src = URL.createObjectURL(e.target.files[0]);
        output2.onload = function() {
            URL.revokeObjectURL(output2.src)
        }
    };

    $('.screenshot-container').show()

    $(document).on('click', '#btn_add', function() {
        getCustomerDetails()
        $('.reschedule-modal-btn').hide()
        $('.continue-modal-btn').hide()
        $('.appointment-modal-title').text('Create Appointment')
        $('.appointment-modal-btn').text('Book').show()
        $('#add-edit-modal input').val("")
        $('#add-edit-modal').modal('show')
        $('.pet-service-container').html('')
        $('.error-message').hide()
        $('.btn-add-appointment').show();
        $('.btn-calendar').prop('disabled', false)
        $('#amount').prop('disabled', false)
        $('#payment_option').prop('disabled', false)
        $('#reference_no').prop('disabled', false)
        $('#screenshot').prop('disabled', false)
        $('#preview-screenshot').attr('src', '')
        $('.selected-schedule').html('')
        $('#appointment-calendar').show()
    });

    $(document).on('click', '.btn-add-appointment', function() {
        var html = "";

        var pet_length = $('.pet-count').length + 1

        if (pet_length > 3) {
            $('.error-message').show().html('<span class="text-danger">Maximum of 3 pets only per hour are allowed to accommodate the booking process:</span>')
            return false;
        }

        html += `
            <div class="row pet-count">
                <div class="col-md-6 mb-2">
                    <label for="pet_name" class="form-label">Pet Name</label>
                    <div class="form-group" id="pet_name">
                        <select class="form-control pet">
                            <option disabled selected>Select pet</option>
                        </select>
                    </div>
                    <div class="invalid-feedback pet-error"></div>
                </div>

                <div class="col-md-5 mb-2">
                    <label for="service" class="form-label">Service</label>
                    <div class="form-group">
                        <select class="form-control service">
                            <option disabled selected>Select service</option>
                        </select>
                    </div>
                    <div class="invalid-feedback service-error"></div>
                </div>

                <div class="col-md-1">
                    <button class="btn btn-outline-danger btn-sm btn-remove" style="margin-top:40px;">
                        <i class="las la-times-circle"></i>
                    </button>
                </div>
            </div>
        `;

        $('.pet-service-container').append(html)
        setTimeout(function() {
            getPets()
            getServices()
        }, 1000)
    })

    $(document).on('change', '.service', function() {
        price = 0;
        $.each($('.service>option:selected'), function() {
            price += parseFloat($(this).attr('data-price'))
        })

        $('#amount').val(price).prop('readonly', true)
    });

    $(document).on('click', '.btn-remove', function() {
        $(this).parent().parent().remove()

        price = 0;
        
        $.each($('.service>option:selected'), function() {
            price += parseFloat($(this).attr('data-price'))
        })

        $('#amount').val(price)

        $('.error-message').hide();
    })

    $(document).on('click', '.btn_edit', function() {
        appointment_id = $(this).attr('data-id')
        $('.appointment-modal-title').text('Update Appointment')
        $('.btn-add-appointment').hide();
        $('.btn-calendar').prop('disabled', true)

        $('.reschedule-modal-btn').hide()
        $('.continue-modal-btn').hide()

        $('.error-message').hide()

        // Pending - 0, Confirmed - 1, Canceled = 2, Rejected = 3, Completed = 4
        var status = parseInt($(this).attr('data-status'))
        if (status == 0) {
            $('.appointment-modal-btn').text('Cancel Booking').show()
        } else {
            $('.appointment-modal-btn').hide()
        }

        if (status == 1) {
            $('.reschedule-modal-btn').show()
        }

        getAppointmentById(appointment_id)
        
        $('#appointment-calendar').hide()

        $('#add-edit-modal').modal('show')
    })

    $(document).on('click', '.reschedule-modal-btn', function() {
        $('#reschedule_modal').modal('show')
    })

    $(document).on('click', '.btn_yes', function() {
        $('#reschedule_modal').modal('hide')
        $('.reschedule-modal-btn').hide()
        $('.continue-modal-btn').show()
        $('.btn-calendar').prop('disabled', false)

        $('.selected-schedule').text('NA')
        $('#appointment-calendar').css('display', 'flex')
    })

    $(document).on('click', '.continue-modal-btn', function() {
        var url = "{{ url('/customer/appointments/reschedule') }}/"+appointment_id
        if ($('.timeslot_input').val().length == 0) {
            $('#timeslot_empty_modal').modal('show')
            return false;
        }

        $('#timeslot_empty_modal').modal('hide')

        var scheduled_at = $('.date_input').val() + ' ' + $('.timeslot_input').val().split(" ")[0]

        var payload = {
            id: appointment_id,
            scheduled_at: scheduled_at
        }

        axios.post(url, payload)
        .then(function(response) {
            $('#reschedule_success_modal').modal('show')
            setTimeout(function() {
                window.location.href = "{{url('/customer/appointments')}}" 
            }, 3000)
        })
    })

    $(document).on('click', '.appointment-modal-btn', function() {
        var event = "";
        if ($(this).text() == "Book") {
            var url = "{{url('/customer/appointments/store')}}"
            event = "save"

            var appointment_pets     = []
            var appointment_services = []
            var appointment_arr      = []
            var pet_counter          = 1
            var service_counter      = 1

            $.each($('select.pet > option:selected'), function(a, b) {
                if ($(this).attr('data-name') != null) {
                    appointment_pets.push({
                        'id': pet_counter++,
                        'hidden_id': $(this).attr('data-id'),
                        'pet_name': $(this).attr('data-name'),
                        'pet_type': $(this).attr('data-type'),
                        'pet_breed': $(this).attr('data-breed'),
                        'pet_age': $(this).attr('data-age'),
                        'pet_medical_history': $(this).attr('data-history'),
                    })
                }
            })

            $.each($('select.service > option:selected'), function(a, b) {
                if ($(this).attr('data-name') != null) {
                    appointment_services.push({
                        'id': service_counter++,
                        'service_name': $(this).attr('data-name'),
                        'service_description': $(this).attr('data-description'),
                        'service_price': $(this).attr('data-price'),
                    })
                }
            })

            try {
                if (appointment_pets.length != 0 && appointment_services.length != 0) {
                    appointment_arr = appointment_pets.map((item,i) => {

                        if(item.id == appointment_services[i].id){
                            return Object.assign({},item,appointment_services[i])
                        }
                    })
                }
            } catch(error) {
                $('.error-message').show().text('Please fill up the pets/services dropdown.').addClass('text-danger')
                return false;
            }

            $('.error-message').hide().text('')

            if (appointment_arr.length == 0) {
                $('.error-message').show().text('Please fill up the pets/services dropdown.').addClass('text-danger')
                return false;
            }

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', appointment_id);
            formData.append('customer_name', $('#customer_name').val());
            formData.append('contact_no', $('#customer_contact_no').val());
            formData.append('email_address', $('#customer_email_address').val());
            formData.append('appointment_details', JSON.stringify(appointment_arr));
            formData.append('payment_amount', $('#amount').val());
            formData.append('payment_option', $('#payment_option').val());

            if ($('#payment_option').val() == "GCash") {
                formData.append('payment_reference_no', $('#reference_no').val());
                formData.append('payment_screenshot', document.querySelector("#screenshot").files[0]);
            }

            if ($('.date_input').val() == "" && $('.timeslot_input').val() == "") {
                $('.error-message').show().text('Please fill up calendar scheduled.').addClass('text-danger')
                return false;
            }

            formData.append('scheduled_at', $('.date_input').val() + ' ' + $('.timeslot_input').val().split(" ")[0])

            var headers = {'Content-Type': 'multipart/form-data' } // to allow file uploads

            axios.post(url, formData, headers)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var amount_error         = errors[i].indexOf('amount') !== -1
                        // var payment_option_error = errors[i].indexOf('option') !== -1

                        if (amount_error) {
                            $('#amount').addClass('is-invalid')
                            $('.amount-error').show().text(errors[i])
                            break
                        } else {
                            $('#amount').removeClass('is-invalid')
                            $('.amount-error').hide()
                        }

                        if ($('#payment_option').val() == 'GCash') {
                            var reference_no_error   = errors[i].indexOf('reference') !== -1
                            var screenshot_error     = errors[i].indexOf('screenshot') !== -1

                            if (reference_no_error) {
                                $('#reference_no').addClass('is-invalid')
                                $('.reference-no-error').show().text(errors[i])
                                break
                            } else {
                                $('#reference_no').removeClass('is-invalid')
                                $('.reference-no-error').hide()
                            }

                            if (screenshot_error) {
                                $('#screenshot').addClass('is-invalid')
                                $('.screenshot-error').show().text(errors[i])
                                break
                            } else {
                                $('#screenshot').removeClass('is-invalid')
                                $('.screenshot-error').hide()
                            }
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
                        window.location.href = "{{url('/customer/appointments')}}" 
                    }, 3000)
                }
            })

        } else {

            // Cancel booking
            var url = "{{url('/customer/appointments/update')}}"
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', appointment_id);

            var headers = {'Content-Type': 'multipart/form-data' }

            axios.post(url, formData, headers)
            .then(function(response) {
                $('#add-edit-modal').modal('hide')
                $('#update_success_modal').modal('show')

                setTimeout(function() {
                    window.location.href = "{{url('/customer/appointments')}}" 
                }, 3000)
                
            })
        }
    })

</script>

@endsection