<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers\Form;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\ViewHelpers\Form\UploadViewHelper as UploadViewHelperCore;

class UploadMultipleViewHelper extends UploadViewHelperCore
{

    protected PropertyMapper $propertyMapper;

    public function injectPropertyMapper(PropertyMapper $propertyMapper): void
    {
        $this->propertyMapper = $propertyMapper;
    }

    /**
     * Render the upload field including possible resource pointer
     */
    public function render()
    {
        $this->tag->addAttribute('multiple', 'multiple');
        $this->arguments['multiple'] = true;
        $output = '';
        $hashService = GeneralUtility::makeInstance(HashService::class);

        $resource = $this->getUploadedResource();
//        DebuggerUtility::var_dump($resource);
        if ($resource !== null) {
            $resourcePointerIdAttribute = '';
            $idList = [];
            if ($this->hasArgument('id')) {
                $resourcePointerIdAttribute = ' id="' . htmlspecialchars($this->arguments['id']) . '-file-reference"';
            }
            foreach ($resource as $res) {
                $resourcePointerValue = $res->getUid();
                if ($resourcePointerValue === null) {
                    // Newly created file reference which is not persisted yet.
                    // Use the file UID instead, but prefix it with "file:" to communicate this to the type converter
                    $resourcePointerValue = 'file:' . $res->getOriginalResource()->getOriginalFile()->getUid();
                }
                $idList[] = $hashService->appendHmac((string)$resourcePointerValue);
            }
            $output .= '<input type="hidden" name="' . $this->getName() . '[submittedFile][resourcePointer]" value="' . htmlspecialchars(implode('|', $idList)) . '"' . $resourcePointerIdAttribute . ' />';
            $this->templateVariableContainer->add('resource', $resource);
            $output .= $this->renderChildren();
            $this->templateVariableContainer->remove('resource');
        }
        $output .= parent::render();
        return $output;
    }

    /**
     * Return a previously uploaded resource.
     * Return NULL if errors occurred during property mapping for this property.
     */
    protected function getUploadedResource(): ?ObjectStorage
    {
        if ($this->getMappingResultsForProperty()->hasErrors()) {
            return null;
        }
        $resource = $this->getValueAttribute();
        if ($resource instanceof ObjectStorage) {
            return $resource;
        }

//        dd(get_class($resource));die;

//        return $this->propertyMapper->convert((string)$resource, FileReference::class);
    }
}