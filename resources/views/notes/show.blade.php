<x-app-layout>
    <x-slot name="header"></x-slot>

    <div>
        @if($note)
            <div class="row" style="margin-top: 8px; margin-bottom: 20px">
                <div class="col-12">
                    <h1 onclick="window.location.href='{{ route('note.title.show', ['note' => $note->uuid]) }}'">{{ $note->title }}</h1>
                </div>
                <div class="col-12">
                    @if($note->progress)
                        <livewire:progress-bar :percentage="$note->progress" />
                    @endif
                </div>
                <div onclick="window.location.href='{{ route('note.emojis.show', ['note' => $note->uuid]) }}'" class="emoji-wrapper emoji-wrapper-left">
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
                        <div id="editorjs" data-note-uuid="{{ $note->uuid }}" data-save-body-url="{{ route('note.body.store', ['note' => $note->uuid]) }}" data-initial-data="{{ json_encode($note->body) }}"></div>
                        @vite('resources/js/editor.js')
                    </form>
                </div>
            </div>
        @endif
    </div>

    @livewireScripts

</x-app-layout>
