@extends('layouts.master')

@section('title', 'Clinic Management')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Clinic Management</h5>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Clinic Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="clinic_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Opening Hour</th>
                            <th>Closing Hour</th>
                            <th>Max Client Per Day</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($clinic) > 0)
                            @foreach ($clinic as $clin)
                            <tr>
                                <td>{{ $clin->clinic_hours_start }}</td>
                                <td>{{ $clin->clinic_hours_end }}</td>
                                <td>{{ $clin->max_client }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($clin->created_at)) }}</td>
                                <td class="text-center">
                                    <a id="btn_edit" class="btn_edit" data-id="{{$clin->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="las la-edit text-primary"></i>
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
    <!-- /Clinic Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title clinic-modal-title" id="staticBackdropLabel">Create User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="form-container">
                        
                        <div class="col-md-4 mb-2">
                            <label for="clinic_hours_start" class="form-label">Opening Hour</label>
                            <select id="clinic_hours_start" class="form-control">
                                <option disabled selected>Select hour...</option>
                                <option value="12:30am">12:30am</option>
                                <option value="1:00am">1:00am</option>
                                <option value="1:30am">1:30am</option>
                                <option value="2:00am">2:00am</option>
                                <option value="2:30am">2:30am</option>
                                <option value="3:00am">3:00am</option>
                                <option value="3:30am">3:30am</option>
                                <option value="4:00am">4:00am</option>
                                <option value="4:30am">4:30am</option>
                                <option value="5:00am">5:00am</option>
                                <option value="5:30am">5:30am</option>
                                <option value="6:00am">6:00am</option>
                                <option value="6:30am">6:30am</option>
                                <option value="7:00am">7:00am</option>
                                <option value="7:30am">7:30am</option>
                                <option value="8:00am">8:00am</option>
                                <option value="8:30am">8:30am</option>
                                <option value="9:00am">9:00am</option>
                                <option value="9:30am">9:30am</option>
                                <option value="10:00am">10:00am</option>
                                <option value="10:30am">10:30am</option>
                                <option value="11:00am">11:00am</option>
                                <option value="11:30am">11:30am</option>
                                <option value="12:00pm">12:00pm</option>
                                <option value="12:30pm">12:30pm</option>
                                <option value="1:00pm">1:00pm</option>
                                <option value="1:30pm">1:30pm</option>
                                <option value="2:00pm">2:00pm</option>
                                <option value="2:30pm">2:30pm</option>
                                <option value="3:00pm">3:00pm</option>
                                <option value="3:30pm">3:30pm</option>
                                <option value="4:00pm">4:00pm</option>
                                <option value="4:30pm">4:30pm</option>
                                <option value="5:00pm">5:00pm</option>
                                <option value="5:30pm">5:30pm</option>
                                <option value="6:00pm">6:00pm</option>
                                <option value="6:30pm">6:30pm</option>
                                <option value="7:00pm">7:00pm</option>
                                <option value="7:30pm">7:30pm</option>
                                <option value="8:00pm">8:00pm</option>
                                <option value="8:30pm">8:30pm</option>
                                <option value="9:00pm">9:00pm</option>
                                <option value="9:30pm">9:30pm</option>
                                <option value="10:00pm">10:00pm</option>
                                <option value="10:30pm">10:30pm</option>
                                <option value="11:00pm">11:00pm</option>
                                <option value="11:30pm">11:30pm</option>
                            </select>
                            <div class="invalid-feedback clinic-hours-start-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="clinic_hours_end" class="form-label">Closing Hour</label>
                            <select id="clinic_hours_end" class="form-control" >
                                <option disabled selected>Select hour...</option>
                                <option value="12:30am">12:30am</option>
                                <option value="1:00am">1:00am</option>
                                <option value="1:30am">1:30am</option>
                                <option value="2:00am">2:00am</option>
                                <option value="2:30am">2:30am</option>
                                <option value="3:00am">3:00am</option>
                                <option value="3:30am">3:30am</option>
                                <option value="4:00am">4:00am</option>
                                <option value="4:30am">4:30am</option>
                                <option value="5:00am">5:00am</option>
                                <option value="5:30am">5:30am</option>
                                <option value="6:00am">6:00am</option>
                                <option value="6:30am">6:30am</option>
                                <option value="7:00am">7:00am</option>
                                <option value="7:30am">7:30am</option>
                                <option value="8:00am">8:00am</option>
                                <option value="8:30am">8:30am</option>
                                <option value="9:00am">9:00am</option>
                                <option value="9:30am">9:30am</option>
                                <option value="10:00am">10:00am</option>
                                <option value="10:30am">10:30am</option>
                                <option value="11:00am">11:00am</option>
                                <option value="11:30am">11:30am</option>
                                <option value="12:00pm">12:00pm</option>
                                <option value="12:30pm">12:30pm</option>
                                <option value="1:00pm">1:00pm</option>
                                <option value="1:30pm">1:30pm</option>
                                <option value="2:00pm">2:00pm</option>
                                <option value="2:30pm">2:30pm</option>
                                <option value="3:00pm">3:00pm</option>
                                <option value="3:30pm">3:30pm</option>
                                <option value="4:00pm">4:00pm</option>
                                <option value="4:30pm">4:30pm</option>
                                <option value="5:00pm">5:00pm</option>
                                <option value="5:30pm">5:30pm</option>
                                <option value="6:00pm">6:00pm</option>
                                <option value="6:30pm">6:30pm</option>
                                <option value="7:00pm">7:00pm</option>
                                <option value="7:30pm">7:30pm</option>
                                <option value="8:00pm">8:00pm</option>
                                <option value="8:30pm">8:30pm</option>
                                <option value="9:00pm">9:00pm</option>
                                <option value="9:30pm">9:30pm</option>
                                <option value="10:00pm">10:00pm</option>
                                <option value="10:30pm">10:30pm</option>
                                <option value="11:00pm">11:00pm</option>
                                <option value="11:30pm">11:30pm</option>
                            </select>
                            <div class="invalid-feedback clinic-hours-end-error"></div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="max_client" class="form-label">Max Client Per Day</label>
                            <input id="max_client" type="number" class="form-control" placeholder="Enter max client">
                            <div class="invalid-feedback max-client-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success clinic-modal-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_success_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Clinic Updated</h5>
                </div>
                <div class="modal-body">
                    <p>Clinic updated successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn_ok" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    var clinic_id = 0

    function getClinicById(id) {
        var url = "{{ url('/admin/settings/clinic') }}/"+clinic_id
        var payload = {
            id: clinic_id,
        }

        axios.post(url, payload)
        .then(function(response) {
            var html = ""

            $.each(response.data.clinic, function(x,y) {
                $('#clinic_hours_start').val(y.clinic_hours_start)
                $('#clinic_hours_end').val(y.clinic_hours_end)
                $('#max_client').val(y.max_client)
            })
        })
    }

    let clinic = {}

    $(document).on('click', '.btn_edit', function() {
        clinic_id = $(this).attr('data-id')
        $('.clinic-modal-title').text('Update Clinic')
        $('.clinic-modal-btn').text('Update')

        getClinicById(clinic_id)

        $('#add-edit-modal').modal('show')
    })

    $(document).on('click', '.clinic-modal-btn', function() {

        var event = "";
        if ($(this).text() == "Save") {
            var url = "{{url('/admin/settings/clinic/update')}}"
            event = "save"
        } else {
            var url = "{{url('/admin/settings/clinic/update')}}"
            event = "update"
        }

        var payload = {
            _token: "{{ csrf_token() }}",
            id: clinic_id,
            clinic_hours_start: $('#clinic_hours_start').val(),
            clinic_hours_end: $('#clinic_hours_end').val(),
            max_client: $('#max_client').val(),
        }


        axios.post(url, payload)
            .then(function(response) {
                if (response.data.code == 422) {
                    var errors = response.data.error
                    for (var i = 0; i < errors.length; i++) {
                        var clinic_hours_start = errors[i].indexOf('start') !== -1
                        var clinic_hours_end   = errors[i].indexOf('end') !== -1
                        var max_client         = errors[i].indexOf('max') !== -1

                        if (clinic_hours_start) {
                            $('#clinic_hours_start').addClass('is-invalid')
                            $('.clinic-hours-start-error').show().text(errors[i])
                            break
                        } else {
                            $('#clinic_hours_start').removeClass('is-invalid')
                            $('.clinic-hours-start-error').hide()
                        }

                        if (clinic_hours_end) {
                            $('#clinic_hours_end').addClass('is-invalid')
                            $('.clinic-hours-end-error').show().text(errors[i])
                            break
                        } else {
                            $('#clinic_hours_end').removeClass('is-invalid')
                            $('.clinic-hours-end-error').hide()
                        }

                        if (max_client) {
                            $('#max_client').addClass('is-invalid')
                            $('.max-client-error').show().text(errors[i])
                            break
                        } else {
                            $('#max_client').removeClass('is-invalid')
                            $('.max-client-error').hide()
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
                        window.location.href = "{{url('/admin/settings/clinic')}}" 
                    }, 3000)
                }
            })
    })


</script>

@endsection