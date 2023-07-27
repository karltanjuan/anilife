<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <div class="container-fluid">
            <a class="app-logo-text text-decoration-none" href="{{url('/')}}" onclick="window.location.reload(true);"> <img
                    src="{{ URL::asset('/assets/images/logo.png') }}" alt="logo" id="app-logo">&ensp; Anilife</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation" id="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" id="navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 float-end text-end" id="header-nav">
                    {{ $slot ?? '' }}
                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
    <script defer>
        $(function() {
            if ($("#header-nav").children("li").length == 1) {
                $("#navbar-toggler").hide();
                $("div").removeClass("navbar-collapse collapse");
            }
        });
    </script>
@endpush
