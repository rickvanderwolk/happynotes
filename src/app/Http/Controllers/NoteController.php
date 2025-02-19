<?php

namespace App\Http\Controllers;

use App\Helpers\EmojiHelper;
use app\Helpers\ProgressHelper;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $selectedEmojis = json_decode(Auth::user()->selected_emojis, true) ?? [];
        $excludedEmojis = json_decode(Auth::user()->excluded_emojis, true) ?? [];
        $searchQuery = $user->search_query;
        $searchQueryOnly = $user->search_query_only;

        $notes = Note::query();

        if (!empty($searchQuery)) {
            $notes->where(function ($query) use ($searchQuery) {
                $query->where('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('body', 'LIKE', "%{$searchQuery}%");
            });
        }

        if (empty($searchQuery) || !$searchQueryOnly) {
            foreach ($selectedEmojis as $emoji) {
                $notes->whereJsonContains('emojis', $emoji);
            }
            foreach ($excludedEmojis as $emoji) {
                $notes->whereJsonDoesntContain('emojis', $emoji);
            }
        }

        $notes = $notes->orderBy('updated_at', 'DESC')->paginate(15);

        return view('dashboard', compact('notes'));
    }

    public function show($id)
    {
        $note = Note::where(['id' => $id])->firstOrFail();
        $note->body = json_decode($note->body, true);
        return view('notes.show', compact('note'));
    }

    public function create()
    {
        return view('new');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'selectedEmojis' => 'nullable|string',
        ]);

        $selectedEmojis = json_decode($request->input('selectedEmojis', '[]'), true);
        $selectedEmojis = collect($selectedEmojis)->flatten()->unique()->values()->toArray();

        $emojisInTitle = EmojiHelper::getEmojisFromString($data['title']);
        $selectedEmojis = array_merge($selectedEmojis ?? [], $emojisInTitle);

        $selectedEmojis = array_unique($selectedEmojis);

        $note = new Note();
        $note->user_id = Auth::id();
        $note->title = EmojiHelper::getStringWithoutEmojis($data['title']);
        $note->emojis = json_encode($selectedEmojis, JSON_UNESCAPED_UNICODE);
        $note->save();

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $item = Note::findOrFail($id);
        $item->delete();
        return redirect()->route('dashboard');
    }

    public function formTitle($id)
    {
        $item = Note::find($id);
        return view('notes.form-title', [
            'item' => $item,
        ]);
    }

    public function storeTitle(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
        ]);

        $note = Note::find($id);

        $selectedEmojis = $note->emojis ?? [];
        $selectedEmojis = collect($selectedEmojis)->flatten()->unique()->values()->toArray();
        $emojisInTitle = EmojiHelper::getEmojisFromString($data['title']);
        $selectedEmojis = array_merge($selectedEmojis ?? [], $emojisInTitle);
        $selectedEmojis = array_unique($selectedEmojis);

        $note->title = EmojiHelper::getStringWithoutEmojis($data['title']);
        $note->emojis = json_encode($selectedEmojis, JSON_UNESCAPED_UNICODE);
        $note->save();

        return redirect()->route('note.show', ['id' => $id]);
    }

    public function formEmojis($id)
    {
        $item = Note::find($id);
        return view('notes.form-emojis', [
            'item' => $item,
        ]);
    }

    public function storeEmojis(Request $request, $id)
    {
        $item = Note::find($id);
        $selectedEmojis = json_decode($request->input('selectedEmojis', '[]'), true);
        $selectedEmojis = collect($selectedEmojis)->flatten()->unique()->values()->toArray();
        $item->emojis = json_encode($selectedEmojis, JSON_UNESCAPED_UNICODE);
        $item->save();
        return redirect()->route('note.show', ['id' => $id]);
    }

    public function storeBody(Request $request, $id)
    {
        $body = $request->input('body');

        $note = Note::find($id);

        if (empty($body)) {
            $note->body = null;
            $note->progress = null;
        } else {
            $selectedEmojis = $note->emojis ?? [];
            $selectedEmojis = collect($selectedEmojis)->flatten()->unique()->values()->toArray();
            if (!empty($body['blocks'])) {
                $bodyContent = array_map(fn($block) => $block['data']['text'] ?? '', $body['blocks']);
                $bodyContent = implode(" ", $bodyContent);
                $emojisInBody = EmojiHelper::getEmojisFromString($bodyContent);
                $selectedEmojis = array_merge($selectedEmojis ?? [], $emojisInBody);
            }
            $selectedEmojis = array_unique($selectedEmojis);

            $note->body = json_encode($body, JSON_UNESCAPED_UNICODE);
            $note->emojis = json_encode($selectedEmojis, JSON_UNESCAPED_UNICODE);
            $note->progress = ProgressHelper::getProgressFromNoteBody($body);
        }

        $note->save();

        return redirect()->route('note.show', ['id' => $id]);
    }
}
