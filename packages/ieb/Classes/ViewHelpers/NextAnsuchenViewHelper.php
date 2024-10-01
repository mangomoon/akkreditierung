<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class NextAnsuchenViewHelper extends AbstractViewHelper
{
    /**
     * @var GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
     */
    protected $ansuchenRepository;

    /**
     *
     * @param GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository $ansuchenRepository
     */
     public function injectAnsuchenrRepository(AnsuchenRepository $ansuchenRepository): void
       {
           $this->ansuchenRepository = $ansuchenRepository;
       }

    /**
     * Initialize arguments
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('uid', 'int', 'Ansuchen UID', true);
    }

    /**
     * Render the ViewHelper
     *
     * @return ansuchen
     */
    public function render()
    {
        $uid   = $this->arguments['uid'];

      //  $ansuchen = $this->ansuchenRepository->findByUid($uid);
      
        $ansuchen = $this->ansuchenRepository->getNextAnsuchen($uid);
      

        if ($ansuchen === null) {
            return '';
        }
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($ansuchen);

      //   return  $ansuchen->getCopyTrainer();
      return $ansuchen;
    }
}
