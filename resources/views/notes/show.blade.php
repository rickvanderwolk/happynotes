<x-app-layout>
    <x-slot name="header"></x-slot>

    <div>
        @if($note)
            <div class="row" style="margin-top: 8px; margin-bottom: 20px">
                <div class="col-12">
                    <h1 data-cy="note-title" onclick="window.location.href='{{ route('note.title.show', ['note' => $note->uuid]) }}'">{{ $note->title }}</h1>
                </div>
                <div data-cy="note-progress-bar" class="col-12">
                    <livewire:progress-bar :idNote="$note->id" />
                </div>
                <div data-cy="note-emoji-wrapper" onclick="window.location.href='{{ route('note.emojis.show', ['note' => $note->uuid]) }}'" class="emoji-wrapper emoji-wrapper-left">
                    @foreach($note->emojis as $emojiIndex => $emoji)
                        <span class="emoji">{{ $emoji }}</span>
                    @endforeach
                </div>

                <div class="col-12">
                    <div id="toc-container" style="display: none;">
                        <ul id="toc"></ul>
                    </div>
                </div>

                <div class="col-12">
                    <form id="postForm" action="{{ route('note.body.store', ['note' => $note->uuid]) }}" method="POST">
                        @csrf
                        <input type="hidden" id="body" name="body">
                        <div id="editorjs" data-cy="note-body" data-note-uuid="{{ $note->uuid }}" data-save-body-url="{{ route('note.body.store', ['note' => $note->uuid]) }}" data-initial-data="{{ json_encode($note->body) }}"></div>
                        @vite('resources/js/editor.js')
                    </form>
                </div>
            </div>
        @endif
    </div>

    @livewireScripts

</x-app-layout>
