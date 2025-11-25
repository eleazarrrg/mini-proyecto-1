<?php
declare(strict_types=1);
session_start();

// Definir zona horaria por si necesitas fecha/hora consistente
date_default_timezone_set('America/Panama');

// Autoload estilo PSR-4 simple para namespace “App\”
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    // Si la clase no empieza con “App\”, ignorar
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    // Remover el prefijo y convertir namespace en ruta de archivo
    $relativeClass = substr($class, strlen($prefix));
    $relativePath = str_replace('\\', '/', $relativeClass) . '.php';

    $file = $baseDir . $relativePath;
    if (is_file($file)) {
        require $file;
    }
});

// Helpers globales

/**
 * Escapa para imprimir en HTML seguro.
 */
function h(?string $str): string {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

/**
 * Enlace de regreso al menú principal (o ruta dada)
 */
function back_link(string $url = 'index.php', string $text = '← Volver al portal'): string {
    $u = h($url);
    $t = h($text);
    return "<p><a href=\"{$u}\" style=\"color: var(--accent);\">{$t}</a></p>";
}
