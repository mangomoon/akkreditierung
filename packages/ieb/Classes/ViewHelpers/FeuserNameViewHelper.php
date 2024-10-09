<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FeuserNameViewHelper extends AbstractViewHelper
{
    /**
     * @var \Vendor\ExtensionName\Domain\Repository\FrontendUserRepository
     */
    protected $frontendUserRepository;

    /**
     * Inject the FrontendUserRepository
     *
     * @param GeorgRinger\Ieb\Domain\Repository\FrontendUserRepository $frontendUserRepository
     */
    public function injectFrontendUserRepository(FrontendUserRepository $frontendUserRepository): void
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * Initialize arguments
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('uid', 'int', 'UID of the frontend user', true);
    }

    /**
     * Render the ViewHelper
     *
     * @return string
     */
    public function render(): string
    {
        $uid = $this->arguments['uid'];

        $frontendUser = $this->frontendUserRepository->findByUid($uid);
        if ($frontendUser === null) {
            return ' ';
        }

        // Gib den vollständigen Namen zurück
        return $frontendUser->getFirstName() . ' ' . $frontendUser->getLastName();
    }
}
