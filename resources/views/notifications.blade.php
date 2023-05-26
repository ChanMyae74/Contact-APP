@extends('layout')
@section('bread')
    <div class="mb-3">
        <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('contact.index') }}">
                <i class="bi bi-house-heart"></i>
            </a>
            <button class="btn btn-outline-danger">
                <i class="bi bi-card-list"></i>
            </button>
        </div>
    </div>
@endsection
@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="card-title">Notifications</h3>
            <a href="{{ route('notification.readAll') }}" class="btn btn-primary">
                <i class="bi bi-check-all"></i>
                <span>Mark all as read</span>
            </a>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
        </svg>
        @forelse ($notis as $noti)
            @if ($noti->read_at)
                <div class="alert alert-success d-flex align-items-center" role="alert">

                    <div class="">
                        <div class="d-flex justify-between">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                <use xlink:href="#check-circle-fill" />
                            </svg>

                            <p> {{ $noti->data['title'] }}</p>
                        </div>
                        <div>
                            <a href="{{ $noti->data['url'] }}" class="btn btn-primary">
                                <i class="bi bi-three-dots"></i>
                                <span class="text">View</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-primary d-flex align-items-center" role="alert">

                    <div class="">
                        <div class="d-flex justify-between">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                <use xlink:href="#info-fill" />
                            </svg>

                            <p> {{ $noti->data['title'] }}</p>
                        </div>
                        <div>
                            <div class="btn-group">
                                <a href="{{ route('notification.read', $noti->id) }}" class="btn btn-outline-success">
                                    <i class="bi bi-check2-circle"></i>
                                    <span class="text">Mark as read</span>
                                </a>
                                <a href="{{ $noti->data['url'] }}" class="btn btn-primary">
                                    <i class="bi bi-three-dots"></i>
                                    <span class="text">View</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @empty
            <h3>No notifications 👀</h3>
        @endforelse
    </div>
@endsection

@section('js')
    @if (session('status'))
        <x-toast />
    @endif
@endsection
