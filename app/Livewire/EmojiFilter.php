<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class EmojiFilter extends Component
{
    public $allEmojis = [];
    public $emojis = [];
    public $storageKey;
    public $updateUser = false;

    public function mount($storageKey = null, $updateUser = false, $customEmojis = []): void
    {
        $this->storageKey = $storageKey;
        $this->updateUser = $updateUser;

        $user = Auth::user();

        $this->allEmojis = is_string($user->all_emojis)
            ? json_decode($user->all_emojis, true)
            : $user->all_emojis;
        $this->allEmojis = $this->allEmojis ?? [];

        if ($this->storageKey && $user->{$this->storageKey}) {
            $this->emojis = is_string($user->{$this->storageKey})
                ? json_decode($user->{$this->storageKey}, true)
                : $user->{$this->storageKey};
        } elseif (!$this->storageKey && !$this->updateUser) {
            $this->emojis = $customEmojis;
            if (!empty($this->emojis)) {
                $this->dispatch('emojisChanged', [$this->emojis]);
            }
        }
    }

    /**
     * @return void
     */
    public function selectEmoji($emoji)
    {
        if (in_array($emoji, $this->emojis)) {
            return;
        }

        $user = Auth::user();

        $selected = is_string($user->selected_emojis)
            ? json_decode($user->selected_emojis, true)
            : $user->selected_emojis;
        $excluded = is_string($user->excluded_emojis)
            ? json_decode($user->excluded_emojis, true)
            : $user->excluded_emojis;

        $selected = $selected ?? [];
        $excluded = $excluded ?? [];

        if ($this->storageKey === 'selected_emojis') {
            $excluded = array_filter($excluded, fn ($e) => $e !== $emoji);
            $this->emojis[] = $emoji;
        } elseif ($this->storageKey === 'excluded_emojis') {
            $selected = array_filter($selected, fn ($e) => $e !== $emoji);
            $this->emojis[] = $emoji;
        } else {
            $this->emojis[] = $emoji;
        }

        if ($this->updateUser) {
            $user->selected_emojis = $selected;
            $user->excluded_emojis = $excluded;
            if ($this->storageKey === 'selected_emojis') {
                $user->selected_emojis = $this->emojis;
            } elseif ($this->storageKey === 'excluded_emojis') {
                $user->excluded_emojis = $this->emojis;
            }
            $user->save();
        }

        $this->dispatch('emojisChanged', [$this->emojis]);
        $this->dispatch('filterUpdated');
    }

    public function deselectEmoji($emoji): void
    {
        $this->emojis = array_filter($this->emojis, fn ($e) => $e !== $emoji);

        if ($this->updateUser && $this->storageKey) {
            Auth::user()->update([
                $this->storageKey => $this->emojis
            ]);
        }
        $this->dispatch('emojisChanged', [$this->emojis]);
        $this->dispatch('filterUpdated');
    }

    public function deselectAll(): void
    {
        $this->emojis = [];

        if ($this->updateUser && $this->storageKey) {
            Auth::user()->update([
                $this->storageKey => $this->emojis
            ]);
        }
        $this->dispatch('emojisChanged', [$this->emojis]);
        $this->dispatch('filterUpdated');
    }

    public function getSelectableEmojis(): array
    {
        $user = Auth::user();

        $selected = is_string($user->selected_emojis)
            ? json_decode($user->selected_emojis, true)
            : $user->selected_emojis;
        $excluded = is_string($user->excluded_emojis)
            ? json_decode($user->excluded_emojis, true)
            : $user->excluded_emojis;

        $selected = $selected ?? [];
        $excluded = $excluded ?? [];

        return array_filter($this->allEmojis, function ($emoji) use ($selected, $excluded) {
            if ($this->storageKey === 'selected_emojis' || $this->storageKey === 'excluded_emojis') {
                return ! in_array($emoji, $selected) && ! in_array($emoji, $excluded);
            }
            return ! in_array($emoji, $this->emojis);
        });
    }

    public function render(): \Illuminate\View\View|View
    {
        return view('livewire.emoji-filter', [
            'selectableEmojis' => $this->getSelectableEmojis(),
            'currentEmojis' => $this->emojis
        ]);
    }
}
