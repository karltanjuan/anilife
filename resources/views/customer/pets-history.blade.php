@extends('layouts.customer-master')

@section('title', 'Pets History')
@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Pets History</h5>
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
    
    <!-- Pet Types Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="pet_history_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Pet Name</th>
                            <th>Pet Photo</th>
                            <th>Pet Medical History</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pets) > 0)
                            @foreach ($pets as $pet)
                            <tr>
                                <td>{{ $pet->name }}</td>
                                <td>
                                    @if ($pet->photo != null)
                                        <img id="preview" class="img-responsive d-flex w-100" src="{{asset('storage/images/pets')}}/{{$pet->photo}}" alt="" style="width: 50px !important; height:  50px;border-radius:50%;padding: 5px;">
                                    @else
                                        <img id="preview" class="img-responsive d-flex w-100" src="{{url('assets/images/pet-logo.png')}}" alt="" style="width: 50px !important; height:  50px;border-radius:50%;padding: 5px;">
                                    @endif
                                </td>
                                <td>{{ $pet->medical_history }}</td>
                                <td>
                                    <a id="btn_edit" class="btn_view"data-id="{{$pet->id}}" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
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
    <!-- /Pet Types Table -->

    <!-- Modal -->
    <div class="modal fade" id="pet_history_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pet-title">History</h5>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Appointment Date</th>
                            </tr>
                        </thead>
                        <tbody class="modal-history"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var pet_id = 0

    $(document).ready(function() {

    });

    $(document).on('click', '.btn_view', function() {
        pet_id = $(this).attr('data-id')
        getPetHistory(pet_id)
        $('#pet_history_modal').modal('show')
    })

    function getPetHistory(pet_id) {
        var url = "{{ url('/customer/pets-history') }}/"+pet_id

        var payload = {
            id: pet_id,
        }

        axios.get(url, payload)
        .then(function(response) {
            var html = ""

            if (response.data.histories.length > 0) {
                $.each(response.data.histories, function(x,y) {
                    $('.pet-title').text(`${y.pet_name} Appointment History`)
                    html += `<tr>
                                <td>${y.service_name}</td>
                                <td>${y.service_description}</td>
                                <td>${y.service_price}</td>
                                <td>${moment(y.created_at).format('LLL')}</td>
                            <tr>`
                })
            } else {
                $('.pet-title').text(`No Appointment History`)
                html += `<tr><td colspan="4" class="text-center">No records found.</td><tr>`
            }

            $('.modal-history').html(html)
        })
    }



</script>

@endsection