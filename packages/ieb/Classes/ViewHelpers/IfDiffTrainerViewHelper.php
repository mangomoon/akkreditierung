<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\Exception\MissingArrayPathException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class IfDiffTrainerViewHelper extends AbstractViewHelper
{

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('diff', 'array', 'Data', true);
        $this->registerArgument('field', 'string', 'field', true);
        $this->registerArgument('bereich', 'int', 'bereich', true);
        $this->registerArgument('lll', 'string', 'Key', false, '');

        parent::initializeArguments();
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $diff = $arguments['diff'] ?? [];
        $field = $arguments['field'] ?? '';
        $bereich = $arguments['bereich'];

        
        try {
            $data = ArrayUtility::getValueByPath($diff, $field);

            if (isset($data['uid'])) {
                return sprintf("<span class='vorher-knopf'>neu</span>");
            } else {
                if ($bereich == 1 && ( isset($data['qualifikationBabi']) || isset($data['qualifikationBabiDatei']) || isset($data['lebenslauf']) || isset($data['lebenslaufDatei']) )) {
                    return sprintf("<span class='vorher-knopf'>Änderung</span>");
                } 
                if ($bereich == 2 && ( isset($data['qualifikationPsa']) || isset($data['qualifikationPsaDatei']) || isset($data['lebenslauf']) || isset($data['lebenslaufDatei']) || isset($data['qualifikationPsa1']) || isset($data['qualifikationPsa2']) || isset($data['qualifikationPsa3']) || isset($data['qualifikationPsa4']) || isset($data['qualifikationPsa5']) || isset($data['qualifikationPsa6']) || isset($data['qualifikationPsa7']) || isset($data['qualifikationPsa8']) || isset($data['qualifikationPsaKommentar']) || isset($data['lehrBefugnisDatei']) || isset($data['lehrBefugnis']) )) {
                    return sprintf("<span class='vorher-knopf'>Änderung</span>");
                } 
            }
            //return sprintf('<div class="diff" style="color:#666;background: #53d9f0"><ul>%s</ul></div>', implode(LF, $fields));


        } catch (MissingArrayPathException $e) {
            return '';
        }
    }

    public static function getLabel(string $key, string $label = ''): string
    {
        if (!$label) {
            return $key;
        }
        $label = (string)LocalizationUtility::translate('LLL:EXT:ieb/Resources/Private/Language/locallang.xlf:' . $label . '.' . $key);
        return $label ?: $key;
    }
}
