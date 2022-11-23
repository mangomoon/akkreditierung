<?php

namespace Mangomoon\Domain\Model;
 
class FileReference extends \TYPO3\CMS\Core\Resource\FileReference {
 
    /**
     * copyright
     *
     * @var text
     */
    protected $copyright;
 
    /**
     * Returns the copyright
     *
     * @return text $copyright
     */
    public function getCopyright() {
        return $this->copyright;
    }
 
    /**
     * Sets the copyright
     *
     * @param text $copyright
     * @return void
     */
    public function setImageResponsive($copyright) {
        $this->copyright = $copyright;
    }
}

