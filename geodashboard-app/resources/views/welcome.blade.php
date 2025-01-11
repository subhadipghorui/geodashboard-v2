<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Geodashboard V2</title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/color-modes/color-modes.js') }}"></script>
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        /* GLOBAL STYLES */
        /* Padding below the footer and lighter body text */

        body {
            padding: 0;
            margin: 0;
            color: rgb(var(--bs-tertiary-color-rgb));
        }

        /* MARKETING CONTENT */

        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* rtl:begin:ignore */
        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }

        /* rtl:end:ignore */


        /* Featurettes */

        .featurette-divider {
            margin: 5rem 0;
            /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        /* rtl:begin:remove */
        .featurette-heading {
            letter-spacing: -.05rem;
        }

        /* rtl:end:remove */

        /* RESPONSIVE CSS*/

        @media (min-width: 40em) {

            /* Bump up size of carousel content */
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }
    </style>
</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if (env('APP_LOGO'))
                        <img src="{{ asset(env('APP_LOGO', '')) }}" width="30" height="auto"
                            class="d-inline-block align-top" alt="">
                    @endif
                    Geodashboard V2
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('filament.superadmin.pages.dashboard') }}">Admin
                                        Panel</a>
                                    <a class="dropdown-item" href="{{ route('app.dashboard.index') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="container-fluid">
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Geodashbboard V2</h1>
                    <p class="col-md-8 fs-4">Geodashbboard V2 is a cutting-edge open-source solution designed to
                        revolutionize your GIS and mapping needs. Built with the robust Filament Laravel Admin,
                        Geodashbboard provides a seamless experience for developers and administrators alike. With a
                        focus on usability, scalability, and flexibility, Geodashbboard offers powerful features to
                        bring your geospatial projects to life.</p>
                    <a href="https://github.com/subhadipghorui/geodashboard-v2" class="btn btn-dark btn-lg"
                        type="button">Github Repository</a>
                </div>
            </div>
        </section>
        <section class="container marketing">
            <!-- Three columns of text below the carousel -->
            <div class="d-flex flex-column justify-content-center align-items-center mb-5">
                <h1 class="fw-bold">Authors</h1>
                <p class="fs-4">To know about more feel free to connect with us.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <img src="{{ asset('assets/images/sg.jpeg') }}" class="bd-placeholder-img rounded-circle"
                        width="140" height="140" />
                    <h2 class="fw-normal">Subhadip Ghorui</h2>
                    <p>Software Developer | GIS</p>
                    <p><a class="btn" href="https://www.linkedin.com/in/subhadip-ghorui-273825174/"
                            target="_blank"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 48 48">
                                <path fill="#0288D1"
                                    d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z">
                                </path>
                                <path fill="#FFF"
                                    d="M12 19H17V36H12zM14.485 17h-.028C12.965 17 12 15.888 12 14.499 12 13.08 12.995 12 14.514 12c1.521 0 2.458 1.08 2.486 2.499C17 15.887 16.035 17 14.485 17zM36 36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698-1.501 0-2.313 1.012-2.707 1.99C24.957 25.543 25 26.511 25 27v9h-5V19h5v2.616C25.721 20.5 26.85 19 29.738 19c3.578 0 6.261 2.25 6.261 7.274L36 36 36 36z">
                                </path>
                            </svg></a><a class="btn" href="https://github.com/subhadipghorui" target="_blank"><svg
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 64 64">
                                <path
                                    d="M32 6C17.641 6 6 17.641 6 32c0 12.277 8.512 22.56 19.955 25.286-.592-.141-1.179-.299-1.755-.479V50.85c0 0-.975.325-2.275.325-3.637 0-5.148-3.245-5.525-4.875-.229-.993-.827-1.934-1.469-2.509-.767-.684-1.126-.686-1.131-.92-.01-.491.658-.471.975-.471 1.625 0 2.857 1.729 3.429 2.623 1.417 2.207 2.938 2.577 3.721 2.577.975 0 1.817-.146 2.397-.426.268-1.888 1.108-3.57 2.478-4.774-6.097-1.219-10.4-4.716-10.4-10.4 0-2.928 1.175-5.619 3.133-7.792C19.333 23.641 19 22.494 19 20.625c0-1.235.086-2.751.65-4.225 0 0 3.708.026 7.205 3.338C28.469 19.268 30.196 19 32 19s3.531.268 5.145.738c3.497-3.312 7.205-3.338 7.205-3.338.567 1.474.65 2.99.65 4.225 0 2.015-.268 3.19-.432 3.697C46.466 26.475 47.6 29.124 47.6 32c0 5.684-4.303 9.181-10.4 10.4 1.628 1.43 2.6 3.513 2.6 5.85v8.557c-.576.181-1.162.338-1.755.479C49.488 54.56 58 44.277 58 32 58 17.641 46.359 6 32 6zM33.813 57.93C33.214 57.972 32.61 58 32 58 32.61 58 33.213 57.971 33.813 57.93zM37.786 57.346c-1.164.265-2.357.451-3.575.554C35.429 57.797 36.622 57.61 37.786 57.346zM32 58c-.61 0-1.214-.028-1.813-.07C30.787 57.971 31.39 58 32 58zM29.788 57.9c-1.217-.103-2.411-.289-3.574-.554C27.378 57.61 28.571 57.797 29.788 57.9z">
                                </path>
                            </svg></a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img src="{{ asset('assets/images/pj.jpeg') }}" class="bd-placeholder-img rounded-circle"
                        width="140" height="140" />
                    <h2 class="fw-normal">Piergiorgio (PJ) Roveda</h2>
                    <p>Urban Planner | Developer</p>
                    <p><a class="btn" href="https://www.linkedin.com/in/piergiorgioroveda-gis/"
                            target="_blank"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 48 48">
                                <path fill="#0288D1"
                                    d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z">
                                </path>
                                <path fill="#FFF"
                                    d="M12 19H17V36H12zM14.485 17h-.028C12.965 17 12 15.888 12 14.499 12 13.08 12.995 12 14.514 12c1.521 0 2.458 1.08 2.486 2.499C17 15.887 16.035 17 14.485 17zM36 36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698-1.501 0-2.313 1.012-2.707 1.99C24.957 25.543 25 26.511 25 27v9h-5V19h5v2.616C25.721 20.5 26.85 19 29.738 19c3.578 0 6.261 2.25 6.261 7.274L36 36 36 36z">
                                </path>
                            </svg></a><a class="btn" href="https://github.com/piergiorgio-roveda"
                            target="_blank"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 64 64">
                                <path
                                    d="M32 6C17.641 6 6 17.641 6 32c0 12.277 8.512 22.56 19.955 25.286-.592-.141-1.179-.299-1.755-.479V50.85c0 0-.975.325-2.275.325-3.637 0-5.148-3.245-5.525-4.875-.229-.993-.827-1.934-1.469-2.509-.767-.684-1.126-.686-1.131-.92-.01-.491.658-.471.975-.471 1.625 0 2.857 1.729 3.429 2.623 1.417 2.207 2.938 2.577 3.721 2.577.975 0 1.817-.146 2.397-.426.268-1.888 1.108-3.57 2.478-4.774-6.097-1.219-10.4-4.716-10.4-10.4 0-2.928 1.175-5.619 3.133-7.792C19.333 23.641 19 22.494 19 20.625c0-1.235.086-2.751.65-4.225 0 0 3.708.026 7.205 3.338C28.469 19.268 30.196 19 32 19s3.531.268 5.145.738c3.497-3.312 7.205-3.338 7.205-3.338.567 1.474.65 2.99.65 4.225 0 2.015-.268 3.19-.432 3.697C46.466 26.475 47.6 29.124 47.6 32c0 5.684-4.303 9.181-10.4 10.4 1.628 1.43 2.6 3.513 2.6 5.85v8.557c-.576.181-1.162.338-1.755.479C49.488 54.56 58 44.277 58 32 58 17.641 46.359 6 32 6zM33.813 57.93C33.214 57.972 32.61 58 32 58 32.61 58 33.213 57.971 33.813 57.93zM37.786 57.346c-1.164.265-2.357.451-3.575.554C35.429 57.797 36.622 57.61 37.786 57.346zM32 58c-.61 0-1.214-.028-1.813-.07C30.787 57.971 31.39 58 32 58zM29.788 57.9c-1.217-.103-2.411-.289-3.574-.554C27.378 57.61 28.571 57.797 29.788 57.9z">
                                </path>
                            </svg></a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </section><!-- /.container -->
        <hr class="featurette-divider">
        <section class="container mt-5">
            <div class="d-flex flex-column justify-content-center align-items-center mb-5">
                <h1 class="fw-bold">Features</h1>
                <p class="fs-4">Top features Geodashboard V2 provide you.</p>
            </div>
            <div class="row featurette">
                <div class="col-md-5">
                    <h2 class="featurette-heading fw-normal lh-1">Dynamic <span
                            class="text-body-secondary">Dashboard</span></h2>
                    <p class="lead">Modern GIS dashboard with custom basemaps, layer control, legend etc.</p>
                </div>
                <div class="col-md-7">
                    <img src="{{ asset('assets/images/dashboard-map.png') }}" alt="" width="100%">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-5 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Create and Manage <span
                            class="text-body-secondary">Groups</span></h2>
                    <p class="lead">Collaborate efficiently by organizing users into groups. Geodashbboard’s group
                        management feature allows for streamlined permissions, access control, and team-based
                        workflows—perfect for projects with multiple contributors.</p>
                </div>
                <div class="col-md-7 order-md-1">
                    <img src="{{ asset('assets/images/g_groups.png') }}" alt="" width="100%">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-5">
                    <h2 class="featurette-heading fw-normal lh-1">Publish Dynamic Applications from the <span
                            class="text-body-secondary">Admin Panel</span></h2>
                    <p class="lead">Take control of your GIS projects with Geodashbboard's intuitive admin panel.
                        Create, configure, and publish dynamic applications directly from the admin interface,
                        eliminating the need for complex coding workflows.</p>
                </div>
                <div class="col-md-7">
                    <img src="{{ asset('assets/images/g_maps.png') }}" alt="" width="100%">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-5 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Native Support for <span
                            class="text-body-secondary">Mapbox</span></h2>
                    <p class="lead">Leverage the power of Mapbox with Geodashbboard's native integration. Easily
                        embed, customize, and optimize Mapbox maps to create stunning visualizations and interactive
                        experiences for your users.</p>
                </div>
                <div class="col-md-7 order-md-1">
                    <img src="{{ asset('assets/images/g_layers.png') }}" alt="" width="100%">
                </div>
            </div>
        </section>
        <!-- FOOTER -->
    </main>

    <footer class="container-fluid">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; <script>document.write(new Date().getFullYear())</script> &copy; Geodashboard V2</p>
    </footer>
</body>

</html>
