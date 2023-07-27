<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3><img src="{{ asset('assets/images/logo.png') }}" class="img-fluid"/>
            <a href="{{url('/')}}" style="color:#fff;font-size:20px;">
                <span>{{ env('APP_NAME') }}</span>
            </a>
        </h3>
    </div>

    <ul class="list-unstyled components flex-column">
        <li class="{{ 'admin/dashboard' == request()->path() ? 'active' : '' }}">
            <a href="{{ url('/admin/dashboard') }}" class="dashboard">
                <div data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="material-icons-outlined">dashboard</i><span>Dashboard</span>
                </div>
            </a>
        </li>

        
        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <li class="{{ 'admin/appointments' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/admin/appointments') }}" class="appointments">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Appointments">
                        <i class="lar la-calendar-check"></i><span>Appointments</span>
                    </div>
                </a>
            </li>
        @endif
        
        @if (auth()->user()->role == 1)
            <li class="{{ 'admin/services' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/admin/services') }}" class="services">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Services">
                        <i class="las la-paw"></i><span>Services</span>
                    </div>
                </a>
            </li>

            <li class="{{ 'admin/pet-types' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/admin/pet-types') }}" class="pet-types">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Pet Types">
                        <i class="las la-dog"></i><span>Pet Types</span>
                    </div>
                </a>
            </li>

            <li class="{{ 'admin/pet-breeds' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/admin/pet-breeds') }}" class="pet-breeds">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Pet Breeds">
                        <i class="las la-cat"></i><span>Pet Breeds</span>
                    </div>
                </a>
            </li>
        @endif

        <li class="{{ 'admin/inquiries/all' == request()->path() ? 'active' : '' }}">
            <a href="{{ url('/admin/inquiries/all') }}" class="feedback">
                <div data-bs-toggle="tooltip" data-bs-placement="right" title="Inquiries">
                    <i class="las la-comment"></i><span>Inquiries</span>
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
                        @if (auth()->user()->role == 1)
                            <li class="{{ 'admin/settings/clinic' == request()->path() ? 'active' : '' }}">
                                <a href="{{ url('/admin/settings/clinic') }}" class="dropdown-item">Clinic</a>
                            </li>
                            <li class="{{ 'admin/settings/users' == request()->path() ? 'active' : '' }}">
                                <a href="{{ url('/admin/settings/users') }}" class="dropdown-item">Users</a>
                            </li>
                            {{-- <li class="{{ 'admin/settings/user-roles' == request()->path() ? 'active' : '' }}">
                                <a href="{{ url('/admin/settings/user-roles') }}" class="dropdown-item">Users Roles</a>
                            </li> --}}
                            <li>
                                <a href="javascript:void(0)" id="btn_backup" class="dropdown-item">Database Backup</a>
                            </li>
                        @endif

                        <?php $active = ""; ?>
                        @if (request()->path() == 'admin/settings/activity-logs/All/All/'.date('Y-01-01').'/'.date('Y-m-d'))
                            <?php $active = 'active'; ?>
                        @endif

                        <li class="{{$active}}">
                            <a href="{{ url('admin/settings/activity-logs') }}/All/All/{{date('Y-01-01')}}/{{date('Y-m-d')}}" class="dropdown-item">Activity Logs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /Sidebar -->

<!-- Modal -->
<div class="modal fade" id="database_backup_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Database Backup</h5>
            </div>
            <div class="modal-body">
                <p id="backup_message" class="text-center"></p>
            </div>
            <div class="modal-footer">
                <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>
<script>
    
    
    $(document).on('click', '#btn_backup', function() {
        
        var url = "{{url('/admin/database-backup')}}";

        axios.get(url)
            .then(function(response) {             
                // var message = response.data.message.split('\n')
                var html = ""

                html += '<div class=" check-container"></div>'
                html += '<div class="spinner-grow spinner-grow-sm me-2 text-primary" role="status">'
                html += '   <span class="visually-hidden">Loading...</span>'
                html += '</div>'
                html += '<div class="spinner-grow spinner-grow-sm me-2 text-primary" role="status">'
                html += '   <span class="visually-hidden">Loading...</span>'
                html += '</div>'
                html += '<div class="spinner-grow spinner-grow-sm me-2 text-primary" role="status">'
                html += '   <span class="visually-hidden">Loading...</span>'
                html += '</div>'
                html += '<span class="d-block export-message">Exporting database...</span>'
                // for (var i = 0; i < message.length; i++) {
                //     html += "<p>"+message[i]+"</p>"
                // }

                $('#backup_message').html(html)
                setTimeout(function() {
                    $('.export-message').text('Database backed up successfully!')
                    $('.spinner-grow').hide()
                    $('.check-container').show().html('<i class="text-success las la-check-circle display-6"></i>')
                }, 5000)
                $('#database_backup_modal').modal('show')
            })
    })
</script>