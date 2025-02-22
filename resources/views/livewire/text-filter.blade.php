<div>
    <div class="form-check form-switch">
        <input wire:model.live="search_query_only" class="form-check-input" type="checkbox" id="customSwitch">
        <label class="form-check-label" for="customSwitch">Ignore other filters</label>
    </div>
    <input type="text" wire:model.live="search_query" class="form-control elegant-input" placeholder="Search..." autofocus>
</div>
