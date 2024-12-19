<?php
namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class IsElementInArrayViewHelper extends AbstractViewHelper
{
    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('element', 'mixed', 'The element to check', true);
        $this->registerArgument('array', 'array', 'The array to search in', true);
    }

    /**
     * Check if the element is part of the array based on the uid
     *
     * @return bool
     */
    public function render(): bool
    {
        
        $element = $this->arguments['element'];
        $array = $this->arguments['array'];

        if (!is_array($array) || !is_object($element)) {
            return false;
        }

        $elementUid = $element->uid ?? null;
        if ($elementUid === null) {
            return false;
        }

        foreach ($array as $item) {
            if (is_object($item) && isset($item->uid) && $item->uid === $elementUid) {
                return true;
            }
        }

        return false;
    }
}