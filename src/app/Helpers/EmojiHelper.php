<?php

namespace App\Helpers;

class EmojiHelper
{
    private const EMOJI_REGEX = '/[\p{Emoji}\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u';
    private const EMOJI_REGEX_IGNORE_NUMBERS = '/(?!\d+)[\p{Emoji}\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u';

    public static function getEmojisFromString(string $string): array {
        $matches = [];

        if (preg_match_all(self::EMOJI_REGEX, $string, $matches) === false) {
            return [];
        }

        return array_values(array_unique($matches[0] ?? []));
    }

    public static function getStringWithoutEmojis(string $string): string {
        return preg_replace(self::EMOJI_REGEX_IGNORE_NUMBERS, '', $string) ?? $string;
    }
}
