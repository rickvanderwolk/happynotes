<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Helpers\EmojiHelper;

class EmojiHelperTest extends TestCase
{
    #[Test]
    public function testExtractsEmojisFromString(): void
    {
        $string = "Hello world 😊🌍!";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['😊', '🌍'], $result);
    }

    #[Test]
    public function testReturnsEmptyArrayWhenNoEmojisArePresent(): void
    {
        $string = "Hello world!";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals([], $result);
    }

    #[Test]
    public function testHandlesDuplicateEmojisCorrectly(): void
    {
        $string = "😊😊🌍🌍";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['😊', '🌍'], $result);
    }

    #[Test]
    public function testRemovesEmojisFromString(): void
    {
        $string = "Hey 👋🐸!";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Hey !", $result);
    }

    #[Test]
    public function testRetainsNumbersInString(): void
    {
        $string = "Score: 100 🎉";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Score: 100 ", $result);
    }

    #[Test]
    public function testHandlesStringWithOnlyEmojis(): void
    {
        $string = "💯🔥😎";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("", $result);
    }

    #[Test]
    public function testReturnsOriginalStringIfNoEmojisArePresent(): void
    {
        $string = "Hello world!";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals($string, $result);
    }

    #[Test]
    public function testExtractsEmojisButNotPlainNumbers(): void
    {
        $string = "I have 3 apples 🍏 and 1️⃣ banana 🍌.";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['🍏', '1️⃣', '🍌'], $result);
    }

    #[Test]
    public function testRemovesEmojisButKeepsPlainNumbers(): void
    {
        $string = "Level 10️⃣ reached in 3 days!";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Level 10 reached in 3 days!", $result);
    }

    #[Test]
    public function testDoesNotExtractPlainNumbersAsEmojis(): void
    {
        $string = "123 456 789";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEmpty($result);
    }

    #[Test]
    public function testCorrectlyHandlesKeycapEmojis(): void
    {
        $string = "Top 3️⃣ players: 1️⃣ Alice, 2️⃣ Bob, 3️⃣ Charlie.";
        $result = EmojiHelper::getEmojisFromString($string);

        $this->assertEquals(['3️⃣', '1️⃣', '2️⃣'], $result);
    }

    #[Test]
    public function testRemovesKeycapEmojisButKeepsText(): void
    {
        $string = "Ranking: 1️⃣ Alice, 2️⃣ Bob, 3️⃣ Charlie.";
        $result = EmojiHelper::getStringWithoutEmojis($string);

        $this->assertEquals("Ranking: 1 Alice, 2 Bob, 3 Charlie.", $result);
    }
}
