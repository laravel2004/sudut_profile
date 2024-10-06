<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="User Profile {{$global_setting['app_name']}}">
    <meta name="description" content="{{$global_setting['app_description']}}">
    <title>{{$global_setting['app_name']}}</title>
    <link rel="icon" href="{{ asset('storage/logo/' . $global_setting['app_favicon']) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('clients/assets/libs/OwlCarousel-2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/dist/css/style.css') }}">
    <style>
        .footer {
            color: white;
            padding: 2rem 0;
        }

        .footer a {
            color: #ffc107;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: #fff;
        }

        .footer .fw-bold {
            font-weight: 700;
        }

        .project-card {
            transition: transform 0.2s, box-shadow 0.2s; /* Smooth transition for hover effects */
            border-radius: 0.5rem; /* Rounded corners */
        }

        .project-card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Enhance shadow on hover */
        }

        .card-img-top {
            border-top-left-radius: 0.5rem; /* Rounded corners on top */
            border-top-right-radius: 0.5rem; /* Rounded corners on top */
            object-fit: cover; /* Ensures image covers the area */
            height: 200px; /* Fixed height for consistent look */
        }

        .card-body {
            position: relative; /* Allows positioning of elements inside */
        }

        .card-title {
            font-size: 1.25rem; /* Adjust font size for title */
            margin-bottom: 1rem; /* Spacing below the title */
        }

        .card-text {
            color: #6c757d; /* Gray color for card text */
            margin-bottom: 1.5rem; /* Spacing below the content */
        }

        .card {
            border-radius: 12px;
        }

        .icon-box {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background: linear-gradient(135deg, rgba(255, 223, 0, 0.1), rgba(255, 255, 255, 0.1));
        }

        .card-body .content h5 {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card-body .content p {
            margin-bottom: 0;
        }

        .portfolio {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .card {
            background-color: white;
        }
        .card-title {
            color: #007bff;
        }
        .card-subtitle {
            color: #6c757d;
        }
        .text-warning {
            color: #ffc107 !important; /* Bootstrap warning color */
        }
        .text-secondary {
            color: #6c757d !important; /* Bootstrap secondary color */
        }
    </style>
</head>

<body>
<!------------------------------>
<!-- Header Start -->
<!------------------------------>
<header class="main-header position-fixed w-100">
    <div class="container">
        <nav class="navbar navbar-expand-xl py-0">
            <div class="logo">
                <a class="navbar-brand py-0 me-0" href="#">
                    <h4 class="text-primary fw-bold">{{$global_setting['app_name']}}</h4>
                </a>
            </div>
            <a class="d-inline-block d-lg-block d-xl-none d-xxl-none  nav-toggler text-decoration-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="ti ti-menu-2 text-warning"></i>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" aria-current="page" href="#home">Home</a>
                    </li>
                    @if($educations)
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="#education">Pendidikan</a>
                        </li>
                    @endif
                    @if($workExperiences)
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="#work-experience">Pengalaman Kerja</a>
                        </li>
                    @endif
                    @if($projects)
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="#project">Project</a>
                        </li>
                    @endif
                    @if($articles)
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="#artikel">Artikel</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
         aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="logo">
                <a class="navbar-brand py-0 me-0" href="#"><img src="{{ asset('clients/assets/images/Creato-logo.svg') }}" alt=""></a>
            </div>
            <button type="button" class="btn-close text-reset  ms-auto" data-bs-dismiss="offcanvas"
                    aria-label="Close"><i class="ti ti-x text-warning"></i></button>
        </div>
        <div class="offcanvas-body pt-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-capitalize" aria-current="page" href="#home">Home</a>
                </li>
                @if($educations)
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#education">Pendidikan</a>
                    </li>
                @endif
                @if($workExperiences)
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#work-experience">Pengalaman Kerja</a>
                    </li>
                @endif
                @if($projects)
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#project">Project</a>
                    </li>
                @endif
                @if($articles)
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#artikel">Artikel</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
<!------------------------------>
<!-- Header End  -->
<!------------------------------>
<!------------------------------>
<!--- Hero Banner Start--------->
<!------------------------------>
<section class="hero-banner position-relative overflow-hidden" id="home">
    <div class="container">
        <div class="row d-flex flex-wrap align-items-center">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="position-relative left-hero-color">
                    <h1 class="mb-0 fw-bold">
                        {{ $global_setting['app_name'] }}
                    </h1>
                    <p class="lh-base text-secondary" style="line-height: 1.5 !important;">
                        {{ $global_setting['app_description'] }}
                    </p>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="position-relative right-hero-color text-end">
                    <img src="{{ asset('storage/logo/' . $global_setting['app_profile']) }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------------>
<!--- Hero Banner End--------->
<!------------------------------>

<!------------------------------>
<!--- Service sectin Start------>
<!------------------------------>
<section class="service overflow-hidden" id="education">
    <div class="container">
        <img src="{{ asset('clients/assets/images/service/dot-shape.png') }}" class="shape">
        <div class="row">
            <div class="col-12"><small class="fs-7 d-block">
                    Riwayat Pendidikan Saya
                </small></div>
            <div class="">
                <h2 class="fs-2 text-black mb-0">
                    Pendidikan
                </h2>
            </div>
            <div>
                <p class="text-secondary">
                    Berikut adalah riwayat pendidikan saya
                </p>

                <div class="row">
                    @foreach($educations as $education)
                        <div class="col-md-4 mb-3">
                            <div class="card border border-warning shadow-sm">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-center gap-4">
                                        <div class="icon-box bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-user-graduate fa-2x"></i>
                                        </div>
                                        <div class="content">
                                            <a href="{{ $education->link }}" class="text-decoration-none" target="_blank">
                                                <h5 class="text-warning fw-bold mb-1">{{ $education->school_name }}</h5>
                                            </a>
                                            <p class="text-secondary mb-1">
                                                <strong>{{ $education->jurusan }}</strong>
                                            </p>
                                            <p class="text-secondary mb-0">
                                                {{ $education->start_year }} - {{ $education->end_year }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($prestations)
                <div class="mt-3">
                    <h2 class="fs-2 text-black mb-0">
                        Prestasi
                    </h2>
                </div>
                @foreach($prestations as $prestation)
                    <div class="container mt-4 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                            <div class="row no-gutters">
                                <div class="col-md-4" style="height: 250px;">
                                    <img src="{{asset('storage/prestation/' . $prestation->image)}}" class="card-img" alt="Vehicle Image" style="height: 100%; width: 100%; object-fit: cover;">
                                </div>
                                <div class="col-md-5">
                                    <div class="card-body d-flex flex-column justify-content-center h-100">
                                        <h5 class="card-title text-primary font-weight-bold">{{$prestation->title}}</h5>
                                        <p class="card-text text-muted mb-3">{{$prestation->competition_organizer}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-center bg-light">
                                    <a href="/prestations/{{$prestation->slug}}" class="btn btn-primary btn-lg px-4 m-2">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


<!------------------------------>
<!--- Service sectin Start------>
<!------------------------------>

<!------------------------------>
<!-- Portfolio section Start---->
<!------------------------------>
@if($workExperiences)
    <section class="portfolio position-relative bg-primary py-5" id="work-experience">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12 mb-3">
                    <small class="fs-7 d-block text-warning">Tentang Pengalaman Kerja</small>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <h2 class="fs-3 text-white mb-3">Pengalaman Kerja</h2>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($workExperiences as $workExperience)
                        <div class="col-md-4 mb-4"> <!-- Change col-12 to col-md-4 for 3 cards per row -->
                            <div class="card border-0 shadow-lg rounded-lg">
                                <div class="card-body">
                                    <h5 class="card-title text-primary font-weight-bold">{{ $workExperience->company_name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $workExperience->position }}</h6>
                                    <p class="card-text">
                                        <span class="text-secondary"><i class="fas fa-calendar-alt"></i> {{ $workExperience->start_date }} - {{ $workExperience->end_date }}</span>
                                    </p>
                                    <p class="card-text">{!! $workExperience->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endif

@if($projects)
    <section class="portfolio position-relative bg-primary py-5" id="project">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12 mb-3">
                    <small class="fs-7 d-block text-warning">Tentang Project</small>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <h2 class="fs-3 text-white mb-3">Project</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    @foreach($projects as $project)
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card project-card shadow-sm border-0">
                                <img src="{{ asset('storage/project/' . $project->image) }}" class="card-img-top" alt="Project Image">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $project->title }}</h5>
                                    <div class="card-text" id="project-content-{{ $project->id }}">
                                        <!-- Content generated by CKEditor will be inserted here -->
                                    </div>
                                    <a href="/projects/{{$project->slug}}" class="btn btn-primary mt-2">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@if($articles)
    <section class="portfolio position-relative bg-primary py-5" id="artikel">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12 mb-3">
                    <small class="fs-7 d-block text-warning">Tentang Artikel Saya</small>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <h2 class="fs-3 text-white mb-3">Artikel</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    @foreach($articles as $article) <!-- Assuming $articles for the articles section -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card project-card shadow-sm border-0">
                            <img src="{{ asset('storage/artikel/' . $article->image) }}" class="card-img-top" alt="Article Image">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $article->title }}</h5>
                                <div class="card-text" id="article-content-{{ $article->id }}">
                                    <!-- Content generated by CKEditor will be inserted here -->
                                </div>
                                <a href="/artikel/{{$article->slug}}" class="btn btn-primary mt-2">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4"> <!-- Center align the button -->
                    <a href="/artikel" class="btn btn-primary">Lihat Lebih Banyak</a>
                </div>
            </div>
        </div>
    </section>
@endif


<!------------------------------>
<!-- Portfolio section End ----->
<!------------------------------>


<!------------------------------>
<!-----Footer Start------------->
<!------------------------------>
<footer class="footer bg-dark text-white py-4">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 mb-3">
                <h5 class="fw-bold">Kontak Kami</h5>
                <p>
                    <a href="tel:{{$global_setting['app_telp']}}" class="text-white text-decoration-none">
                        <i class="fa fa-phone me-2"></i>{{$global_setting['app_telp']}}
                    </a>
                </p>
                <p>
                    <a href="mailto:{{$global_setting['app_email']}}" class="text-white text-decoration-none">
                        <i class="fa fa-envelope me-2"></i>{{$global_setting['app_email']}}
                    </a>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="fw-bold">Temukan Kami</h5>
                <p>
                    <a href="{{$global_setting['app_linkedin']}}" class="text-white text-decoration-none" target="_blank">
                        <i class="fa fa-linkedin me-2"></i>LinkedIn
                    </a>
                </p>
                <p>
                    <a href="{{$global_setting['app_ig']}}" class="text-white text-decoration-none" target="_blank">
                        <i class="fa fa-instagram me-2"></i>Instagram
                    </a>
                </p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <div class="blue-light fw-500">@<span id="autodate">2024</span> <a class="text-decoration-none" href="https://sudutweb.com">PT. Sudutweb Teknologi</a> - All Rights Reserved</div>
            </div>
        </div>
    </div>
</footer>

<!------------------------------>
<!-------Footer End------------->
<!------------------------------>

<script>
    document.getElementById('autodate').textContent = new Date().getFullYear();
    function truncateContent(content, maxLength) {
        const textContent = content.replace(/<[^>]*>/g, ''); // Remove HTML tags
        return textContent.length > maxLength ? textContent.substring(0, maxLength) + '...' : textContent;
    }

    // Process project contents
    @foreach($projects as $project)
    const projectContent{{ $project->id }} = `{!! addslashes($project->content) !!}`; // Escape content
    document.getElementById('project-content-{{ $project->id }}').innerHTML = truncateContent(projectContent{{ $project->id }}, 100); // Show only 100 characters
    @endforeach

    // Process article contents
    @foreach($articles as $article)
    const articleContent{{ $article->id }} = `{!! addslashes($article->content) !!}`; // Escape content
    document.getElementById('article-content-{{ $article->id }}').innerHTML = truncateContent(articleContent{{ $article->id }}, 100); // Show only 100 characters
    @endforeach

    // Initialize CKEditor for project contents
    @foreach($projects as $project)
    CKEDITOR.replace('project-editor-{{ $project->id }}', {
        on: {
            change: function(evt) {
                const editorData = this.getData();
                // Optionally handle editor data change
            }
        }
    });
    @endforeach

    // Initialize CKEditor for article contents
    @foreach($articles as $article)
    CKEDITOR.replace('article-editor-{{ $article->id }}', {
        on: {
            change: function(evt) {
                const editorData = this.getData();
                // Optionally handle editor data change
            }
        }
    });
    @endforeach

</script>
<!-- Include CKEditor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="{{ asset('clients/dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('clients/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('clients/assets/libs/OwlCarousel-2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('clients/dist/js/custom.js') }}"></script>
<script src="https://kit.fontawesome.com/1d954ea888.js"></script>

</body>

</html>
