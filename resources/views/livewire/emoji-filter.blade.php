<div wire:keydown.window.backspace="deselectAll">
    <div class="emoji-wrapper emoji-wrapper-xl no-invert">
        <div class="row text-center">
            @foreach($currentEmojis as $emoji)
                <div class="emoji col-2 text-center" wire:click="deselectEmoji('{{ $emoji }}')" style="cursor: pointer;">
                    {{ $emoji }}
                </div>
            @endforeach
        </div>

        @if(!empty($currentEmojis))
            <hr>
        @endif

        <div class="row text-center">
            @foreach($selectableEmojis as $emoji)
                <span class="emoji col-2 text-center" wire:click="selectEmoji('{{ $emoji }}')" style="cursor: pointer;">
                    {{ $emoji }}
                </span>
            @endforeach
        </div>
    </div>
</div>
