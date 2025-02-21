<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    public function run()
    {
        $emojis = ['😊', '✌️', '🎉', '🚀', '🔥', '🎯', '❤️', '😂', '🙌', '✨', '🌟', '🦄', '🥳', '👍', '👀'];
        $userIds = [1, 2];
        $notesCount = 50;
        $noteId = 3;

        foreach ($userIds as $userId) {

            for ($i = 1; $i <= $notesCount; $i++) {
                $noteEmojis = array_rand(array_flip($emojis), rand(2, 7));
                $progress = rand(1, 7) <= 5 ? null : rand(1, 100); // Toevallig 1 op de 5 tot 7 notes een progress

                Note::create([
                    'id' => $noteId,
                    'user_id' => $userId,
                    'title' => "Note {$i} - user {$userId}",
                    'body' => "Dit is de body van note {$i}.",
                    'emojis' => json_encode($noteEmojis),
                    'progress' => $progress,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $noteId++;
            }
        }
    }
}
