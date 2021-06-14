<style>
    .navbar-menu-wrapper {
        background: linear-gradient(120deg, #191b4c, #191b4c, #20165a) !important;
    }

    .navbar.default-layout .navbar-brand-wrapper {
        background: #191b4c;
    }

    .navbar.default-layout {
        background: #191b4c;
    }

    .sidebar .nav .nav-item.active>.nav-link {
        color: #20165a;
        font-weight: 600;
    }

    .sidebar .nav .nav-item>.nav-link {
        color: #fff;
        font-weight: 600;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item:hover:not(.nav-profile)>.nav-link {
        color: #20165a;
        font-weight: 600;
    }

    .sidebar .nav .nav-item .nav-link .menu-icon {
        color: #fff;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item:hover:not(.nav-profile)>.nav-link>.menu-icon {
        color: #20165a;
        font-weight: 600;
    }

    .sidebar .nav .nav-item .nav-link {
        color: #fff;
        font-weight: 600;
    }

    .sidebar .nav .nav-item .nav-link:hover {
        color: #fff;
        font-weight: 600;
    }

    .sidebar {
        background: linear-gradient(120deg, #191b4c, #191b4c, #20165a) !important;
        border-top: 1px solid #fff;
        border-right: 1px solid #20165a;
        border-left: 1px solid #20165a;
    }

    .profile-text {
        font-weight: 600;
    }

    .profile-images {
        height: 40px;
    }

    .btn-info {
        background: #20165a;
        color: #fff;
    }
</style>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
            <img src="<?= base_url() ?>assets/vendors/staradmin/images/samples/html5.png" alt="logo" style="width: calc(70px - 9px);" /> </a>
        <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
            <img src="<?= base_url() ?>assets/vendors/staradmin/images/samples/html5.png" style="width: calc(70px - 9px);" alt="logo" /> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text">Admin Sepakbola</span>
                    <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/vendors/staradmin/images/faces/face2.jpg" class="img-fluid" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item p-0">
                        <div class="d-flex border-bottom">
                            <a href="<?= base_url('team') ?>">
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center" style="font-size: 20px;">
                                    <i class="mdi mdi-account-group mr-0 text-gray"></i>
                                </div>
                            </a>
                            <a href="<?= base_url('player') ?>">
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right" style="font-size: 20px;">
                                    <i class="mdi mdi-account-check mr-0 text-gray"></i>
                                </div>
                            </a>
                            <a href="<?= base_url('schedule') ?>">
                                <div class="py-3 px-4 d-flex align-items-center justify-content-center" style="font-size: 20px;">
                                    <i class="mdi mdi-calendar-edit mr-0 text-gray"></i>
                                </div>
                            </a>
                        </div>
                    </a>
                    <a class="dropdown-item" href="<?= base_url('logout') ?>"> Sign Out </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>