<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <!-- Always visible image -->
        <img src="{{ asset('front/images/main-logo/Asset.png') }}" class="app-brand-logo" style="width: 50px; margin-right: 10px; margin-left: 30px;">
        <!-- Text is visible by default -->
        <b class="navbar-text"> 
            @if (Auth::guard('admin')->user()->type == 'vendor')
                Breeder Panel
            @elseif (Auth::guard('admin')->user()->type == 'subadmin')
                Delivery Panel
            @else
                Admin Panel
            @endif
        </b>
        <script>function toggleNavbarText() {
    const navbarText = document.querySelector('.navbar-text');
    if (navbarText) {
        navbarText.classList.toggle('d-none'); // This hides or shows the text
    }
}
</script>
<style>.navbar-text {
    font-weight: bold;
    color: #000000; 
    margin-left: 5px;
    transition: opacity 0.3s ease;
}
</style>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" onclick="toggleNavbarText()">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if (!empty(Auth::guard('admin')->user()->image))
                        <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}" alt="profile">
                    @else
                        <img src="{{ url('admin/images/photos/no-image.gif') }}" alt="profile">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a href="{{ url('admin/update-admin-details') }}" class="dropdown-item">
                        <i class="ti-settings text-primary"></i> Settings
                    </a>
                    <a href="{{ url('admin/logout') }}" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
