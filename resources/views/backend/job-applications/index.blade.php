@extends('frontend.layout.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                    <div class="card border-0 shadow mb-4 p-3">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                <p>{{Session::get('message')}}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body card-form">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Job Applications</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table " id="jobTable">
                                    <thead>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Employer</th>
                                    <th>Applied at</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @if($applications->isNotEmpty())
                                        @foreach($applications as $application)
                                            <tr>
                                                <td>
                                                    {{$application->job->title}}
                                                </td>
                                                <td>
                                                    {{$application->user->name}}
                                                </td>
                                                <td>
                                                    {{$application->employer->name}}
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($application->created_at)->format('d M Y')}}</td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <div>
                                                            <form action="" method="POST" style="display:inline;">
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
                            {{ $applications->links() }}
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
            $('#jobTable form').on('submit', function(event) {
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


