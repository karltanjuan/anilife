@extends('layouts.master')

@section('title', 'Inquiries')

@section('content')

<div class="card mt-3">
    <div class="row mt-4">
        <div class="col-lg-4">
            <h5 class="ms-4">Inquiries</h5>
        </div>
        <div class="col-lg-6 text-middle">
            <div class="text-lg-end text-center me-0 me-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group input-group-sm float-lg-end" style="width: 300px;">
                            <span class="input-group-text iconS" id="basic-addon1"><span class="material-icons-outlined text-secondary">search</span></span>
                            <input type="search" class="form-control" id="filterbox" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a target="_blank" href="{{url('admin/inquiries-export-excel')}}/{{request()->filter}}" id="export_excel" class="btn btn-outline-success rounded-pill mx-2 border-2 tableBtn">
                            Export Excel
                        </a>
                        <a target="_blank" href="{{url('admin/inquiries-export-pdf')}}/{{request()->filter}}" id="export_pdf" class="btn btn-outline-danger rounded-pill border-2 tableBtn">
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Inquiries Table -->
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive pt-1 pb-4 p-4 mt-2">
                <table id="inquiry_table" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Contact No.</th>
                            <th>Inquiry Details</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($inquiries) > 0)
                            @foreach ($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->full_name }}</td>
                                <td><a class="text-primary" href="mailto:{{ $inquiry->email_address }}">{{ $inquiry->email_address }}</a></td>
                                <td><span onclick="copyContactNo(this)" class="contact-no" style="cursor:pointer;">{{ $inquiry->contact_no }}</span></td>
                                <td>{{ $inquiry->message }}</td>
                                <td>{{ date("M d, Y h:i A", strtotime($inquiry->created_at)) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No records found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2">
            <a href="{{ url('/admin/inquiries/today') }}">
                <div class="card total_today mb-4 mt-3 me-5">
                    <div class="card-body count ps-0 pe-0">
                        <h3 class="card-title text-white text-center pt-3">{{ $today_count }}</h3>
                        <p class="card-text text-white text-center pt-2 pb-2">Total Today</p>
                    </div>
                </div>
            </a>
            <a href="{{ url('/admin/inquiries/last-week') }}">
                <div class="card total_last_week mb-3 mt-3 me-5">
                    <div class="card-body count ps-0 pe-0">
                        <h3 class="card-title text-white text-center pt-3">{{ $last_week_count }}</h3>
                        <p class="card-text text-white text-center pt-2 pb-2">Total Last Week</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- /Inquiries Table -->

    <!-- Modal -->
    <div class="modal fade" id="inquiry_export_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inquiries Exported</h5>
                </div>
                <div class="modal-body">
                    <p>Inquiries downloaded successfully.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#export_excel', function() {
        showModal()
    })

    $(document).on('click', '#export_pdf', function() {
        showModal()
    })

    function showModal() {
         setTimeout(function() {
            $('#inquiry_export_modal').modal('show')
        }, 2000)
    }

    function copyContactNo(val){
        var inp =document.createElement('input');
        document.body.appendChild(inp)
        inp.value =val.textContent
        inp.select();
        document.execCommand('copy',false);
        inp.remove();
    }

</script>

@endsection