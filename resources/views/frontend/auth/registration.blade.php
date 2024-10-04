@extends('frontend.layout.app')

@section('main')

    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        <form action="" id="registrationForm">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="mb-2">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please Confirm Password">
                                <p></p>
                            </div>
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a  href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $("#registrationForm").submit(function(e){
                e.preventDefault();

                let name = $('#name').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let confirm_password = $('#confirm_password').val();



                $.ajax({
                    url: '{{route('registration.post')}}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        password: password,
                        confirm_password: confirm_password,
                    },
                    dataType: 'json',
                    success: function(response){
                        if(response.status == true){
                            console.log(10);
                            window.location.href = "{{ route('login') }}";
                        }else{
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.log("Error response:", xhr);  // Log the error response
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "An error occurred";
                        alert("Error: " + errorMessage);
                    }
                });
            })
        });
    </script>
@endpush
