<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">CareerVibe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('job.jobs') }}">Find Jobs</a>
                    </li>
                </ul>
                @if(!Auth::check())
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}" type="submit">Login</a>
                @else
                    @if(Auth::user()->role == 'admin')
                        <a class="btn btn-outline-primary me-2" href="{{ route('dashboard') }}" type="submit">Admin</a>
                    @endif
                    <a class="btn btn-outline-primary me-2" href="{{ route('profile') }}" type="submit">Profile</a>
                @endif
                <a class="btn btn-primary" href="{{ route('job.create') }}" type="submit">Post a Job</a>

                @if(Auth::check())
                    <a class="ms-2" href="{{route('profile')}}"> <img class="rounded-circle img-fluid" src="{{ asset('images/'.auth()->user()->image) }}" style="width:50px"></a>
                @endif

            </div>
        </div>
    </nav>
</header>
