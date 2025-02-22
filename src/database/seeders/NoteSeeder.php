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
        $users = [
          ['id' => 1, 'first_note_uuid' => 'df6da9cb-9160-4a40-ae21-f041a79bca2c'],
          ['id' => 2, 'first_note_uuid' => 'b161a8a7-82c3-4ef3-aab2-27aad88b0024'],
        ];
        $notesCount = 50;

        foreach ($users as $user) {

            for ($i = 1; $i <= $notesCount; $i++) {
                if ($i === 1) {
                    $noteUuid = $user['first_note_uuid'];
                } else {
                    $noteUuid = null;
                }
                $noteEmojis = array_rand(array_flip($emojis), rand(2, 7));
                $progress = rand(1, 7) <= 5 ? null : rand(1, 100);

                Note::create([
                    'uuid' => $noteUuid,
                    'user_id' => $user['id'],
                    'title' => "Note {$i} - user {$user['id']}",
                    'body' => "Dit is de body van note {$i}.",
                    'emojis' => json_encode($noteEmojis),
                    'progress' => $progress,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
