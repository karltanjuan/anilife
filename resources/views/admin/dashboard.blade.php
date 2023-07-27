@extends('layouts.master')

@section('title', env('APP_NAME').' | Dashboard')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ url('/css/full-calendar5.min.css') }}"/>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-pending">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-hourglass-start"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles pending_count"></h3>
                    <p class="category">Pending</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Pending Appointment
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-confirmed">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-smile"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles confirmed_count"></h3>
                    <p class="category">Confirmed</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Confirmed Appointment
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-cancelled">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-times-circle"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles cancelled_count"></h3>
                    <p class="category">Cancelled</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Cancelled Appointment
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-completed">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-calendar-check"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles completed_count"></h3>
                    <p class="category">Completed</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Completed Appointment
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-completed">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-calendar-check"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles inquiries_count"></h3>
                    <p class="category">Inquiries</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Inquiry
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-services">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-paw"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles services_count"></h3>
                    <p class="category">Services</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Services
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-customer">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-users"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles customer_count"></h3>
                    <p class="category">Customer</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                       Total Customer
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-type">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-dog"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles type_count"></h3>
                    <p class="category">Pet Type</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Pet Type
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-breed">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-cat"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles breed_count"></h3> <!-- PUT HERE THE TOTAL EMPLOYED -->
                    <p class="category">Pet Breed</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Pet Breed
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 gy-2">
        <div class="col-lg-12 col-md-6 col-sm-6">
            <div class="card card-stats p-4 h-100">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats date-time h-100 align-items-center">
                            <div class="datetime mx-auto my-auto">
                                <div class="date text-center">
                                    <span id="month">Month</span>
                                    <span id="daynum">00</span>,
                                    <span id="year">Year</span>
                                </div>
                                <div class="time text-center">
                                    <span id="hour">00</span>:
                                    <span id="minutes">00</span>
                                    <span id="period">AM</span>
                                </div>
                                <div class="day text-center">
                                    <span id="dayname">DAY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats pt-4 h-100">
                            <h6 class="pt-1 text-center count">Customer Gender</h6>
                            <center><div id="gender_chart" style="max-width: 300px; width: 100%;"></div></center>
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats pt-4 h-100">
                            <h6 class="pt-1 text-center count">Weekly Appointment</h6>
                            <center><div id="appointment-chart" style="max-width: 500px; width: 100%;"></div></center>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                    <div id='appointment-calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Morris.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="{{url('/js/full-calendar5.min.js')}}"></script>
    <script>
        // Date and Time        

        getDashboard()
        // getGender()
        getWeeklyAppointment()

        function getDashboard() {
            var url = "{{ url('/admin/dashboard/view') }}"

            axios.get(url)
            .then(function(response) {
                var data = response.data

                $('.services_count').text(data.services_count)
                $('.pending_count').text(data.pending_count)
                $('.confirmed_count').text(data.confirmed_count)
                $('.cancelled_count').text(data.cancelled_count)   
                $('.completed_count').text(data.completed_count)
                $('.inquiries_count').text(data.inquiries_count)
                $('.customer_count').text(data.customer_count)
                $('.type_count').text(data.type_count)
                $('.breed_count').text(data.breed_count)  

                male_count = data.male_count
                female_count = data.female_count

            })
        }

        // Every 1 hour will get dashboard count from the server
        setInterval(function() {
            getDashboard()
            // $("#gender_chart").empty();
            // getGender();
            $("#appointment_chart").empty();
            getAppointmentPerWeek();
        }, 3600000)

        function getGender() {
            // Doughnut Chart
            var male_count   = "0"
            var female_count = "0"

            var url = "{{ url('/admin/dashboard/view') }}"

            axios.get(url)
            .then(function(response) {
                var data = response.data

                male_count = data.male_count
                female_count = data.female_count

                var m = "#1E90FF", f = "#FF69B4"; 
                new Morris.Donut ({
                    element: 'gender_chart',
                    data: [
                        {label: "\xa0 \xa0Total Male\xa0 \xa0", value: male_count, color: m},
                        {label: "\xa0Total Female\xa0", value: female_count, color: f}
                    ]
                });
            })
        }

        function getWeeklyAppointment() {
            // Line Chart
            var url = "{{ url('/admin/dashboard/weekly-appointment') }}"

            axios.get(url)
            .then(function(response) {
                Morris.Line({
                    element: 'appointment-chart',
                    data: response.data,
                    xkey: 'day',
                    ykeys: ['count'],
                    labels: ['Sales'],
                    parseTime: false,
                    hideHover: 'auto',
                    xLabelAngle: 60,
                    resize: true,
                    lineColors: ['#428bca'],
                });
            });
        }

        var calendar;
    var appointment = $.parseJSON('<?= json_encode($appointment_arr) ?>') || {};

    $(function(){
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
                selectable: true,
                themeSystem: 'bootstrap',
                weekends: false,
                //Random default events
                events: [
                    {
                        daysOfWeek: [1,2,3,4,5], // these recurrent events move separately
                        title:'{{$setting->max_client}} Slots Available',
                        allDay: true,
                    }
                ],
                validRange:{
                    start: moment(date).format("YYYY-MM-DD"),
                },
                eventDidMount:function(info){
                    // console.log(appointment)
                    if(!!appointment[info.event.startStr]){
                        var available = parseInt(info.event.title) - parseInt(appointment[info.event.startStr]);
                        $(info.el).find('.fc-event-title.fc-sticky').text(available + " Slots Available")
                    }
                },
                editable  : true
            });

            calendar.render();
        })

    </script>

@endsection