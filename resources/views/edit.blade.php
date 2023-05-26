@extends('layout')
@section('bread')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('contact.index') }}">
                <i class="bi bi-house-heart h3 mb-0"></i>
            </a>
            <a href="{{ route('contact.create') }}" class="text-decoration-none btn btn-success">
                <i class="bi bi-pen h3 mb-0"></i>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card blur shadow">
        <div class="card-body">
            <div class="my-3">
                <h3>Edit Contact</h3>
            </div>
            <div class="text-center mb-3">
                <img src="{{ $contact->photo ? asset('storage/photo/' . $contact->photo) : asset('misc/user-default.png') }}"
                    class="create-thumbnail" alt="">
            </div>
            <form action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-floating mb-3">
                    <input type="text" value="{{ old('name', $contact->name) }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Name</label>
                    @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="phoneArea">
                    @foreach ($contact->phones as $phone)
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $phone) }}" name="phones[]">
                            <span class="input-group-text remove-input" id="basic-addon2"><i
                                    class="bi bi-x-circle"></i></span>
                            @error('phone')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <button type="button" id="addPhoneBtn" class="btn btn-sm btn-success text-light w-100">
                        <i class="bi bi-plus-circle me-2"></i> Add new phone
                    </button>
                </div>
                <div class="mb-3">
                    <input type="file" name="photo" class="form-control photo-input @error('photo') is-invalid @enderror"
                        id="">
                    @error('photo')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let photoInput = document.querySelector(".photo-input");
        let img = document.querySelector("img");
        photoInput.addEventListener("change", (event) => {
            let imgFile = event.target.files[0];
            let fileReader = new FileReader();
            fileReader.onload = () => {
                img.src = fileReader.result;
            }
            fileReader.readAsDataURL(imgFile);
        });

        $("#addPhoneBtn").on("click", () => {
            $(".phoneArea").append(`
            <div class="input-group mb-3">
                 <input type="text" class="form-control" placeholder="Phone number" name="phones[]">
                 <span class="input-group-text remove-input" id="basic-addon2"><i class="bi bi-x-circle"></i></span>
            </div>
            `);
        });

        $('.phoneArea').delegate(".remove-input", "click", function() {
            $(this).parent(".input-group").remove();
        })
    </script>
@endsection
