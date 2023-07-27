<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- Morris.js cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/admin/style.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
</head>
<body onload="initClock()" class="user-select-none">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="body-overlay"></div>

        @include('layouts.inc.admin-sidebar')

        <!-- Page Content -->
        <div id="content">
            @include('layouts.inc.admin-navbar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- /Main Content -->

            @include('layouts.inc.admin-footer')
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    
    <!-- Morris.js JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- Data Tables Bootstrap 5 JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Axios JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- JavaScript -->
    <script src="{{ url('assets/js/admin/main.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
				$('#content').toggleClass('active');
            });
			
			$('.more-button,.body-overlay').on('click', function () {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });
			
        });

        // Data tables
        $(document).ready(function() {

            var dataTable_appointment = $('#appointment_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[6, 'desc']],
            });

            var dataTable_service = $('#service_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[4, 'asc']],
            });

            var dataTable_pet_type = $('#pet_type_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[2, 'asc']],
            });

            var dataTable_pet_breed = $('#pet_breed_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[3, 'asc']],
            });

            var dataTable_brgy = $('#brgy_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[5, 'asc']],
            });

            var dataTable_resident = $('#resident_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[5, 'asc']],
            });

            var dataTable_certificate = $('#certificate_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                // "order": [[7, 'desc']],
            });
        
            var dataTable_permit = $('#permit_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[7, 'desc']],
            });

            var dataTable_blotter = $('#blotter_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[7, 'desc']],
            });

            var dataTable_summon = $('#summon_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                // "order": [[4, 'asc']],
            });

            var dataTable_household = $('#household_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
            })

            var dataTable_document = $('#document_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[ 5, "desc" ], [4, "asc"]],
            })

            var dataTable_inquiry = $('#inquiry_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[4, 'desc']],
            });

            var dataTable_clinic = $('#clinic_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[3, 'asc']],
            });

            var dataTable_user = $('#user_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[7, 'asc']],
            });

            var dataTable_user_role = $('#user_role_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "order": [[2, 'desc']],
            });

            var dataTable_logs = $('#logs_table').DataTable({
                "lengthChange": false,
                "iDisplayLength" : 10,
                "columnDefs": [ { type: 'date', 'targets': [4] } ],
                "order": [[4, 'desc']],
            });

            /* Add event listeners to the two range filtering inputs */
            $('#filterbox').keyup(function() {
                dataTable_appointment.search(this.value).draw();
                dataTable_service.search(this.value).draw();
                dataTable_pet_type.search(this.value).draw();
                dataTable_pet_breed.search(this.value).draw();

                dataTable_brgy.search(this.value).draw();
                dataTable_resident.search(this.value).draw();
                dataTable_certificate.search(this.value).draw();
                dataTable_permit.search(this.value).draw();
                dataTable_blotter.search(this.value).draw();
                dataTable_summon.search(this.value).draw();
                dataTable_household.search(this.value).draw();
                dataTable_document.search(this.value).draw();
                dataTable_inquiry.search(this.value).draw();
                dataTable_clinic.search(this.value).draw();
                dataTable_user.search(this.value).draw();
                dataTable_user_role.search(this.value).draw();
                dataTable_logs.search(this.value).draw();
            } );
        });
    </script>
</body>
</html>