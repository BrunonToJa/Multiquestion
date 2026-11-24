<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quiz = Quiz::create([
            'title' => 'Podstawy PHP',
            'description' => 'PHP teścik',
        ]);

        $data = [
            'Który symbol oznacza zmienną w PHP?' => [['$', true], ['@', false], ['#', false]],
            'Która funkcja wypisuje tekst?' => [['echo', true], ['print_all', false], ['write_out', false]],
        ];

        foreach ($data as $text => $answers) {
            $question = $quiz->questions()->create(['content' => $text]);
            foreach ($answers as [$content, $correct]) {
                $question->answers()->create(['content' => $content, 'is_correct' => $correct]);
            }
        }
    }
}