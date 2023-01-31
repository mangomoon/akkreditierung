<?php

$items = [['-', 0]];
foreach ([10, 20, 30, 40, 42, 50, 60, 80, 82, 84, 100, 110, 120, 130, 140, 142, 150, 160, 800, 810] as $status) {
    $items[] = [
        'LLL:EXT:ieb/Resources/Private/Language/locallang.xlf:ansuchen.status.' . $status,
        $status,
    ];
}
$GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['status']['config']['items'] = $items;

foreach (['ansuchen', 'berater', 'trainer'] as $tableSuffix) {
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