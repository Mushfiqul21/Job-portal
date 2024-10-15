@extends('frontend.layout.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('backend.layout.sidebar')
                </div>
                <div class="col-lg-9 dashboard">
                    <h5 class="footer text-white py-2 px-3">Dashboard</h5>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="card p-3">
                                <h5>Users</h5>
                                <p>100</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card p-3">
                                <h5>Jobs</h5>
                                <p>40</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card p-3">
                                <h5>Applicants</h5>
                                <p>80</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
