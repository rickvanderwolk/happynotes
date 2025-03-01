<x-app-layout>
    <x-slot name="header"></x-slot>

    <meta name="notes-url" content="{{ url('/') }}">

    <div class="container">
        <form action="{{ route('note.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <textarea
                    name="title"
                    data-cy="new-note-title"
                    class="form-control elegant-input"
                    placeholder="Title"
                    rows="3"
                    autofocus
                    required
                ></textarea>
            </div>

            <livewire:emoji-filter
                :storageKey="null"
                :updateUser="false"
            />

            <input type="hidden" name="selectedEmojis" id="selectedEmojis">

            <div class="d-grid gap-2" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: auto; max-width: 400px;">
                <button data-cy="save-new-note" type="submit" class="btn btn-success">Save Note</button>
            </div>
        </form>
    </div>

    @livewireScripts
</x-app-layout>
