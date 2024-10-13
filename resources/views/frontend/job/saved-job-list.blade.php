@extends('frontend.layout.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Saved Jobs</li>
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
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                <p>{{Session::get('error')}}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body card-form">
                            <h3 class="fs-4 mb-1">Saved Jobs</h3>
                            <div class="table-responsive">
                                <table class="table" id="jobTable">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Saved</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($savedJobs->isNotEmpty())
                                        @foreach($savedJobs as $savedJob)
                                            <tr>
                                                <td>{{$savedJob->job->title}}
                                                    <br>
                                                    <p class="info1">{{$savedJob->job->jobType->name ." . ". $savedJob->job->location}}</p>
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($savedJob->created_at)->format('d M Y')}}</td>
                                                <td>{{ $savedJob->job->applicants->count() }}</td>
                                                <td>
                                                    @if($savedJob->job->status == 1)
                                                        <p class="badge bg-success">Active</p>
                                                    @elseif($savedJob->job->status == 2)
                                                        <p class="badge bg-warning">Pending</p>
                                                    @else
                                                        <p class="badge bg-danger">Expired</p>
                                                    @endif
                                                </td>
                                                <td><div class="btn btn-success me-2">
                                                        <a class="text-white" href="{{ route('job.detail', $savedJob->job_id) }}"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    <div class="btn btn-danger">
                                                        <a class="text-white" id="delete" href="{{ route('job.delete.saved', $savedJob->id) }}"><i class="fa fa-trash"></i></a>
                                                    </div></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            $('#jobTable').on('click', '#delete', function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var confirmMessage = "Are you sure you want to delete?";

                if (confirm(confirmMessage)) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endpush
