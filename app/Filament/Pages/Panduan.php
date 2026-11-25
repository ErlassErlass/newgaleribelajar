<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

/**
 * "Panduan" page right under Dashboard: shows docs/PANDUAN_PER_ROLE.md inside the admin panel.
 * Every role sees its own guide first; Admin and Super Admin can also open the guides of the roles below them.
 * Editing the markdown file updates this page, no code change needed.
 */
class Panduan extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?int $navigationSort = -1; // Dashboard is -2

    protected static ?string $navigationLabel = 'Panduan';

    protected static ?string $title = 'Panduan Penggunaan';

    protected string $view = 'filament.pages.panduan';

    /** Section heading prefix in the markdown file => role that section is written for. */
    private const SECTIONS = [
        'A.' => User::ROLE_WRITER,
        'B.' => User::ROLE_ADMIN,
        'C.' => User::ROLE_SUPER_ADMIN,
    ];

    /** Which sections each role sees, own guide first. */
    private const VISIBLE = [
        User::ROLE_WRITER => ['A.'],
        User::ROLE_ADMIN => ['B.', 'A.'],
        User::ROLE_SUPER_ADMIN => ['C.', 'B.', 'A.'],
    ];

    public function getSubheading(): ?string
    {
        return 'Anda masuk sebagai '.(auth()->user()?->role_label ?? '-').'. Panduan untuk role Anda tampil paling atas.';
    }

    /** @return array{intro: string, sections: list<array{title: string, html: string, own: bool}>, summary: string} */
    public function guide(): array
    {
        $path = base_path('docs/PANDUAN_PER_ROLE.md');
        $md = is_file($path) ? (string) file_get_contents($path) : '';
        if ($md === '') {
            return ['intro' => '<p>File panduan belum tersedia.</p>', 'sections' => [], 'summary' => ''];
        }

        // Chunks start at each "## " heading; the first chunk is the introduction
        $chunks = preg_split('/^(?=## )/m', $md);
        $intro = array_shift($chunks);
        $byKey = [];
        $summary = '';
        foreach ($chunks as $chunk) {
            $title = trim(Str::before(Str::after($chunk, '## '), "\n"));
            $body = Str::after($chunk, "\n");
            $key = Str::before($title, ' ');
            if (isset(self::SECTIONS[$key])) {
                $byKey[$key] = ['title' => trim(Str::after($title, ' ')), 'body' => $body];
            } else {
                $summary .= $body; // e.g. "Ringkasan hak akses"; its heading is the section heading
            }
        }

        // Intro: keep only the part that applies to everyone (the role table links to anchors on the doc page)
        $intro = str_contains($intro, '**Berlaku untuk semua role**')
            ? Str::after($intro, '**Berlaku untuk semua role**')
            : preg_replace('/^# .*$/m', '', $intro);

        $role = auth()->user()?->role;
        $sections = [];
        foreach (self::VISIBLE[$role] ?? ['A.'] as $i => $key) {
            if (isset($byKey[$key])) {
                $sections[] = [
                    'title' => 'Panduan '.$byKey[$key]['title'],
                    'html' => $this->html($byKey[$key]['body']),
                    'own' => $i === 0,
                ];
            }
        }

        return ['intro' => $this->html($intro), 'sections' => $sections, 'summary' => $this->html($summary)];
    }

    private function html(string $md): string
    {
        // Links to other .md files and in-page anchors don't exist inside the panel: keep just the text
        $md = preg_replace('/\[([^\]]+)\]\((?![a-z]+:\/\/)[^)]*\)/i', '$1', $md);
        $md = preg_replace('/^---\s*$/m', '', $md);

        return Str::markdown(trim($md), ['html_input' => 'strip', 'allow_unsafe_links' => false]);
    }
}
