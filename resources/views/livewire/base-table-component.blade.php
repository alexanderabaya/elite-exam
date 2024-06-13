<div>
    {{-- When Using this component don't forget to include the table.css in main blade --}}
    <h4 class="mb-3">List of Companies</h4>
    <div class="table-controls d-flex justify-content-between mb-3">
        <div class="align-self-center">
            <div class="form-group d-flex">
                <label for="" class="align-self-center me-2">
                   Show
                </label>
                <select name=""  class="form-select form-select-sm entry-input" wire:model.live="paginate">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label for="" class="align-self-center ms-2">
                    entries
                 </label>
            </div>
        </div>
        <div class="d-flex justify-content-end align-self-end">
            <div class="me-2">
                <input type="text" class="form-control" placeholder="Quick Search" wire:model.live.debounce.250ms="search">
            </div>
            <div class="align-self-center">
                <a href="" class="btn btn-primary-custom text-white">
                    <i class="fa-solid fa-plus me-2"></i>
                    Control Button
                </a>
            </div>
        </div>
    </div>



    <div class="table-container">
        <table class="table table-borderless mb-2 w-100">
            <thead class="" >
                <tr>
                    <x-table-heading displayName="User" tableName="name" sortBy="{{ $sortBy }}" sortDirection="{{ $sortDirection }}" />
                    <x-table-heading displayName="Column" tableName="companies.companyName" sortBy="{{ $sortBy }}" sortDirection="{{ $sortDirection }}" />
                    <x-table-heading displayName="Column" tableName="email" sortBy="{{ $sortBy }}" sortDirection="{{ $sortDirection }}" />
                    <x-table-heading displayName="Type" tableName="type" sortBy="{{ $sortBy }}" sortDirection="{{ $sortDirection }}" />
                    <x-table-heading displayName="Status" tableName="status" sortBy="{{ $sortBy }}" sortDirection="{{ $sortDirection }}" />
                    <th class="px-5 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if ($dataCount)
                    @forelse ($dataName as $dataName )
                        <tr>
                            <td>
                                <div class="user-data-container d-flex align-items-center">
                                    <img src="{{ asset('assets/images/user.png') }}" alt="">
                                    <div class="user-data-content ms-2">
                                        <span class="user-data-name">Alexander Dale Abaya </span>
                                        <span class="user-data-id">Alexander Dale Abaya </span>
                                    </div>
                                </div>
                            </td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td class=" type-data text-center p-0">
                                <span class="type-container text-white">Barangay ID</span>
                            </td>
                            <td class=" status-data text-center p-0">
                                <span class="status-container bg-warning text-white">Pending</span>
                            </td>
                            <td class="fit-to-cell">
                               <div class="d-flex justify-content-center fs-5">
                                    <a href="" class="text-dark" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="" class="text-dark ms-3" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"> </i>
                                    </a>

                                    <a href="" class="text-dark ms-3" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No results on "<b>{{ $search }}</b>"
                            </td>
                        </tr>
                    @endforelse
                @else
                    <tr>
                        <td colspan="6" class="text-center">
                            No Data Available
                        </td>
                    </tr>
                @endif --}}
            </tbody>
        </table>

    </div>

    {{-- <div class="">
        {{ $dataName->links(data: ['scrollTo' => false]) }}
    </div> --}}
</div>
