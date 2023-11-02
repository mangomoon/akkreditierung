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

    ['A.1. Stammdaten', 'a1'],
    ['A.2. Qualität des Anbieters', 'a2'],
    ['B.1. Eckdaten zum Angebot', 'b1'],
    ['B.1.4 Standorte', 'b14'],
    ['B.1.5 Prüfbescheid, Kooperation', 'b15'],
    ['B.2.1 Ansprache und Erreichung der Zielgruppe', 'b21'],
    ['B.2.2 Didaktisch-methodisches Vorgehen', 'b22'],
    ['B.2.3 Beratung, Coaching und Begleitung', 'b23'],
    ['C.1. Projektleitung', 'c1'],
    ['C.2. Training (allgemein)', 'c2'],
    ['C.2.Trainer:in: Basisbildung', 'c2tb'],
    ['C.2.Trainer:in: PSA', 'c2tp'],
    ['C.3. Beratung (allgemein)', 'c3'],
    ['C.3. Berater:in', 'c3b'],
    ['Allgemeiner Kommentar', 'allg'],
];

foreach (['stammdaten', 'trainer', 'berater', 'standorte'] as $field) {
    $GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['copy_' . $field]['config']['readOnly'] = true;
    $GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['copy_' . $field]['config']['renderType'] = 'json';
}

$GLOBALS['TCA']['tx_ieb_domain_model_ansuchen']['columns']['akkreditierung_pdf'] = [
    'label' => 'Akkreditierung PDF',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'akkreditierung_pdf',
        [
            'foreign_match_fields' => [
                'fieldname' => 'akkreditierung_pdf',
                'tablenames' => 'tx_ieb_domain_model_ansuchen',
                'table_local' => 'sys_file',
            ],
            'maxitems' => 1,
        ]
    ),
];