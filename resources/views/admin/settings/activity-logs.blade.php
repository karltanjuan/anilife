@extends('layouts.master')

@section('title', 'Activity Logs')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Activity Logs</h5>
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
                       <a target="_blank" href="{{url('admin/settings/activity-logs-export-excel')}}/{{request()->module}}/{{request()->log_type}}/{{request()->date_from}}/{{request()->date_to}}" id="export_excel" class="btn btn-outline-success rounded-pill mx-2 border-2 tableBtn">
                            Export Excel
                        </a>
                        <a target="_blank" href="{{url('admin/settings/activity-logs-export-pdf')}}/{{request()->module}}/{{request()->log_type}}/{{request()->date_from}}/{{request()->date_to}}" id="export_pdf" class="btn btn-outline-danger rounded-pill border-2 tableBtn">
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mx-2">
        <div class="col-md-3">
            <div class="form-group">
                <label for="filter_module">Module</label>
                <select id="filter_module" class="form-control" onChange="filterLogs()">
                    <option value="All">All</option>
                    <option value="Appointments">Appointments</option>
                    <option value="Services">Services</option>
                    <option value="Pet Types">Pet Types</option>
                    <option value="Pet Breeds">Pet Breeds</option>
                    <option value="Users">Users</option>
                    <option value="Database Backup">Database Backup</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="filter_log">Log type</label>
                <select id="filter_log" class="form-control" onChange="filterLogs()">
                    <option value="All">All</option>
                    <option value="Login">Login</option>
                    <option value="Logout">Logout</option>
                    <option value="Create">Create</option>
                    <option value="Update">Update</option>
                    <option value="Delete">Delete</option>
                    <option value="Export Excel">Export Excel</option>
                    <option value="Export PDF">Export PDF</option>
                    <option value="Download Database Backup">Backup Database</option>
                </select>
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <label for="date_from">Date From</label>
                <input type="date" class="form-control" id="date_from" onChange="filterLogs()">
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <label for="date_from">Date To</label>
                <input type="date" class="form-control" id="date_to" onChange="filterLogs()">
            </div>
        </div>
    </div>
    
    <!-- Activity Logs Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="logs_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Module</th>
                            <th>Log Type</th>
                            <th>IP Address</th>
                            <th>Log By</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($activity_logs) > 0)
                            @foreach ($activity_logs as $log)
                            <tr>
                                <td>{{ $log->module }}</td>
                                <td>
                                    <?php $btn_class = "bg-light"; ?>
                                    {{-- @if($log->log_type == "Create")
                                        <?php $btn_class = "bg-success"; ?>
                                    @elseif($log->log_type == "Update")
                                        <?php $btn_class = "bg-primary"; ?>
                                    @elseif($log->log_type == "Delete")
                                        <?php $btn_class = "bg-danger"; ?>
                                    @elseif($log->log_type == "Export Excel")
                                        <?php $btn_class = "bg-warning text-dark"; ?>
                                    @elseif($log->log_type == "Export PDF")
                                        <?php $btn_class = "bg-info text-dark"; ?>
                                    @elseif($log->log_type == "Download Database Backup")
                                        <?php $btn_class = "bg-success"; ?>
                                    @elseif($log->log_type == "Login")
                                        <?php $btn_class = "bg-secondary"; ?>
                                    @elseif($log->log_type == "Logout")
                                        <?php $btn_class = "bg-secondary"; ?>
                                    @elseif($log->log_type == "Backup Database")
                                        <?php $btn_class = "bg-info"; ?>
                                    @endif --}}
                                    <span class="badge rounded-pill text-dark {{$btn_class}} w-100">{{ ucwords($log->log_type) }}</span>
                                </td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->first_name }} {{ $log->middle_name }} {{ $log->last_name }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($log->created_at)) }}</td>
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
    <!-- /Activity Logs Table -->

    <!-- Modal -->

</div>

<script>

    $(document).ready(function() {
        $('#filter_module > option[value="'+"{{ app('request')->segment(4) }}"+'"]').prop('selected', true)
        $('#filter_log > option[value="'+"{{ app('request')->segment(5) }}"+'"]').prop('selected', true)
        $('#date_from').val("{{ app('request')->segment(6) }}")
        $('#date_to').val("{{ app('request')->segment(7) }}")
    })

    $(document).on('click', '#export_excel', function() {
        showModal()
    })

    $(document).on('click', '#export_pdf', function() {
        showModal()
    })

    function showModal() {
         setTimeout(function() {
            $('#logs_export_modal').modal('show')
        }, 2000)
    }

    function filterLogs() {
        var module_name = $('#filter_module').val()
        var log_type    = $('#filter_log').val()
        var date_from   = $('#date_from').val()
        var date_to     = $('#date_to').val()

        if (date_from.length <= 0) {
            date_from = "{{ date('Y-01-01') }}"
        }

        if (date_to.length <= 0) {
            date_to = "{{ date('Y-m-d') }}"
        }

        var url = "{{ url('/admin/settings/activity-logs') }}/"+module_name+"/"+log_type+"/"+date_from+"/"+date_to
        window.location.href = url
    }

</script>

@endsection