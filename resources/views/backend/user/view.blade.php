@extends('frontend.layout.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{$breadcrumb}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('backend.layout.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">User - {{$user->id}}</h3>
                                <div class="s-body text-center mt-3">
                                    <div>
                                        @if (!empty($user?->image))
                                            <img class="rounded-circle img-fluid" src="{{ asset('images/'.$user->image) }}" style="width:150px" alt="My profile Picture">
                                        @endif
                                        <h5 class="mt-3 pb-0">{{$user->name}}</h5>
                                        <p class="text-muted mb-1 fs-6">{{$user->designation}}</p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Email:</label>
                                   {{ $user->email }}
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Phone:</label>
                                    {{ $user->phone }}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
