<?php

require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];


$mpdf = new \Mpdf\Mpdf([
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => 0,
    'default_font' => '',
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 0,
    'margin_bottom' => 0,
    'margin_header' => 0,
    'margin_footer' => 0,
    'orientation' => 'P',
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'pyidaungsu' => [
            'R' => 'Pyidaungsu-Regular.ttf',
            'B' => 'Pyidaungsu-Bold.ttf',
        ]
    ],
    'default_font' => 'pyidaungsu'
]);

$css = file_get_contents('./style.css');
// $body = file_get_contents('./body.html');
// die(var_dump($body));
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML('<div class="container">
<h1>မင်္ဂလာပါ!</h1>
</div>', 2);
$mpdf->Output();
