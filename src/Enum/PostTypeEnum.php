<?php
declare(strict_types=1);

namespace App\Enum;

enum PostTypeEnum: string
{

    case TEXT = 'text';
    case AUDIO = 'audio';

    public static function getValues(): array
    {
        return [self::TEXT, self::AUDIO];
    }

    public static function isValid(string $type): bool
    {
        return in_array($type, self::getValues(), true);
    }

    public static function isText(string $type): bool
    {
        return $type === self::TEXT->value;
    }

    public static function isAudio(string $type): bool
    {
        return $type === self::AUDIO->value;
    }
}
