<div class="d-flex justify-content-between mb-2 align-items-center">
    <h3 class="mb-0 me-2">Welcome {{ Auth::user()->name }}</h3>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="btn btn-danger">
            Logout
            <i class="bi bi-box-arrow-right"></i>
        </button>
    </form>
</div>
