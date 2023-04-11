<?php

$items = [['-', 0]];
foreach ([10, 20, 30, 40, 42, 50, 60, 80, 82, 84, 100, 110, 120, 130, 140, 142, 150, 160, 800, 810] as $status) {
    $items[] = [
        'LLL:EXT:ieb/Resources/Private/Language/locallang.xlf:ansuchen.status.' . $status,
        $status,
    ];
}
$GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['status']['config']['items'] = $items;

foreach (['ansuchen', 'berater', 'trainer', 'standort', 'angebotverantwortlich'] as $tableSuffix) {
    $GLOBALS['TCA']['tx_ieb_domain_model_' . $tableSuffix]['columns']['tstamp'] = [
        'label' => 'tstamp',
        'config' => [
            'type' => 'input',
            'renderType' => 'inputDateTime',
            'eval' => 'datetime',
        ],
    ];
    $GLOBALS['TCA']['tx_ieb_domain_model_' . $tableSuffix]['columns']['crdate'] = [
        'label' => 'crdate',
        'config' => [
            'type' => 'input',
            'renderType' => 'inputDateTime',
            'eval' => 'datetime',
        ],
    ];
}

$GLOBALS['TCA']['tx_ieb_domain_model_stammdaten']['columns']['rechtsform']['config']['items'] = [
    ['', 0],
    ['Aktiengesellschaft (AG)', 10],
    ['Einzelunternehmen (EPU, EU)', 20],
    ['Eingetragenes Unternehmen (e.U.)', 30],
    ['Genossenschaft', 40],
    ['Gesellschaft mit beschränkter Haftung (GmbH)', 60],
    ['Kommanditgesellschaft (KG)', 80],
    ['Körperschaft öffentlichen Rechts (KÖR)', 90],
    ['Offene Gesellschaft (OG)', 100],
    ['Schule', 110],
    ['Verein', 120],
    ['Sonstige', 130],
];