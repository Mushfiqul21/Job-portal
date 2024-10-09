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
                        <form action="{{route('job.update', encrypt($job->id))}}" method="post" id="createJob" autocomplete="on">
                            @csrf
                            <div class="card-body card-form p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="fs-4 mb-1">Edit Job Details</h3>
                                    <a class="btn btn-outline-primary" href="{{route('job.show')}}">Back</a>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title" class="form-control" value="{{ $job?->title }}">
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option selected disabled>Select a Category</option>

                                            @if($categories->isNotEmpty())
                                                @foreach($categories as $category)
                                                    <option {{($job->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select class="form-select" name="job_type">
                                            <option selected disabled>Select Job Type</option>

                                            @if($jobTypes->isNotEmpty())
                                                @foreach($jobTypes as $jobType)
                                                    <option  {{($job->job_type_id == $jobType->id) ? 'selected' : ''}} value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control" value="{{ $job?->vacancy }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control" value="{{ $job?->salary }}">
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="location" id="location" name="location" class="form-control" value="{{ $job?->location }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{!! $job?->description !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{!! $job?->benefits !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{!! $job?->responsibility !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{!! $job?->qualifications !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Requirements</label>
                                    <textarea class="form-control" name="requirements" id="requirements" cols="5" rows="5" placeholder="Requirements">{!! $job?->requirements !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control" value="{{ $job?->keywords }}">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience</label>
                                    <input type="text" placeholder="Experience" id="experience" name="experience" class="form-control" value="{{ $job?->experience }}">
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control" value="{{ $job?->company_name }}">
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="location" name="company_location" class="form-control" value="{{ $job?->company_location }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="company_website" class="form-control" value="{{ $job?->company_website }}">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update Job</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


