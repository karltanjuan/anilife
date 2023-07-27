<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3><img src="{{ asset('assets/images/logo.png') }}" class="img-fluid"/>
            <span>{{ env('APP_NAME') }}</span>
        </h3>
    </div>

    <ul class="list-unstyled components flex-column">
       {{--  <li class="{{ 'customer/dashboard' == request()->path() ? 'active' : '' }}">
            <a href="{{ url('/customer/dashboard') }}" class="dashboard">
                <div data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="material-icons-outlined">dashboard</i><span>Dashboard</span>
                </div>
            </a>
        </li> --}}

        @if (auth()->user()->role == 3)

            <li class="{{ 'customer/appointments' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/customer/appointments') }}" class="appointments">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Appointments">
                        <i class="lar la-calendar-check"></i><span>Appointments</span>
                    </div>
                </a>
            </li>

            <li class="{{ 'customer/pets-history' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/customer/pets-history') }}" class="pets-history">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Pets History">
                        <i class="las la-dog"></i><span>Pets History</span>
                    </div>
                </a>
            </li>
            <li class="{{ 'customer/pets' == request()->path() ? 'active' : '' }}">
                <a href="{{ url('/customer/pets') }}" class="pets">
                    <div data-bs-toggle="tooltip" data-bs-placement="right" title="Pets">
                        <i class="las la-dog"></i><span>Pets</span>
                    </div>
                </a>
            </li>
        @endif
    </ul>
</nav>
<!-- /Sidebar -->

<script>

</script>