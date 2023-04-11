<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ArrayValueViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('array', 'array', 'Data', true);
        $this->registerArgument('key', 'mixed', 'Key', true);
        $this->registerArgument('fallback', 'string', 'Fallback', false, '');
        parent::initializeArguments();
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        return $arguments['array'][$arguments['key']] ?? $arguments['fallback'] ?? '';
    }
}
