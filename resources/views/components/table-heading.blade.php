<div>
    <th class="cursor-pointer {{ $sortBy == $tableName ? 'sorting' : '' }} {!! $attributes->whereStartsWith('class')->first() !!}" wire:click="sortTable('{{ $tableName }}')">
        {{ $displayName }}
        <div class="d-inline-block">
            <div>
                <div class="d-flex flex-column ">
                        @if ($sortBy == $tableName)
                            @if ($sortDirection == 'asc')
                                <i class="fa-solid fa-sort-up sort-active"></i>
                                <i class="fa-solid fa-sort-down sort-inactive"></i>
                            @else
                                <i class="fa-solid fa-sort-up sort-inactive"></i>
                                <i class="fa-solid fa-sort-down sort-active"></i>
                            @endif
                        @else
                            <i class="fa-solid fa-sort-up sort-inactive"></i>
                            <i class="fa-solid fa-sort-down sort-inactive"></i>
                        @endif
                </div>
            </div>

        </div>
    </th>
</div>
