<?php

namespace App\Support;

use App\Models\Product;

/**
 * Generates a book-style SVG cover (600x800) for products that have no real photo yet.
 * The theme (colours + illustration) is picked from the product name, then its category.
 */
class ProductCover
{
    /** keyword => theme; first match on the product name wins. */
    private const NAME_THEMES = [
        'sumber daya guru' => 'training',
        'koding ka' => 'ai',
        'html' => 'web',
        'robotik' => 'robot',
        'microbit' => 'microbit',
        'micro:bit' => 'microbit',
        'arduino' => 'iot',
        'iot' => 'iot',
        'pictoblox' => 'ai',
        'python' => 'python',
        'english' => 'english',
        'asesmen' => 'assessment',
        'ptm' => 'training',
        'modul' => 'book',
        'lkpd' => 'book',
        'scratch' => 'code',
        'lms' => 'lms',
        'informatika' => 'lms',
        'paket' => 'book',
    ];

    private const CATEGORY_THEMES = [
        'asesmen-potensi-siswa' => 'assessment',
        'microbit-iot' => 'microbit',
        'modul-cetak' => 'book',
        'modul-pdf' => 'book',
        'coding-informatika' => 'code',
        'erlass-academy-lms' => 'lms',
        'robotika-edukasi' => 'robot',
    ];

    /** [background top, background bottom, accent] */
    private const PALETTES = [
        'robot' => ['#023047', '#0b4f6c', '#ffb703'],
        'microbit' => ['#0f766e', '#023047', '#8ecae6'],
        'iot' => ['#134e4a', '#023047', '#ffb703'],
        'ai' => ['#4c1d95', '#1e1b4b', '#f0abfc'],
        'python' => ['#1e3a8a', '#0f172a', '#facc15'],
        'web' => ['#c2410c', '#431407', '#fdba74'],
        'english' => ['#b91c1c', '#7f1d1d', '#fde68a'],
        'assessment' => ['#219ebc', '#023047', '#ffb703'],
        'training' => ['#334155', '#0f172a', '#fb8500'],
        'book' => ['#fb8500', '#c2410c', '#023047'],
        'lms' => ['#2563eb', '#023047', '#8ecae6'],
        'code' => ['#219ebc', '#023047', '#ffb703'],
    ];

    public static function svg(Product $product): string
    {
        $theme = self::theme($product);
        [$top, $bottom, $accent] = self::PALETTES[$theme];
        $id = 'c'.substr(md5($product->sku), 0, 6);

        $title = self::titleLines(self::shortTitle($product));
        [$numLabel, $num] = self::number($product);

        $e = fn ($s) => htmlspecialchars((string) $s, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $levels = $e(strtoupper($product->levels_label));
        $category = $e(strtoupper($product->category?->name ?? 'Erlass Academy'));

        $titleSvg = '';
        $y = 190;
        foreach ($title['lines'] as $line) {
            $titleSvg .= '<text x="40" y="'.$y.'" font-size="'.$title['size'].'" font-weight="800" fill="#fff" letter-spacing="-1">'.$e($line).'</text>';
            $y += (int) round($title['size'] * 1.08);
        }

        $numSize = match (true) { $num === null => 0, strlen($num) <= 2 => 150, strlen($num) <= 3 => 112, default => 96 };
        $numberSvg = $num !== null
            ? '<text x="560" y="742" text-anchor="end" font-size="'.$numSize.'" font-weight="900" fill="'.$accent.'" opacity=".95">'.$e($num).'</text>'
              .'<text x="560" y="600" text-anchor="end" font-size="20" font-weight="800" fill="#fff" letter-spacing="4" opacity=".85">'.$e($numLabel).'</text>'
            : '';

        // Long titles push the illustration (drawn around 300,470) down and shrink it so they never overlap
        $titleBottom = $y - (int) round($title['size'] * 1.08) + 16;
        $overlap = max(0, $titleBottom - 270);
        $scale = $overlap > 0 ? max(0.62, 1 - $overlap / 260) : 1;
        $dy = $overlap > 0 ? (int) round($overlap * 0.55) : 0;
        $art = '<g transform="translate(0 '.$dy.') translate(300 470) scale('.round($scale, 3).') translate(-300 -470)">'
            .self::illustration($theme, $accent).'</g>';

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 800" width="600" height="800" font-family="'Plus Jakarta Sans','Segoe UI',Arial,sans-serif">
<defs>
<linearGradient id="{$id}bg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="{$top}"/><stop offset="1" stop-color="{$bottom}"/></linearGradient>
<linearGradient id="{$id}fade" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#000" stop-opacity="0"/><stop offset="1" stop-color="#000" stop-opacity=".55"/></linearGradient>
<pattern id="{$id}grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M40 0H0V40" fill="none" stroke="#fff" stroke-opacity=".06" stroke-width="1"/></pattern>
</defs>
<rect width="600" height="800" fill="url(#{$id}bg)"/>
<rect y="96" width="600" height="704" fill="url(#{$id}grid)"/>
<circle cx="560" cy="300" r="190" fill="#fff" opacity=".06"/>
<circle cx="40" cy="760" r="150" fill="#fff" opacity=".05"/>
<rect width="600" height="96" fill="#fff"/>
<text x="40" y="44" font-size="22" font-weight="800" fill="#023047" letter-spacing="2">ERLASS</text>
<text x="40" y="72" font-size="15" font-weight="600" fill="#219ebc" letter-spacing="1">ACADEMY</text>
<rect x="388" y="26" width="172" height="46" rx="10" fill="{$top}"/>
<text x="474" y="45" text-anchor="middle" font-size="12" font-weight="700" fill="#fff">Kurikulum</text>
<text x="474" y="63" text-anchor="middle" font-size="15" font-weight="800" fill="{$accent}">Merdeka</text>
{$titleSvg}
{$art}
<rect y="560" width="600" height="240" fill="url(#{$id}fade)"/>
{$numberSvg}
<text x="40" y="712" font-size="16" font-weight="700" fill="#fff" opacity=".85" letter-spacing="2">{$category}</text>
<text x="40" y="744" font-size="22" font-weight="800" fill="#fff">{$levels}</text>
</svg>
SVG;
    }

    public static function theme(Product $product): string
    {
        $name = strtolower($product->name);
        foreach (self::NAME_THEMES as $needle => $theme) {
            if (str_contains($name, $needle)) {
                return $theme;
            }
        }

        return self::CATEGORY_THEMES[$product->category?->slug] ?? 'code';
    }

    /** Drop words that the number badge already shows ("Jilid 1", "Kelas 4"). */
    private static function shortTitle(Product $product): string
    {
        $t = preg_replace('/\s+(Jilid|Kelas)\s+\d+(\s*-\s*\d+)?\s*$/i', '', $product->name);
        $t = preg_replace('/\s+(SD|SMP|SMA)$/', '', $t);

        return trim(preg_replace('/\s+\d+-\d+$/', '', $t)) ?: $product->name;
    }

    /** @return array{0: string, 1: ?string} */
    private static function number(Product $product): array
    {
        // Only numbers that are part of the title. SKU digits (ECR03, ERR02-...) are rombel
        // codes, not levels, so they are never shown on the cover.
        if (preg_match('/\b(Jilid|Kelas)\s+(\d+(?:-\d+)?)/i', $product->name, $m)) {
            return [strtoupper($m[1]), $m[2]];
        }
        if (preg_match('/(\d+-\d+)$/', $product->name, $m)) {
            return ['KELAS', $m[1]];
        }
        // "Informatika SD", "Koding KA SMP": show the school level as the big mark
        if (preg_match('/\b(SD|SMP|SMA)$/', $product->name, $m)) {
            return ['JENJANG', $m[1]];
        }

        return ['', null];
    }

    /** Word-wrap the title, shrinking the font until it fits in 4 lines. */
    private static function titleLines(string $title): array
    {
        $lines = [$title];
        foreach ([64, 56, 48, 42, 36] as $size) {
            $max = (int) floor(520 / ($size * 0.6));
            $lines = explode("\n", wordwrap($title, $max, "\n", true));
            if (count($lines) <= 3 || ($size <= 42 && count($lines) <= 4)) {
                return ['size' => $size, 'lines' => $lines];
            }
        }

        return ['size' => 36, 'lines' => array_slice($lines, 0, 4)];
    }

    /** Illustration drawn roughly in the 300-640 band, centred. */
    private static function illustration(string $theme, string $accent): string
    {
        $w = '#ffffff';

        return match ($theme) {
            'robot' => <<<S
<g transform="translate(300 470)">
<line x1="0" y1="-150" x2="0" y2="-120" stroke="$w" stroke-width="6"/><circle cx="0" cy="-158" r="12" fill="$accent"/>
<rect x="-95" y="-120" width="190" height="130" rx="30" fill="$w"/>
<circle cx="-40" cy="-58" r="22" fill="#023047"/><circle cx="40" cy="-58" r="22" fill="#023047"/>
<circle cx="-34" cy="-64" r="7" fill="$accent"/><circle cx="46" cy="-64" r="7" fill="$accent"/>
<rect x="-35" y="-16" width="70" height="10" rx="5" fill="#023047"/>
<rect x="-120" y="-70" width="25" height="50" rx="10" fill="$accent"/><rect x="95" y="-70" width="25" height="50" rx="10" fill="$accent"/>
<rect x="-75" y="22" width="150" height="110" rx="22" fill="$w" opacity=".92"/>
<circle cx="0" cy="77" r="26" fill="$accent"/><circle cx="0" cy="77" r="12" fill="#023047"/>
</g>
S,
            'microbit', 'iot' => self::microbit($accent, $theme === 'iot'),
            'ai' => <<<S
<g transform="translate(300 450)" stroke="$w" stroke-width="4" stroke-opacity=".7">
<line x1="-150" y1="-90" x2="-40" y2="-40"/><line x1="-150" y1="-90" x2="-40" y2="60"/><line x1="-150" y1="40" x2="-40" y2="-40"/><line x1="-150" y1="40" x2="-40" y2="60"/><line x1="-150" y1="140" x2="-40" y2="60"/>
<line x1="-40" y1="-40" x2="80" y2="10"/><line x1="-40" y1="60" x2="80" y2="10"/><line x1="-40" y1="-40" x2="80" y2="120"/><line x1="-40" y1="60" x2="80" y2="120"/>
<line x1="80" y1="10" x2="170" y2="60"/><line x1="80" y1="120" x2="170" y2="60"/>
<g stroke="none"><circle cx="-150" cy="-90" r="20" fill="$w"/><circle cx="-150" cy="40" r="20" fill="$w"/><circle cx="-150" cy="140" r="20" fill="$w"/>
<circle cx="-40" cy="-40" r="26" fill="$accent"/><circle cx="-40" cy="60" r="26" fill="$accent"/>
<circle cx="80" cy="10" r="26" fill="$w"/><circle cx="80" cy="120" r="26" fill="$w"/><circle cx="170" cy="60" r="32" fill="$accent"/></g>
<text x="170" y="70" text-anchor="middle" font-size="26" font-weight="900" fill="#1e1b4b" stroke="none">AI</text>
</g>
S,
            'python' => self::window($accent, [
                ['>>> ', 'print("Halo!")'],
                ['', 'Halo!'],
                ['>>> ', 'for i in range(3):'],
                ['... ', '    robot.maju()'],
            ]),
            'web' => self::window($accent, [
                ['', '<!DOCTYPE html>'],
                ['', '<h1>Halo Dunia</h1>'],
                ['', '<p>Web pertamaku</p>'],
                ['', '</html>'],
            ]),
            'english' => <<<S
<g transform="translate(300 450)">
<rect x="-190" y="-110" width="230" height="140" rx="28" fill="$w"/><path d="M-150 30 L-160 80 L-110 30Z" fill="$w"/>
<text x="-75" y="-20" text-anchor="middle" font-size="64" font-weight="900" fill="#b91c1c">ABC</text>
<rect x="-10" y="30" width="210" height="130" rx="28" fill="$accent"/><path d="M160 160 L175 205 L120 160Z" fill="$accent"/>
<text x="95" y="112" text-anchor="middle" font-size="48" font-weight="900" fill="#7f1d1d">Hello!</text>
</g>
S,
            'assessment' => <<<S
<g transform="translate(300 460)">
<rect x="-140" y="-140" width="280" height="300" rx="24" fill="$w"/>
<rect x="-55" y="-160" width="110" height="44" rx="14" fill="$accent"/>
<g fill="none" stroke="#219ebc" stroke-width="10" stroke-linecap="round" stroke-linejoin="round">
<path d="M-105 -70 l18 18 l32 -36"/><path d="M-105 0 l18 18 l32 -36"/></g>
<rect x="-35" y="-78" width="140" height="14" rx="7" fill="#cbd5e1"/><rect x="-35" y="-8" width="110" height="14" rx="7" fill="#cbd5e1"/>
<rect x="-100" y="110" width="34" height="30" rx="6" fill="#8ecae6"/><rect x="-50" y="80" width="34" height="60" rx="6" fill="#219ebc"/>
<rect x="0" y="50" width="34" height="90" rx="6" fill="$accent"/><rect x="50" y="90" width="34" height="50" rx="6" fill="#023047"/>
</g>
S,
            'training' => <<<S
<g transform="translate(300 460)">
<rect x="-200" y="-140" width="300" height="200" rx="16" fill="$w"/>
<polyline points="-170,20 -110,-30 -60,0 0,-80 60,-50" fill="none" stroke="$accent" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
<line x1="-50" y1="60" x2="-80" y2="150" stroke="$w" stroke-width="8"/><line x1="-50" y1="60" x2="-20" y2="150" stroke="$w" stroke-width="8"/>
<circle cx="150" cy="-40" r="40" fill="$accent"/>
<path d="M90 160 Q90 30 150 30 Q210 30 210 160Z" fill="$w"/>
<line x1="110" y1="70" x2="70" y2="-10" stroke="$w" stroke-width="10" stroke-linecap="round"/>
</g>
S,
            'book' => <<<S
<g transform="translate(300 470)">
<path d="M0 -110 Q-90 -150 -210 -120 L-210 120 Q-90 90 0 130Z" fill="$w"/>
<path d="M0 -110 Q90 -150 210 -120 L210 120 Q90 90 0 130Z" fill="$w" opacity=".9"/>
<line x1="0" y1="-110" x2="0" y2="130" stroke="$accent" stroke-width="6"/>
<g stroke="#cbd5e1" stroke-width="9" stroke-linecap="round"><line x1="-170" y1="-80" x2="-40" y2="-90"/><line x1="-170" y1="-45" x2="-40" y2="-55"/><line x1="-170" y1="-10" x2="-70" y2="-18"/></g>
<rect x="40" y="-90" width="130" height="80" rx="10" fill="$accent" opacity=".85"/>
<g stroke="#cbd5e1" stroke-width="9" stroke-linecap="round"><line x1="40" y1="25" x2="170" y2="30"/><line x1="40" y1="60" x2="140" y2="64"/></g>
<rect x="-170" y="30" width="60" height="40" rx="8" fill="#219ebc"/><rect x="-100" y="30" width="60" height="40" rx="8" fill="#ffb703"/>
</g>
S,
            'lms' => <<<S
<g transform="translate(300 460)">
<rect x="-200" y="-130" width="400" height="250" rx="18" fill="$w"/>
<rect x="-180" y="-110" width="360" height="210" rx="8" fill="#023047"/>
<rect x="-165" y="-95" width="100" height="180" rx="8" fill="#ffffff" opacity=".12"/>
<rect x="-50" y="-95" width="215" height="110" rx="10" fill="$accent"/>
<path d="M45 -65 L45 -15 L90 -40Z" fill="#023047"/>
<rect x="-50" y="30" width="100" height="55" rx="8" fill="#219ebc"/><rect x="65" y="30" width="100" height="55" rx="8" fill="#fb8500"/>
<path d="M-240 120 H240 L215 150 H-215Z" fill="$w" opacity=".9"/>
</g>
S,
            default => self::blocks($accent),
        };
    }

    private static function microbit(string $accent, bool $wifi): string
    {
        $leds = '';
        $on = [[1, 0], [3, 0], [0, 2], [4, 2], [1, 3], [2, 3], [3, 3], [1, 1], [3, 1]];
        for ($r = 0; $r < 5; $r++) {
            for ($c = 0; $c < 5; $c++) {
                $lit = in_array([$c, $r], $on, true);
                $leds .= '<rect x="'.(-70 + $c * 30).'" y="'.(-80 + $r * 30).'" width="16" height="16" rx="3" fill="'.($lit ? '#ef4444' : '#1f2937').'"/>';
            }
        }
        $pins = '';
        for ($i = 0; $i < 19; $i++) {
            $pins .= '<rect x="'.(-180 + $i * 19).'" y="95" width="10" height="30" fill="#fbbf24"/>';
        }
        $arcs = $wifi
            ? '<g fill="none" stroke="#fff" stroke-width="10" stroke-linecap="round" opacity=".8"><path d="M140 -150 a70 70 0 0 1 70 70"/><path d="M140 -190 a110 110 0 0 1 110 110"/></g>'
            : '';

        return <<<S
<g transform="translate(300 470)">
{$arcs}
<rect x="-200" y="-130" width="400" height="260" rx="30" fill="#111827" stroke="$accent" stroke-width="6"/>
<circle cx="-145" cy="-5" r="30" fill="#374151"/><circle cx="-145" cy="-5" r="18" fill="#9ca3af"/>
<circle cx="145" cy="-5" r="30" fill="#374151"/><circle cx="145" cy="-5" r="18" fill="#9ca3af"/>
<text x="-145" y="50" text-anchor="middle" font-size="22" font-weight="800" fill="#fff">A</text>
<text x="145" y="50" text-anchor="middle" font-size="22" font-weight="800" fill="#fff">B</text>
{$leds}
{$pins}
</g>
S;
    }

    /** Scratch-style stacked code blocks. */
    private static function blocks(string $accent): string
    {
        $rows = [
            ['#ffb703', 260, 'ketika diklik'],
            ['#4c97ff', 300, 'gerak 10 langkah'],
            ['#9966ff', 280, 'katakan Halo!'],
            ['#ff8c1a', 230, 'ulangi 10'],
            ['#59c059', 250, 'putar 15°'],
        ];
        $out = '<g transform="translate(150 330)">';
        $y = 0;
        foreach ($rows as $i => [$color, $width, $label]) {
            $x = $i === 4 ? 30 : 0;
            $out .= '<path d="M'.$x.' '.$y.' h20 l8 8 h24 l8 -8 h'.($width - 60).' v52 h-'.($width - 60).' l-8 8 h-24 l-8 -8 h-20Z" fill="'.$color.'"/>'
                .'<text x="'.($x + 22).'" y="'.($y + 34).'" font-size="22" font-weight="800" fill="#fff">'.$label.'</text>';
            $y += 56;
        }

        return $out.'<circle cx="320" cy="40" r="34" fill="'.$accent.'"/><text x="320" y="52" text-anchor="middle" font-size="32" font-weight="900" fill="#023047">&lt;/&gt;</text></g>';
    }

    /** Code editor window. */
    private static function window(string $accent, array $lines): string
    {
        $out = '<g transform="translate(300 470)"><rect x="-210" y="-150" width="420" height="290" rx="20" fill="#0b1220"/>'
            .'<rect x="-210" y="-150" width="420" height="46" rx="20" fill="#1f2937"/>'
            .'<circle cx="-180" cy="-127" r="8" fill="#ef4444"/><circle cx="-155" cy="-127" r="8" fill="#f59e0b"/><circle cx="-130" cy="-127" r="8" fill="#22c55e"/>';
        $y = -60;
        foreach ($lines as [$prompt, $code]) {
            $out .= '<text x="-185" y="'.$y.'" font-family="Consolas,monospace" font-size="24" font-weight="700">'
                .'<tspan fill="'.$accent.'">'.htmlspecialchars($prompt, ENT_XML1).'</tspan>'
                .'<tspan fill="#e2e8f0">'.htmlspecialchars($code, ENT_XML1).'</tspan></text>';
            $y += 46;
        }

        return $out.'</g>';
    }
}
