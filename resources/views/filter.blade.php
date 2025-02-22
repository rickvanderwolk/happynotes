<x-app-layout>
    @php
        $storageKey = request()->is('filter') ? 'selected_emojis' : 'excluded_emojis';
    @endphp

    <div class="container">
        <livewire:emoji-filter :storageKey="$storageKey" :updateUser="true" />
    </div>
</x-app-layout>
