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
}
