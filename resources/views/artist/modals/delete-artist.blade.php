<div class="modal fade" id="delete-artist" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('artist.delete') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title fw-semibold">Delete Artist</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mx-3">
                    <div class="text-center">
                        <input type="hidden" name="id" id="artist-id-input">
                        <p>Are you sure you want to delete <b id="artist-name"></b>? and all of its <b>album</b> will be <b>deleted</b> as well.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center">
                <div>
                    <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" >Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
