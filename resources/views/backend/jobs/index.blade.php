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
                                    <h3 class="fs-4 mb-1">My Jobs</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table " id="jobTable">
                                    <thead>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Created By</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>isFeatured</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @if($jobs->isNotEmpty())
                                        @foreach($jobs as $job)
                                            <tr>
                                                <td>
                                                    {{$job->id}}
                                                </td>
                                                <td>
                                                    {{$job->title}}
                                                    <p>Applicants: {{$job->applicants->count()}}</p>
                                                </td>
                                                <td>
                                                    {{$job->user->name}}
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($job->created_at)->format('d M Y')}}</td>
                                                <td>
                                                    @if($job->status == 1)
                                                        <p class="badge bg-success">Active</p>
                                                    @else
                                                        <p class="badge bg-danger">InActive</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($job->isFeatured == 1)
                                                        <p class="badge bg-success">Featured</p>
                                                    @else
                                                        <p class="badge bg-danger">Not Featured</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <div class="btn btn-info me-2">
                                                            <a class="text-white" href="{{ route('job.detail', $job->id) }}"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <div class="btn btn-success me-2">
                                                            <a class="text-white edit-job" href="javascript:void(0);" data-id="{{$job->id}}" data-status="{{$job->status}}" data-isFeatured="{{$job->isFeatured}}" data-bs-toggle="modal" data-bs-target="#editJobModal">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                        </div>
                                                        <div>
                                                            <form action="{{route('admin.jobs.delete', $job->id)}}" method="POST" style="display:inline;">
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
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Job Modal -->
        <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJobModalLabel">Edit Job</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editJobForm" action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                            @csrf
                            <!-- Hidden field to store the Job ID -->
                            <input type="hidden" name="job_id" id="editJobId">

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="editStatus" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="isFeatured" class="form-label">Featured</label>
                                <select class="form-select" id="editIsFeatured" name="isFeatured">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
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
        $(function(){
            $(document).on('click', '.edit-job', function() {
                var jobId = $(this).data('id');
                var jobStatus = $(this).data('status');
                var isFeatured = $(this).data('isfeatured');
                $('#editJobId').val(jobId);
                $('#editStatus').val(jobStatus);
                $('#editIsFeatured').val(isFeatured);
                $('#editJobForm').attr('action', '/admin/jobs/update/' + jobId);
            });
        });
    </script>
@endpush

