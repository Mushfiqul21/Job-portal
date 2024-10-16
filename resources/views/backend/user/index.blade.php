@extends('frontend.layout.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                    <div class="card border-0 shadow mb-4 p-3">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                <p>{{Session::get('message')}}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            @if(Session::has('error-message'))
                                <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                    <p>{{Session::get('error-message')}}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Users</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table " id="userTable">
                                    <thead>
                                    <th>ID</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @if($users->isNotEmpty())
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    {{$user->id}}
                                                </td>
                                                <td>
                                                    <img class="rounded-pill" src="{{asset('images/'.$user->image)}}" alt="" style="width:50px; height: 35px;">
                                                </td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    {{$user->phone}}
                                                </td>
                                                <td>
                                                    <div class="d-flex ms-3">
                                                        <div class="btn btn-success me-2">
                                                            <a class="text-white" href="{{ route('users.view', encrypt($user->id)) }}"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <div>
                                                            <form action="{{ route('users.delete', encrypt($user->id)) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#userTable form').on('submit', function(event) {
                event.preventDefault();
                var confirmMessage = "Are you sure you want to delete this user?";
                if (confirm(confirmMessage)) {
                    this.submit();
                } else {
                    return false;
                }
            });
        });


    </script>
@endpush

