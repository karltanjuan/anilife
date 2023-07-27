<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- Morris.js cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/admin/style.css') }}">
    
    <title>Dashboard | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>
<body onload="initClock()">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="body-overlay"></div>

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="{{ asset('images/logo.png') }}" class="img-fluid"/><span>{{ env('APP_NAME') }}</span></h3>
            </div>

            <ul class="list-unstyled components flex-column">
                <li class="active">
                    <a href="#" class="dashboard">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                            <i class="material-icons-outlined">dashboard</i><span>Dashboard</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="officials">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Brgy Officials and Staffs">
                            <i class="las la-user-check"></i><span>Brgy Officials and Staffs</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="residents">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Resident Information">
                            <i class="las la-users"></i><span>Resident Information</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="certificates">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Barangay Certificates">
                            <i class="las la-certificate"></i><span>Barangay Certificates</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="permits">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Business Permit">
                            <i class="las la-file"></i><span>Business Permit</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="blotter">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Blotter Records">
                            <i class="las la-layer-group"></i><span>Blotter Records</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="households">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Household">
                            <i class="las la-home"></i><span>Households</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="request">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Request Document">
                            <i class="las la-file-invoice"></i><span>Requested Documents</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="feedback">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Feedback">
                            <i class="las la-comment"></i><span>Feedback</span>
                        </div>
                    </a>
                </li>
                <!-- Dropdown -->
                <li>
                    <a href="#" id="settings" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <div data-bs-toggle="tooltip" data-bs-placement="right" title="Settings">
                            <i class="las la-cog"></i><span>Settings</span>
                        </div>        
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordionSidebar">
                        <div class="py-2 collapse-inner rounded">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#" class="dropdown-item">Users</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">Database Backup</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">Activity Logs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /Sidebar -->

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <div class="top-navbar">
                <nav class="navbar sticky-top navbar-expand-lg">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-block d-block more-button">
                            <i class="material-icons-outlined">menu</i>
                        </button>
                        <button id="sidebarCollapse" type="button" class="d-xl-block d-lg-block d-md-block d-block" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="las la-user-circle fs-3"></i>
                        </button>
                        <!-- Dropdown - User Information -->
                        <div class="profile dropdown-menu dropdown-menu-end me-2 shadow dropend" aria-labelledby="userDropdown">
                            <p class="admin-name text-center m-0 text-secondary fw-bold">Admin Name</p>
                            <p class="admin-pos text-center m-0 text-secondary">Chairman</p>
                                
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item user-dd text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="las la-user-edit fs-6"></i> Edit Profile
                            </a>
                            <a class="dropdown-item user-dd text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#changePassModal">
                                <i class="las la-user-cog fs-6"></i> Change Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item user-dd text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="las la-sign-out-alt fs-5"></i> Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- /Navbar -->

            <!-- Edit Profile Modal-->
            <div class="modal fade" id="editProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Select <b>"Logout"</b> below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="#" type="button" class="btn btn-primary">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Profile Modal-->

            <!-- Change Password Modal-->
            <div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="password" id="password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="#" type="button" class="btn btn-primary">Update Password</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Change Password Modal-->

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Ready to Leave?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Select <b>"Logout"</b> below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="#" type="button" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Logout Modal-->

            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card cards card-stats card-population">
                            <div class="card-header">
                                <div class="icon">
                                    <i class="las la-users"></i>
                                </div>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title card-titles">10,000</h3> <!-- PUT HERE THE TOTAL POPULATION -->
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
                                <h3 class="card-title card-titles">7,000</h3> <!-- PUT HERE THE TOTAL VOTERS -->
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
                                <h3 class="card-title card-titles">3,000</h3> <!-- PUT HERE THE TOTAL NON-VOTERS -->
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
                                <h3 class="card-title card-titles">2,000</h3> <!-- PUT HERE THE TOTAL PWD -->
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
                                <h3 class="card-title card-titles">5,000</h3> <!-- PUT HERE THE TOTAL SENIOR CITIZEN -->
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
                                <h3 class="card-title card-titles">500</h3> <!-- PUT HERE THE TOTAL ESTABLISHMENTS -->
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
                                <h3 class="card-title card-titles">0</h3> <!-- PUT HERE THE TOTAL BLOTTER -->
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
                                <h3 class="card-title card-titles">8,000</h3> <!-- PUT HERE THE TOTAL EMPLOYED -->
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
                                                        <h3 class="card-title text-center pt-3">7</h3> <!-- PUT HERE THE INDIGENCY -->
                                                        <p class="card-text text-center pt-2 pb-2">Indigency</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card me-4 mb-3 certification">
                                                    <div class="card-body count ps-0 pe-0">
                                                        <h3 class="card-title text-center pt-3">7</h3> <!-- PUT HERE THE CERTIFICATION -->
                                                        <p class="card-text text-center pt-2 pb-2">Certification</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row gx-3 pb-2">
                                            <div class="col-6">
                                                <div class="card ms-4 mb-3 residency">
                                                    <div class="card-body count ps-0 pe-0">
                                                        <h3 class="card-title text-center pt-3">7</h3> <!-- PUT HERE THE RESIDENCY -->
                                                        <p class="card-text text-center pt-2 pb-2">Residency</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card me-4 mb-3 permit">
                                                    <div class="card-body count ps-0 pe-0">
                                                        <h3 class="card-title text-center pt-3">7</h3> <!-- PUT HERE THE BUSINESS PERMIT -->
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
                            <center><div id="chart" style="max-width: 300px; width: 100%;"></div></center>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Main Content -->

            <!-- Footer -->
            <footer>
                <p class="copyright text-center pt-4 user-select-none">Copyright &copy; {{date('Y')}} {{ env('APP_NAME') }}. All rights reserved.</p>
            </footer>
            <!-- /Footer -->
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- Page Wrapper -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    
    <!-- Morris.js JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->

    <!-- JavaScript -->
    <script src="{{ url('js/admin/main.js') }}"></script>
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
    </script>

    
</body>
</html>