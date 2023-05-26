<div class="card my-2 my-md-3 mx-3 shadow me-4 rounded blur contact-list">
    <div class="card-body">
        <div
            class="d-flex @if ($showAction === 'show') justify-content-between
            @else
            justify-content-around @endif align-items-center">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input checkBox" name="bulkChecks[]" type="checkbox" id="inlineCheckbox1"
                        form="checkForm" value="{{ $contact->id }}">
                </div>
                <div>
                    <img src="{{ $contact->photo ? asset('storage/photo/' . $contact->photo) : asset('misc/user-default.png') }}"
                        class="index-thumbnail" alt="" />
                </div>
            </div>

            <div class="d-flex justify-content-start align-items-start align-items-md-center flex-md-row flex-column">
                @if ($showLink === 'show')
                    <a href="{{ route('contact.show', $contact->id) }}" class="text-decoration-none">
                        <div class="p-md-2">
                            <h5 class="text-black">{{ Str::substr($contact->name, 0, 15) }}</h5>
                            <p class=" text-black">{{ $contact->phones[0] }}</p>
                        </div>
                    </a>
                @else
                    <div class="p-md-2">
                        <h5 class="text-black">{{ Str::substr($contact->name, 0, 15) }}</h5>
                        <p class=" text-black">{{ $contact->phone }}</p>
                    </div>
                @endif

                <div class="">
                    <a href="tel:{{ $contact->phone }}"
                        class="btn btn-outline-success p-2 p-md-3 text-decoration-none">

                        <span class="text-nowrap">
                            <span class="p-1 p-md-2 bg-success rounded-circle text-light me-3">
                                <i class="bi bi-telephone"></i>
                            </span>Call</span>
                    </a>
                </div>
            </div>
            @if ($showAction === 'show')
                <div class="to-right-icons">
                    <div
                        class="mb-2 p-3 p-md-4 bg-primary border text-light d-flex justify-content-center align-items-center icon-rounded">
                        <a href="{{ route('contact.edit', $contact->id) }}">
                            <i class="bi bi-pen text-light"></i>
                        </a>
                    </div>
                    {{-- <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="icon-rounded">
                        @method('delete')
                        @csrf
                        <button
                            class="btn btn-danger icon-rounded d-flex justify-content-center p-3 p-md-4  align-items-center">
                            <span> <i class="bi bi-trash"></i></span>
                        </button>
                    </form> --}}
                </div>
            @endif
        </div>
    </div>
</div>
