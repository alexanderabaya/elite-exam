<div>
    <div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary-custom text-white" wire:click='shortestWord'>Shortest Word</button>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary-custom text-white" wire:click='wordSearch'>Word Search</button>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary-custom text-white mb-3" wire:click='countTheIslands'>Count The Islands</button>

            <div class="mb-3">
                @if(count($imageArray))
                    <h6>GIVEN</h6>
                    @foreach ($imageArray as $pixel)
                        <p class="mb-0 lh-1">[{{ implode(',', $pixel) }}]</p>
                    @endforeach
                @endif
            </div>

            <div class="mb-3">
                @if(count($imageOutput))
                    <h6>OUTPUT</h6>
                    @foreach ($imageOutput as $pixel)
                        <p class="mb-0 lh-1">{{ $pixel }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
