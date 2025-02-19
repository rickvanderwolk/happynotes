<x-app-layout>
    <x-slot name="header"></x-slot>

    <div>
        @if($note)
            <div class="row" style="margin-top: 8px; margin-bottom: 20px">
                <div class="col-12">
                    <h1 onclick="window.location.href='{{ route('note.title.show', ['id' => $note->id]) }}'">{{ $note->title }}</h1>
                </div>
                <div class="col-12">
                    @if($note->progress)
                        <livewire:progress-bar :percentage="$note->progress" />
                    @endif
                </div>
                <div onclick="window.location.href='{{ route('note.emojis.show', ['id' => $note->id]) }}'" class="emoji-wrapper emoji-wrapper-left no-invert">
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
                    <form id="postForm" action="{{ route('note.body.store', ['id' => $note->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" id="body" name="body">
                        <div id="editorjs" data-note-id="{{ $note->id }}" data-save-body-url="{{ route('note.body.store', ['id' => $note->id]) }}" data-initial-data="{{ json_encode($note->body) }}"></div>
                        @vite('resources/js/editor.js')
                    </form>
                </div>
            </div>
        @endif
    </div>

    @livewireScripts

</x-app-layout>
