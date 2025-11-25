<?php
declare(strict_types=1);
namespace App\Data;

final class SalesStore
{
    /**
     * Retorna referencia a la tabla de ventas (5 productos × 4 vendedores)
     * almacenada en sesión.
     */
    public static function &table(): array
    {
        if (!isset($_SESSION['ventas'])) {
            // índice 1..5 para productos, cada uno con vendedor 1..4
            $_SESSION['ventas'] = array_fill(1, 5, array_fill(1, 4, 0.0));
        }
        return $_SESSION['ventas'];
    }

    public static function add(int $vendor, int $product, float $amount): void
    {
        $t =& self::table();
        $t[$product][$vendor] += $amount;
    }

    public static function reset(): void
    {
        unset($_SESSION['ventas']);
    }
}
