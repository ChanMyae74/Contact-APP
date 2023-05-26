<div class="modal fade" tabindex="-1" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send to user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Enter receiver's email address</p>
                <form action="{{ route('sendContact') }}" method="POST">
                    @csrf
                    {{-- <div class="d-flex">
                        <div class="mb-3">
                            <label for="share">Share</label>
                            <input id="share" type="radio" value="share" name="selectAction[]" class="form-check-inline"
                                id="">
                        </div>
                        <div class="mb-3">
                            <label for="send">Send</label>
                            <input id="send" type="radio" value="send" name="selectAction[]" class="form-check-inline"
                                id="">
                        </div>
                    </div> --}}
                    <div class="hide-input"></div>
                    <div class="input-group mb-3">
                        <input type="email" required class="form-control" placeholder="Recipient's username"
                            name="receiver_email">
                        <button class="btn btn-success"><i class="bi bi-send-plus text-light"></i></button>
                    </div>
                    <div>
                        <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
