<x-app-layout>
    <x-slot name="header"></x-slot>

    <meta name="notes-url" content="{{ url('/') }}">

    <div>
        @if(isset($notes) && $notes->count() > 0)
            <div id="note-list" class="list-group">
                @foreach($notes as $note)
                    <div
                        id="note-{{ $note->uuid }}"
                        class="list-group-item"
                        onclick="window.location.href='{{ route('note.show', $note->uuid) }}'"
                        style="cursor: pointer;"
                    >
                        {{ $note->title }}

                        @if($note->progress)
                            <livewire:progress-bar :percentage="$note->progress" />
                        @endif

                        @if(!empty($note->emojis))
                            <div class="emoji-wrapper">
                                @foreach($note->emojis as $emoji)
                                    <span class="emoji">{{ $emoji }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <!-- Laadaanwijzing -->
            <div id="loading" style="display: none; text-align: center; padding: 10px;">Loading more notes...</div>
            <div style="display: none;">
                {{ $notes->links() }}
            </div>
        @else
            <div>No notes found</div>
        @endif
    </div>
</x-app-layout>
