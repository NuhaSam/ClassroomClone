<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if( App::currentLocale() == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Classroom</title>
    @stack('styles')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <!-- <div class="container"> -->
            <img src="https://www.gstatic.com/classroom/logo_square_rounded.svg" class="" alt="Google Classroom" data-iml="0" width="40px" style="margin-right: 8px; margin-left:30px">

            <a class="navbar-brand" href="{{ route('classrooms.show') }}"><b>{{ __('Classrooms') }}</b> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if($classroom ?? '')
            <a href="{{ route('classrooms.view',$classroom->id) }}"> > {{ $classroom->name }} </a>
            @endif
            @if($classwork ?? '')
            <!-- <a> > {{ $classwork->title }} </a> -->
            @endif
            <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    language
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('classroom.index','ar') }}">Arabic</a></li>
                    <li><a class="dropdown-item" href="{{ route('classroom.index','en') }}">English</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>

            </li>



            <!--
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul> -->
            <div class="" style="margin-left: 12cl00px;">
                <b> {{Auth::user()->name }} </b>
                <!-- <img src="{{ asset('storage/covers/de user.png')}}"alt="M" width="30"> -->
                <img src="{{ asset('storage/users/de user.png')}}" alt="M" width="30" style="margin-right: 40px; margin-left:8px">
                <!-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
            </div>
            </div>
            <!-- <ul id="classrooms">aa</ul> -->
        </nav>
    </header>

    @yield('content')
    @stack('scripts')
    <script>
        var classroom_id;
        userId = "{{ Auth::id()}}";
    </script>
    <!-- <script>
        fetch('/api/v1/classrooms')
            .then(res => res.json())
            .then(json => {
                let ul = document.getElementById('classrooms')
                for (let i in json.data) {
                    ul.innerHTML += `<li>${json.data[i].name} </li>`
                    //   ul.innerHTML += "KJK"
                }
            })
    </script> -->
    @vite(['resources/js/app.js'])
</body>


</html>