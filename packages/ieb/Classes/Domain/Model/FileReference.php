<?php
declare(strict_types=1);
namespace GeorgRinger\Ieb\Domain\Model;

class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference
{

    /**
     * Uid of a sys_file
     *
     * @var int
     */
    protected $originalFileIdentifier;

    /**
     * @param \TYPO3\CMS\Core\Resource\FileReference $originalResource
     */
    public function setOriginalResource(\TYPO3\CMS\Core\Resource\FileReference $originalResource): void
    {
        $this->setFileReference($originalResource);
    }

    /**
     * @param \TYPO3\CMS\Core\Resource\FileReference $originalResource
     */
    private function setFileReference(\TYPO3\CMS\Core\Resource\FileReference $originalResource): void
    {
        $this->originalResource = $originalResource;
        $this->originalFileIdentifier = (int)$originalResource->getOriginalFile()->getUid();
        $this->uidLocal = (int)$originalResource->getOriginalFile()->getUid();
    }
}
