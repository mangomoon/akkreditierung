<?php

$items = [['-', 0]];
foreach (\GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus::cases() as $status) {
    $items[] = [
        'LLL:EXT:ieb/Resources/Private/Language/locallang.xlf:ansuchen.status.' . $status->value,
        $status->value,
    ];
}
$GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['status']['config']['items'] = $items;
$GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['ctrl']['label_alt'] = 'version,version_active,version_based_on';
$GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['ctrl']['label_alt_force'] = 1;

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

$GLOBALS['TCA']['tx_ieb_domain_model_textbausteine']['columns']['kriterium']['config']['items'] = [
    ['', 0],

    ['A', '--div--'],
    ['A1', 'a1'],
    ['A2', 'a2'],
    ['B', '--div--'],
    ['B11', 'b11'],
];

foreach (['stammdaten', 'trainer', 'berater', 'standorte'] as $field) {
    $GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['copy_' . $field]['config']['readOnly'] = true;
    $GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['copy_' . $field]['config']['renderType'] = 'json';
}