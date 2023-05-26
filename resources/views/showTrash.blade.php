@extends('layout')
@section('bread')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('contact.index') }}">
                <i class="bi bi-house-heart h3 mb-0"></i>
            </a>
            <a href="{{ route('contact.create') }}" class="text-decoration-none btn btn-danger">
                <i class="bi bi-trash2 h3 mb-0"></i>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h4>Trash Bin <i class="bi bi-trash2-fill text-danger"></i></h4>
        <span class="condition-btn d-none animate__animated animate__fadeIn">
            <p class="count-item mb-0 fw-bold"></p>
        </span>
    </div>
    <div class="condition-btn d-none animate__animated animate__fadeIn w-75">
        <div class="d-flex justify-content-between align-items-center">
            <select name="action" id="" class="form-select" form="checkForm">
                <option value="delete">Permanent Delete</option>
                <option value="restore">Restore</option>
            </select>
            <button type="submit" form="checkForm" class="btn btn-primary ms-3">
                Done
            </button>
        </div>
    </div>
    <div class="d-none">
        <form action="{{ route('bulkAction') }}" id="checkForm" method="POST">
            @method("delete")
            @csrf
        </form>
    </div>
    @forelse ($contacts as $contact)
        <x-phone-card :contact="$contact" showLink="hide" showAction="hide" />
    @empty
        <div class="card blur shadow">
            <div class="card-body">
                <p class="fw-bold"> No Contacts in trash</p>
            </div>
        </div>
    @endforelse
@endsection

@section('js')
    @if (session('status'))
        @include('./plugin/swal')
    @endif
    <script>
        let checks = document.querySelectorAll(".form-check-input");
        checks.forEach((c) => {
            c.addEventListener("change", () => {
                $(".condition-btn").removeClass("d-none animate__fadeOut");
                $(".condition-btn").addClass("d-inline-block animate__fadeIn");
                $('.count-item').html(
                    `${$('.checkBox:checked').length} contact${$('.checkBox:checked').length>1 ? "s" : ""} selected</span>`
                )
                $('.checkBox:checked').length == 0 && $(".condition-btn")
                    .removeClass("animate__fadeIn d-inline-block")
                    .addClass("animate__fadeOut d-none");
            })
        })
    </script>
@endsection
