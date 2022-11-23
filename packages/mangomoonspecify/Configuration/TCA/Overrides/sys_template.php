<?php
defined('TYPO3_MODE') || die();


call_user_func(function()
{   
    /**
     * Default TypoScript for Mangomoonspecify
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'mangomoonspecify',
        'Configuration/TypoScript',
        'mangomoonspecify'
    );
}
);