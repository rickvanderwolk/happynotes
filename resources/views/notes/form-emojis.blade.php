<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="container">
        <form action="{{ route('note.emojis.store', ['note' => $item->uuid]) }}" method="POST">
            @csrf

            <livewire:emoji-filter
                :storageKey="null"
                :updateUser="false"
                :customEmojis="$item->emojis"
            />

            <input type="hidden" name="selectedEmojis" id="selectedEmojis">

            <div class="d-grid gap-2" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: auto; max-width: 400px;">
                <button type="submit" class="btn btn-success">Save Note</button>
            </div>
        </form>
    </div>

    @livewireScripts
</x-app-layout>
