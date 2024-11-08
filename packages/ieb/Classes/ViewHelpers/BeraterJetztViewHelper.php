<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class BeraterJetztViewHelper extends AbstractViewHelper
{
   /**
     * @var GeorgRinger\Ieb\Domain\Repository\BeraterRepository
     */
    protected $beraterRepository;


     /**
     * BeraterRepository
     *
     * @param GeorgRinger\Ieb\Domain\Repository\BeraterRepository $beraterRepository
     */
    public function injectBeraterRepository(BeraterRepository $beraterRepository): void
    {
        $this->beraterRepository = $beraterRepository;
    }

   public function initializeArguments()
   {
       parent::initializeArguments();
       $this->registerArgument('uid', 'int', 'uid', true);
       $this->registerArgument('feld', 'string', 'Feldabfrage', true);
       $this->registerArgument('as', 'string', 'Output', false, 'output');
   }

   public function render()
    {
        $uid = $this->arguments['uid'];
        $feld = $this->arguments['feld'];

        $berater = $this->beraterRepository->findByUid($uid);
     
        if ($berater === null) {
         return '';
        }


        switch($feld) {
         case 'reviewC32Status':
            $output = $berater->getReviewC32Status();
            break;
        case 'reviewC3Status':
            $output = $berater->getReviewC3Status();
            break;
        case 'reviewCommentTr':
            $output = $berater->getReviewCommentTr();
            break;
         }

         return $output;

    }
}