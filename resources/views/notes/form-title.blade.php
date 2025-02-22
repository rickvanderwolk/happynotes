<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="container">
        <form action="{{ route('note.title.store', ['note' => $item->uuid]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <textarea
                    id="titleTextarea"
                    data-cy="note-title-editor"
                    name="title"
                    class="form-control elegant-input"
                    placeholder="Title"
                    rows="3"
                    autofocus
                    required
                >{{ $item->title }}</textarea>
            </div>

            <div class="d-grid gap-2" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: auto; max-width: 400px;">
                <button data-cy="save-note" type="submit" class="btn btn-success">Save Note</button>
            </div>
        </form>
    </div>
</x-app-layout>
