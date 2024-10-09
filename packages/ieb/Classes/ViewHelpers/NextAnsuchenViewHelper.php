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
        $this->registerArgument('person', 'int', 'Trainer/Berater UID', true);
        $this->registerArgument('typ', 'string', 'Trainer oder Berater', true);
        $this->registerArgument('as', 'string', 'Output', false, 'output');
    }

    /**
     * Render the ViewHelper
     *
     * @return output
     */
    public function render()
    {
        $uid   = $this->arguments['uid'];
        $person = $this->arguments['person'];
        $typ = $this->arguments['typ'];
      //  $ansuchen = $this->ansuchenRepository->findByUid($uid);
      
        $output = $this->ansuchenRepository->getNextAnsuchen($uid);
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($output);



      if ($typ == 'Trainer') {
        $json = $output['copy_trainer'];
      }
      if ($typ == 'Berater') {
        $json = $output['copy_berater'];
      }
      $output = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
      
      $output = $output[$person];
      
      // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($output);
      return $output;
    }
}
