<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\Exception\MissingArrayPathException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class DiffViewHelper extends AbstractViewHelper
{

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('diff', 'array', 'Data', true);
        $this->registerArgument('field', 'string', 'field', true);
        $this->registerArgument('lll', 'string', 'Key', false, '');

        parent::initializeArguments();
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $diff = $arguments['diff'] ?? [];
        $field = $arguments['field'] ?? '';

        try {
            $data = ArrayUtility::getValueByPath($diff, $field);

            if (isset($data['previous'])) {
                return sprintf('<span class="diff" style="color:#666;background: #53d9f0">vorher: %s</span>', htmlspecialchars($data['previous']));
            }

            $fields = [];
            foreach ($data as $key => $value) {
                $fields[] = sprintf(
                    '<li></li><strong>%s</strong>: <s>%s</s> %s</li>',
                    htmlspecialchars(self::getLabel($key, $arguments['lll'] ?? '')),
                    htmlspecialchars((string)($value['previous'] ?? '')),
                    htmlspecialchars((string)($value['current'] ?? ''))
                );
            }
            return sprintf('<div class="diff" style="color:#666;background: #53d9f0"><ul>%s</ul></div>', implode(LF, $fields));

        } catch (MissingArrayPathException $e) {
            return getenv('IS_DDEV_PROJECT') ? ('ERROR: ' . $e->getMessage()) : '';
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
