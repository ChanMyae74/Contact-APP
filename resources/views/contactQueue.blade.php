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
        <h5>{{ $contactQueue->sender->name }} is sending you {{ $contactNumber }} contacts</h5>
        @foreach ($contacts as $c)
            <div class="card  mb-3">
                <div class="card-body">
                    <h5>{{ $c->name }}</h5>
                    <div class="d-flex">
                        @foreach ($c->phones as $p)
                            <p class="me-3">{{ $p }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        @if ($contactQueue->sender_id !== auth()->id())
            <div>
                <form action="{{ route('contact.accept', $contactQueue->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary" type="submit">Accept</button>
                    <a href="{{ route('contact.deny', $contactQueue->id) }}" class="btn btn-outline-danger">Reject</a>
                </form>

            </div>
        @else
            <a href="" class="btn btn-outline-danger">Cancel</a>
        @endif
    </div>
@endsection

@section('js')
    @if (session('status'))
        <x-toast />
    @endif
@endsection
