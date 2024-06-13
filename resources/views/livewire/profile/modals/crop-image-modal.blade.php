<div class="modal fade" id="crop-image-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0 border-bottom-0">
                <h4 class="modal-title fw-semibold">Crop Image</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetCropper"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex mx-5">
                    <div class="col-12">
                      <div class="img-container">
                        <div class="w-100 overflow-hidden mx-auto" style="height: 20rem;" wire:ignore>
                            <img id="image-cropping-area" class="" src="">
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center">
                <div>
                    <button type="button" class="btn btn-secondary text-white me-3" data-bs-dismiss="modal" wire:click="resetCropper">Cancel</button>
                    <button type="button" class="btn btn-primary-custom text-white" wire:click="cropPhoto">Crop</button>
                </div>
            </div>
        </div>
    </div>
</div>
