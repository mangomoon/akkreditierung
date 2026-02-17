<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Backend\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Utility\DebugUtility;

class JsonElement extends AbstractFormElement
{

    public function render(): array
    {
        $parameterArray = $this->data['parameterArray'];
        $resultArray = $this->initializeResultArray();
        $resultArray['html'] = '<div></div>';
        $json = (string)$parameterArray['itemFormElValue'];
        if (!empty($json)) {
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            $resultArray['html'] .= DebugUtility::viewArray($data);
        }

        return $resultArray;
    }
}
