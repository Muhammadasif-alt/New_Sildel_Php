<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

/**
 * Turns plain content strings into safe inline HTML.
 *
 * Content is escaped first, then two lightweight conventions are applied:
 *   *text*  becomes <em>text</em> (the gold italic accent of the design)
 *   \n      becomes <br>
 *
 * This keeps content editable as plain text (config today, an admin panel later)
 * without ever trusting raw HTML.
 */
final class Markup
{
    public static function inline(?string $text): HtmlString
    {
        $html = e((string) $text);
        $html = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $html);

        return new HtmlString(nl2br((string) $html, false));
    }

    public static function roman(int $number): string
    {
        $map = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
        $result = '';

        foreach ($map as $numeral => $value) {
            while ($number >= $value) {
                $result .= $numeral;
                $number -= $value;
            }
        }

        return $result;
    }
}
