@extends('frontend.layout.app')

@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                            <select name="sort" id="sort" class="form-control">
                                <option value="1" {{(Request::get('sort') == '1') ? 'selected':''}}>Latest</option>
                                <option value="0" {{(Request::get('sort') == '0') ? 'selected':''}}>Oldest</option>
                            </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" placeholder="Keywords" class="form-control" id="keyword" name="keywords" value="{{ Request::get('keyword') }}">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" placeholder="Location" class="form-control" id="location" name="location" value="{{ Request::get('location') }}">
                            </div>

                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <option {{(Request::get('category')==$category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>Job Type</h2>
                                @if($jobTypes->isNotEmpty())
                                    @foreach($jobTypes as $jobType)
                                        <div class="form-check mb-2">
                                            <input {{(in_array($jobType->id, $jobTypeArray)) ? 'checked' : '' }} class="form-check-input " name="job_type" type="checkbox" value="{{$jobType->id}}" id="job_type_{{$jobType->id}}">
                                            <label class="form-check-label " for="job_type_{{$jobType->id}}">{{$jobType->name}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <button class="btn btn-primary" type="submit">Search</button>
                            <a class="btn btn-secondary mt-3" href="{{route('job.jobs')}}">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if($jobs->isNotEmpty())
                                    @foreach($jobs as $job)
                                        <div class="col-md-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{$job->title}}</h3>
                                                    <p>{{ Str::words($job->description, 5) }}</p>
                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{$job->location}}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1">{{$job->jobType->name}}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{$job->salary}}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder">Keywords:</span>
                                                            <span class="ps-1">{{$job->keywords}}</span>
                                                            <p>{{$job->category->name}}</p>
                                                        </p>
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('job.detail',$job->id) }}" class="btn btn-primary btn-lg">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-warning">
                                        No Job Found
                                    </div>
                                @endif
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
        $('#searchForm').submit(function(e){
            e.preventDefault();

            let url = '{{route("job.jobs")}}?';
            let keyword = $("#keyword").val();
            let location = $("#location").val();
            let category = $("#category").val();
            let sort = $('#sort').val();

            let checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function(){
                return $(this).val();
            }).get();


            if(keyword != ""){
                url += '&keyword='+keyword;
            }

            if(location != ""){
                url += '&location='+location;
            }

            if(category != ""){
                url += '&category='+category;
            }

            if(checkedJobTypes.length > 0){
                url += '&jobType='+checkedJobTypes;
            }

            url += '&sort='+sort;

            window.location.href = url;
        });

        $("#sort").change(function(){
            $('#searchForm').submit();
        });
    </script>
@endpush
