@extends('layout')
@section('bread')
    <div class=" d-flex justify-content-between align-items-center">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{ route('contact.index') }}">
                <i class="bi bi-house-heart h3 mb-0"></i>
            </a>
            <a href="{{ route('contact.create') }}" class="text-decoration-none btn btn-outline-primary">
                <i class="bi bi-plus-circle h3 mb-0"></i>
            </a>
        </div>
        <x-profile />
    </div>
@endsection
@section('content')
    <div class="d-none">
        <form action="{{ route('bulkDelete') }}" id="checkForm" method="POST">
            @method('delete')
            @csrf
        </form>
    </div>
    <x-send-modal />

    <div class="ms-md-3">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('showTrash') }}" class="btn btn-outline-danger my-2 p-2 p-md-3 text-decoration-none">
                <span class="p-1 p-md-2 bg-danger rounded-circle text-light me-3">
                    <i class="bi bi-trash"></i>
                </span>
                <span class="text-black"> Trash contacts</span>
            </a>
            <a href="{{ route('notifications') }}" class="btn btn-primary position-relative">
                Unread notifications
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ Auth::user()->unreadNotifications->count() }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
        </div>
    </div>

    <div class="card shadow blur">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-black text-nowrap">Contact List</h3>
                <x-search search="{{ $search }}" />
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-between align-items-center my-2 p-del-btn d-none animate__animated animate__fadeIn">
        <button type="submit" form="checkForm" class="btn btn-danger ">
            <p class="mb-0 small trash-text"></p>
        </button>
        <div>
            <button class="btn btn-success text-light send-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                <span>Send</span>
                <i class="bi bi-send"></i>
            </button>
        </div>
    </div>
    <div>
        @forelse ($contacts as $contact)
            <x-phone-card :contact="$contact" showLink="show" showAction="show" />
        @empty
            <p class="fw-bold my-3">No contact available</p>
        @endforelse
    </div>
@endsection
@section('js')
    @if (session('status'))
        <x-toast />
    @endif
    <script>
        let checks = document.querySelectorAll(".form-check-input");
        checks.forEach((c) => {
            c.addEventListener("change", () => {
                $(".p-del-btn").removeClass("d-none animate__fadeOut");
                $(".p-del-btn").addClass("d-inline-block animate__fadeIn");
                $('.trash-text').html(
                    `Move to trash 
                    <span class="fw-bold">${$('.checkBox:checked').length} contact${$('.checkBox:checked').length>1 ? "s" : ""}</span>
                    <i class="bi bi-trash2 ms-2 h4"></i>
                    `
                )
                if ($('.checkBox:checked').length == 0) {
                    $(".p-del-btn")
                        .removeClass("animate__fadeIn d-inline-block")
                        .addClass("animate__fadeOut d-none");
                }


            })
        })
        $(".send-btn").on("click", () => {
            $(".hide-input").html("");
            $('.checkBox:checked').each((key, value) => {
                $(".hide-input").append(
                    `<input type="hidden" value="${value.value}" class="hide-input-contact-id" name="contact_ids[]">`
                );
            });
            // $(".hide-input-contact-id").attr("value", $('.checkBox:checked')[0].value)
            // <input type="hidden" value="1" class="hide-input-contact-id" name="contact_id[]">
        });
    </script>
@endsection
