<div class="w-50">
    <form action="{{ route('contact.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="search contacts"
                value="{{ $search }}">
            <button class="input-group-text" id="basic-addon2" type="submit">
                <i class="bi bi-search-heart"></i>
            </button>
        </div>
    </form>
</div>
