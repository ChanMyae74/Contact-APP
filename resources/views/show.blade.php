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
        <div class="card shadow blur">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ $contact->photo ? asset('storage/photo/' . $contact->photo) : asset('misc/user-default.png') }}"
                                class="index-thumbnail" alt="" />
                        </div>
                        <div class="">
                            <h3 class="my-3">
                                <i class="bi bi-card-text text-primary me-3"></i>
                                {{ $contact->name }}
                            </h3>
                            @foreach ($contact->phones as $phone)
                                <p>
                                    <i class="bi bi-telephone text-success h3 me-3"></i>
                                    {{ $phone }}
                                </p>
                            @endforeach
                            <a href="tel:{{ $contact->phone }}" class="btn btn-outline-success p-3 text-decoration-none">
                                <span class="p-2 bg-success rounded-circle text-light me-3">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                Call Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
