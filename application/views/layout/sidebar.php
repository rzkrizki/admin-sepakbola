<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile not-navigation-link">
                <div class="nav-link">
                    <div class="user-wrapper">
                        <div class="profile-image">
                            <img src="<?= base_url() ?>assets/vendors/staradmin/images/faces/face2.jpg" class="profile-images" alt="profile image">
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name">Admin Sepakbola</p>
                            <ul class="nav navbar-nav">
                                <li class="nav-item dropdown">
                                    <span class="status-indicator online"></span>
                                    <small class="designation text-white">Admin</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('team') ?>">
                    <i class="menu-icon mdi mdi-account-group"></i>
                    <span class="menu-title">Manage Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('player') ?>">
                    <i class="menu-icon mdi mdi-account-check"></i>
                    <span class="menu-title">Manage Player</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('schedule') ?>">
                    <i class="menu-icon mdi mdi-calendar-edit"></i>
                    <span class="menu-title">Schedule</span>
                </a>
            </li>
        </ul>
    </nav>