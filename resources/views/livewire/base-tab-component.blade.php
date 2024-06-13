<div>
    <div class="">
        <div class="tab-container">
            <div class="tab-controls-container mb-3">
                <ul>
                    <li class="pb-1 {{ $currentTab == 1 ? 'active' : '' }}" wire:click="changeTab(1)">
                        <span class="">Tab 1</span>
                    </li>

                    <li class="pb-1 {{ $currentTab == 2 ? 'active' : '' }}" wire:click="changeTab(2)">
                        <span class="">Tab 2</span>
                    </li>

                    <li class="pb-1 {{ $currentTab == 3 ? 'active' : '' }}" wire:click="changeTab(3)">
                        <span class="">Tab 3</span>
                    </li>
                </ul>
            </div>
            <div class="tab-content-container">
                <div class="tab-content-item {{ $currentTab == 1 ? 'show' : '' }}">
                    <h4 class="fw-bold">Tab 1</h4>
                </div>
                <div class="tab-content-item {{ $currentTab == 2 ? 'show' : '' }}">
                    <h4 class="fw-bold">Tab 2</h4>
                </div>
                <div class="tab-content-item {{ $currentTab == 3 ? 'show' : '' }}">
                    <h4 class="fw-bold">Tab 3</h4>
                </div>

            </div>
        </div>
    </div>
</div>
