@extends('layouts.customer-master')

@section('title', env('APP_NAME').' | Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-population">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-users"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles population_count"></h3> <!-- PUT HERE THE TOTAL POPULATION -->
                    <p class="category">POPULATION</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Population
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-voters">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-fingerprint"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles voters_count"></h3> <!-- PUT HERE THE TOTAL VOTERS -->
                    <p class="category">VOTERS</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Voters
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-nonvoters">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-user-times"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles non_voters_count"></h3> <!-- PUT HERE THE TOTAL NON-VOTERS -->
                    <p class="category">NON-VOTERS</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Non-Voters
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-pwd">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-wheelchair"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles pwd_count"></h3> <!-- PUT HERE THE TOTAL PWD -->
                    <p class="category">PWD</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total PWD
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-senior">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-blind"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles senior_citizen_count"></h3> <!-- PUT HERE THE TOTAL SENIOR CITIZEN -->
                    <p class="category">SENIOR CITIZEN</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Senior Citizen
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-business">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-building"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles establishment_count"></h3> <!-- PUT HERE THE TOTAL ESTABLISHMENTS -->
                    <p class="category">ESTABLISHMENTS</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Business Permit Details
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-blotter">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-layer-group"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles blotter_count"></h3> <!-- PUT HERE THE TOTAL BLOTTER -->
                    <p class="category">BLOTTER</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Blotter Records
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card cards card-stats card-employed">
                <div class="card-header">
                    <div class="icon">
                        <i class="las la-user-tie"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title card-titles employed_count"></h3> <!-- PUT HERE THE TOTAL EMPLOYED -->
                    <p class="category">EMPLOYED</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Employed
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 gy-2">
        <div class="col-lg-8 col-md-6 col-sm-6">
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
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats h-100 border-0">
                            <h6 class="pt-1 pb-3 text-center count">Document Requests Count</h6>
                            <div class="row gx-3">
                                <div class="col-6">
                                    <div class="card ms-4 mb-3 indigency">
                                        <div class="card-body count ps-0 pe-0">
                                            <h3 class="card-title text-center pt-3 indigency_count"></h3> <!-- PUT HERE THE INDIGENCY -->
                                            <p class="card-text text-center pt-2 pb-2">Indigency</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card me-4 mb-3 certification">
                                        <div class="card-body count ps-0 pe-0">
                                            <h3 class="card-title text-center pt-3 clearance_count"></h3> <!-- PUT HERE THE CERTIFICATION -->
                                            <p class="card-text text-center pt-2 pb-2">Clearance</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3 pb-2">
                                <div class="col-6">
                                    <div class="card ms-4 mb-3 residency">
                                        <div class="card-body count ps-0 pe-0">
                                            <h3 class="card-title text-center pt-3 residency_count"></h3> <!-- PUT HERE THE RESIDENCY -->
                                            <p class="card-text text-center pt-2 pb-2">Residency</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card me-4 mb-3 permit">
                                        <div class="card-body count ps-0 pe-0">
                                            <h3 class="card-title text-center pt-3 business_permit_count"></h3> <!-- PUT HERE THE BUSINESS PERMIT -->
                                            <p class="card-text text-center pt-2 pb-2">Business Permit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats pt-4 h-100">
                <h6 class="pt-1 text-center count">Resident Chart</h6>
                <center><div id="gender_chart" style="max-width: 300px; width: 100%;"></div></center>
            </div>
        </div>
    </div>


    <!-- Morris.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        // Date and Time        

        getDashboard()
        getGender()

        function getDashboard() {
            var url = "{{ url('/customer/dashboard/view') }}"

            axios.get(url)
            .then(function(response) {
                var data = response.data

                $('.population_count').text(data.population_count)
                $('.voters_count').text(data.voters_count)
                $('.non_voters_count').text(data.non_voters_count)
                $('.pwd_count').text(data.pwd_count)   
                $('.senior_citizen_count').text(data.senior_citizen_count)
                $('.establishment_count').text(data.establishment_count)
                $('.blotter_count').text(data.blotter_count)
                $('.employed_count').text(data.employed_count)  
                $('.indigency_count').text(data.indigency_count) 
                $('.clearance_count').text(data.clearance_count)
                $('.residency_count').text(data.residency_count)    
                $('.business_permit_count').text(data.business_permit_count)

                male_count = data.male_count
                female_count = data.female_count

            })
        }

        // Every 15 seconds will get dashboard count from the server
        setInterval(function() {
            getDashboard()
            $("#gender_chart").empty();
            getGender();
        }, 15000)

        function getGender() {
            // Doughnut Chart
            var male_count   = "0"
            var female_count = "0"

            var url = "{{ url('/customer/dashboard/view') }}"

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

        

        

    </script>

@endsection