<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="">Home</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="">Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="">Applicants</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a class="btn btn-primary text-white" type="submit" href="{{ route('logout') }}">Log out</a>
            </li>
        </ul>
    </div>
</div>
