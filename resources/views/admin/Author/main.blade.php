
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MiSHU Admin Panel</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{'interface'}}/vendors/core/core.css">
    <!-- endinject -->
<!-- plugin css for this page -->
<link rel="stylesheet" href="{{'interface'}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{'interface'}}/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="{{'interface'}}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- endinject -->
<!-- Layout styles -->
    <link rel="stylesheet" href="{{'interface'}}/css/demo_1/style.css">
<!-- End layout styles -->
<link rel="shortcut icon" href="{{'interface'}}/images/favicon.png" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"/>
</head>
<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
        MiSHU<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
            <a href="" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Options</li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('become.author') }}">
                <i class="link-icon" data-feather="feather"></i>
                <span class="link-title">Become an Author</span>
            </a>
        </li>
        @if (Auth::guard('author')->user()->author==1)
        <li class="nav-item">
            <a class="nav-link"  href="{{ route('add.post') }}">
                <i class="link-icon" data-feather="layout"></i>
                <span class="link-title">Your Content</span>
            </a>
        </li>
        @endif
                {{-- <li class="nav-item">
                    <a href="pages/apps/chat.html" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Chat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                    </a>
                </li> --}}
        </ul>
    </div>
    </nav>
    <nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
            Light
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
            Dark
            </label>
        </div>
        </div>
        <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Theme:</h6>
        <a class="theme-item active" href="../demo_1/dashboard-one.html">
            <img src="{{'interface'}}/images/screenshots/light.jpg" alt="light theme">
        </a>
        <h6 class="text-muted mb-2">Dark Theme:</h6>
        <a class="theme-item" href="../demo_2/dashboard-one.html">
            <img src="{{'interface'}}/images/screenshots/dark.jpg" alt="light theme">
        </a>
        </div>
    </div>
    </nav>
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <form class="search-form">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="search"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::guard('author')->user()->photo == null)
                                    <img src="{{ Avatar::create(Auth::guard('author')->user()->username)->toBase64() }}" />
                                @else
                                    <img src="{{ asset('uploads/author/') }}/{{ Auth::guard('author')->user()->photo }}" alt="profile">
                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    <div class="figure mb-3">
                                        @if (Auth::guard('author')->user()->photo == null)
                                            <img src="{{ Avatar::create(Auth::guard('author')->user()->username)->toBase64() }}" />
                                        @else
                                            <img src="{{ asset('uploads/author/') }}/{{ Auth::guard('author')->user()->photo }}" alt="profile">
                                        @endif
                                    </div>
                                    <div class="info text-center">
                                        <p class="name font-weight-bold mb-0">{{ Auth::guard('author')->user()->username }}</p>
                                        <p class="email text-muted mb-3">{{ Auth::guard('author')->user()->email }}</p>
                                    </div>
                                </div>
                                <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                        <li class="nav-item">
                                            <a href="" class="nav-link">
                                                <i data-feather="user"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('author.edit.profile') }}" class="nav-link">
                                                <i data-feather="edit"></i>
                                                <span>Edit Profile</span>
                                            </a>
                                        </li>
                                            <li class="nav-item">
                                                    <a href="{{route('author.logout')}}" class="nav-link">
                                                        <i data-feather="log-out"></i>
                                                        <span>Log Out</span>
                                                    </a>
                                                </form>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-content">
                <div class="mb-2" align="right">
                    <a href="{{ route('index') }}" class="btn btn-outline-primary btn-lg">Back to blog</a>
                </div>
                @yield('page_content')
            </div>

            <!-- partial:partials/_footer.html -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
                <p class="text-muted text-center text-md-left">Copyright © 2023 <a href="https://www.facebook.com/towfiqurrahma/" target="_blank">MiUI</a>. All rights reserved</p>
                <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
            </footer>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{'interface'}}/vendors/core/core.js"></script>
    <!-- endinject -->
<!-- plugin js for this page -->
<script src="{{'interface'}}/vendors/chartjs/Chart.min.js"></script>
<script src="{{'interface'}}/vendors/jquery.flot/jquery.flot.js"></script>
<script src="{{'interface'}}/vendors/jquery.flot/jquery.flot.resize.js"></script>
<script src="{{'interface'}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{'interface'}}/vendors/apexcharts/apexcharts.min.js"></script>
<script src="{{'interface'}}/vendors/progressbar.js/progressbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="{{'interface'}}/vendors/feather-icons/feather.min.js"></script>
    <script src="{{'interface'}}/js/template.js"></script>
    <!-- endinject -->
<!-- custom js for this page -->
<script src="{{'interface'}}/js/dashboard.js"></script>
<script src="{{'interface'}}/js/datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <!-- end custom js for this page -->
    @yield('footer_script')
</body>
</html>
