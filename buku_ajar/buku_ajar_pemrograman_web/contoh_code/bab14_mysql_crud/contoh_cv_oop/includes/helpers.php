<?php

declare(strict_types=1);

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function setFlash(string $type, string $message): void
{
    $_SESSION['cv_flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array
{
    if (!isset($_SESSION['cv_flash'])) {
        return null;
    }
    $flash = $_SESSION['cv_flash'];
    unset($_SESSION['cv_flash']);
    return $flash;
}

function postString(string $key, string $default = ''): string
{
    return isset($_POST[$key]) ? trim((string) $_POST[$key]) : $default;
}

function renderPeriodeSegments(array $segments): string
{
    $html = '';
    foreach ($segments as $seg) {
        if (($seg['type'] ?? '') === 'time') {
            $html .= '<time datetime="' . h($seg['datetime'] ?? '') . '">' . h($seg['label'] ?? '') . '</time>';
        } else {
            $html .= h($seg['value'] ?? '');
        }
    }
    return $html;
}

function buildEducationPeriodeSegments(string $mulaiDatetime, string $mulaiLabel, string $selesaiLabel): array
{
    $segments = [
        ['type' => 'time', 'datetime' => $mulaiDatetime, 'label' => $mulaiLabel],
        ['type' => 'text', 'value' => ' – '],
    ];

    if ($selesaiLabel === '' || strcasecmp($selesaiLabel, 'Sekarang') === 0) {
        $segments[] = ['type' => 'text', 'value' => 'Sekarang'];
    } else {
        $segments[] = ['type' => 'time', 'datetime' => $selesaiLabel, 'label' => $selesaiLabel];
    }

    return $segments;
}

function buildOrganisasiPeriodeSegments(string $mulaiDatetime, string $mulaiLabel, string $akhirTeks): array
{
    return [
        ['type' => 'text', 'value' => '('],
        ['type' => 'time', 'datetime' => $mulaiDatetime, 'label' => $mulaiLabel],
        ['type' => 'text', 'value' => ' – ' . $akhirTeks . ')'],
    ];
}

function parsePoinText(string $text): array
{
    $lines = preg_split('/\r\n|\r|\n/', $text) ?: [];
    $poin = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line !== '') {
            $poin[] = $line;
        }
    }
    return $poin;
}

function poinToText(array $poin): string
{
    return implode("\n", $poin);
}

function parseEducationPeriode(array $row): array
{
    $mulaiDatetimeVal = '';
    $mulaiLabelVal = '';
    $selesaiLabelVal = '';

    foreach ($row['periodeSegments'] as $seg) {
        if (($seg['type'] ?? '') === 'time' && $mulaiLabelVal === '') {
            $mulaiDatetimeVal = $seg['datetime'] ?? '';
            $mulaiLabelVal = $seg['label'] ?? '';
        } elseif (($seg['type'] ?? '') === 'time' && $mulaiLabelVal !== '') {
            $selesaiLabelVal = $seg['label'] ?? '';
        } elseif (($seg['type'] ?? '') === 'text' && str_contains($seg['value'] ?? '', 'Sekarang')) {
            $selesaiLabelVal = 'Sekarang';
        }
    }

    return [$mulaiDatetimeVal, $mulaiLabelVal, $selesaiLabelVal];
}

function parseOrganisasiPeriode(array $item): array
{
    $mulaiDatetimeVal = '';
    $mulaiLabelVal = '';
    $akhirTeksVal = '';

    foreach ($item['periodeSegments'] as $seg) {
        if (($seg['type'] ?? '') === 'time') {
            $mulaiDatetimeVal = $seg['datetime'] ?? '';
            $mulaiLabelVal = $seg['label'] ?? '';
        } elseif (($seg['type'] ?? '') === 'text' && str_contains($seg['value'] ?? '', '–')) {
            if (preg_match('/–\s*(.+)\)/', $seg['value'], $m)) {
                $akhirTeksVal = trim($m[1]);
            }
        }
    }

    return [$mulaiDatetimeVal, $mulaiLabelVal, $akhirTeksVal];
}
