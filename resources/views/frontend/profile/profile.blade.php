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
                    @include('frontend.profile.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                <div class="s-body text-center mt-3">
                                    <div>
                                        @if (!empty($user?->image))
                                                <img class="rounded-circle img-fluid" src="{{ asset('images/'.$user->image) }}" style="width:150px" alt="My profile Picture">
                                        @endif
                                        <h5 class="mt-3 pb-0">{{$user->name}}</h5>
                                        <p class="text-muted mb-1 fs-6">{{$user->designation}}</p>
                                    </div>
                                </div>
                                @if(Session::has('profile_success'))
                                    <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                        <p>{{Session::get('profile_success')}}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mb-4">
                                    <label for="" class="mb-2">Change Profile Picture<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" id="picture-upload">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Name<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Name" name="name" class="form-control" value="{{ $user->name }}">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Email<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Designation<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Designation" name="designation" class="form-control" value="{{ $user->designation }}">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Phone<span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Phone" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="card border-0 shadow mb-4">
                        @if(Session::has('password_success'))
                            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                <p>{{Session::get('password_success')}}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('password.update', encrypt($user->id)) }}" method="POST"enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">Change Password</h3>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Old Password<span class="text-danger">*</span></label>
                                    <input type="password" placeholder="Old Password" class="form-control" name="old_password">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">New Password<span class="text-danger">*</span></label>
                                    <input type="password" placeholder="New Password" class="form-control" name="new_password">
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
