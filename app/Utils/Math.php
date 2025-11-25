<?php
declare(strict_types=1);
namespace App\Utils;

final class Math
{
    public static function mean(array $nums): float
    {
        $n = count($nums);
        return $n === 0 ? 0.0 : array_sum($nums) / $n;
    }

    public static function stddev(array $nums): float
    {
        $n = count($nums);
        if ($n === 0) {
            return 0.0;
        }
        $mean = self::mean($nums);
        $sumSq = 0.0;
        foreach ($nums as $x) {
            $diff = $x - $mean;
            $sumSq += $diff * $diff;
        }
        return sqrt($sumSq / $n);
    }
}
