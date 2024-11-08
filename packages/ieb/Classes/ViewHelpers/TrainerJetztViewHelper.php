<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use GeorgRinger\Ieb\Domain\Repository\TrainerRepository;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class TrainerJetztViewHelper extends AbstractViewHelper
{
   /**
     * @var GeorgRinger\Ieb\Domain\Repository\TrainerRepository
     */
    protected $trainerRepository;


     /**
     * TrainerRepository
     *
     * @param GeorgRinger\Ieb\Domain\Repository\TrainerRepository $trainerRepository
     */
    public function injectTrainerRepository(TrainerRepository $trainerRepository): void
    {
        $this->trainerRepository = $trainerRepository;
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

        $trainer = $this->trainerRepository->findByUid($uid);
     
        if ($trainer === null) {
         return '';
        }

        switch($feld) {
        case 'reviewC21BabiStatus':
            $output = $berater->getReviewC21BabiStatus();
            break;
        case 'reviewC21BabiStatus':
            $output = $berater->getReviewC21PsaStatus();
            break;
        case 'reviewC22BabiStatus':
            $output = $berater->getReviewC22BabiStatus();
            break;
        case 'reviewC22BabiStatus':
            $output = $berater->getReviewC22PsaStatus();
            break;
        case 'reviewC2BabiCommentTr':
            $output = $berater->getReviewC2BabiCommentTr();
            break;
        case 'reviewC2PsaCommentTr':
            $output = $berater->getReviewC2PsaCommentTr();
            break;

        
         
         }

         return $output;

    }
}