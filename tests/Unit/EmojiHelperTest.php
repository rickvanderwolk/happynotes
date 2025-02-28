<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\EmojiHelper;

class EmojiHelperTest extends TestCase
{
    /** @test */
    public function it_extracts_emojis_from_string(): void
    {
        $string = "Hello world 😊🌍!";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['😊', '🌍'], $result);
    }

    /** @test */
    public function it_returns_empty_array_when_no_emojis_are_present(): void
    {
        $string = "Hello world!";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals([], $result);
    }

    /** @test */
    public function it_handles_duplicate_emojis_correctly(): void
    {
        $string = "😊😊🌍🌍";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['😊', '🌍'], $result);
    }

    /** @test */
    public function it_removes_emojis_from_string(): void
    {
        $string = "Hey 👋🐸!";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Hey !", $result);
    }

    /** @test */
    public function it_retains_numbers_in_string(): void
    {
        $string = "Score: 100 🎉";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Score: 100 ", $result);
    }

    /** @test */
    public function it_handles_string_with_only_emojis(): void
    {
        $string = "💯🔥😎";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("", $result);
    }

    /** @test */
    public function it_returns_original_string_if_no_emojis_are_present(): void
    {
        $string = "Hello world!";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals($string, $result);
    }

    /** @test */
    public function it_extracts_emojis_but_not_plain_numbers(): void
    {
        $string = "I have 3 apples 🍏 and 1️⃣ banana 🍌.";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['🍏', '1️⃣', '🍌'], $result);
    }

    /** @test */
    public function it_removes_emojis_but_keeps_plain_numbers(): void
    {
        $string = "Level 10️⃣ reached in 3 days!";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Level 10 reached in 3 days!", $result);
    }

    /** @test */
    public function it_does_not_extract_plain_numbers_as_emojis(): void
    {
        $string = "123 456 789";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEmpty($result);
    }

    /** @test */
    public function it_correctly_handles_keycap_emojis(): void
    {
        $string = "Top 3️⃣ players: 1️⃣ Alice, 2️⃣ Bob, 3️⃣ Charlie.";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['3️⃣', '1️⃣', '2️⃣'], $result);
    }

    /** @test */
    public function it_removes_keycap_emojis_but_keeps_text(): void
    {
        $string = "Ranking: 1️⃣ Alice, 2️⃣ Bob, 3️⃣ Charlie.";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Ranking: 1 Alice, 2 Bob, 3 Charlie.", $result);
    }
}
