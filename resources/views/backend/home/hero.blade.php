@extends('frontend.layout.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $breadcrumb }}</li>
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
                        <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">Edit HeroSection</h3>
                                <div class="s-body text-start mb-3 mt-3">
                                    <div>
                                        <img class="img-fluid" src="{{ asset('images/'.$hero->bg_image) }}" style="width:150px" alt="Hero Image">
                                    </div>
                                </div>
                                @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                        <p>{{Session::get('message')}}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mb-4">
                                    <label for="" class="mb-2">Hero Section Background<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="bg_image" id="picture-upload">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Title<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Name" name="title" class="form-control" value="{{ $hero->title }}">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">SubTitle<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Email" name="sub_title" class="form-control" value="{{ $hero->sub_title }}">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
