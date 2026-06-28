<?php

declare(strict_types=1);

namespace App\Support;

class CvFormatter
{
    public static function renderPeriodeSegments(array $segments): string
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

    public static function buildEducationPeriodeSegments(string $mulaiDatetime, string $mulaiLabel, string $selesaiLabel): array
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

    public static function buildOrganisasiPeriodeSegments(string $mulaiDatetime, string $mulaiLabel, string $akhirTeks): array
    {
        return [
            ['type' => 'text', 'value' => '('],
            ['type' => 'time', 'datetime' => $mulaiDatetime, 'label' => $mulaiLabel],
            ['type' => 'text', 'value' => ' – ' . $akhirTeks . ')'],
        ];
    }

    public static function parsePoinText(string $text): array
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

    public static function poinToText(array $poin): string
    {
        return implode("\n", $poin);
    }

    public static function parseEducationPeriode(array $row): array
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

    public static function parseOrganisasiPeriode(array $item): array
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
}
