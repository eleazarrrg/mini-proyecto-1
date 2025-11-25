<?php
declare(strict_types=1);
namespace App\Utils;

final class Validator
{
    public static function isNumeric(string $v): bool
    {
        return (bool) preg_match('/^-?\d+(\.\d+)?$/', trim($v));
    }

    public static function toFloat(string $v): float
    {
        $filtered = filter_var($v, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return (float) $filtered;
    }

    public static function sanitizeString(string $v): string
    {
        return filter_var($v, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public static function requireInRange(int|float $v, int|float $min, int|float $max, string $label = 'valor'): void
    {
        if ($v < $min || $v > $max) {
            throw new \InvalidArgumentException("$label fuera de rango: debe estar entre {$min} y {$max}. (Recibido: {$v})");
        }
    }
}
