<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenRepository;
use GeorgRinger\Ieb\Domain\Repository\AnsuchenArchivRepository;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use Psr\Http\Message\ResponseInterface;

class EsfController extends BaseController
{

    use CurrentUserTrait;

    protected AnsuchenRepository $ansuchenRepository;
    protected AnsuchenArchivRepository $ansuchenArchivRepository;

    public function indexAction(Ansuchen $ansuchen): ResponseInterface
    {
        if ($this->isPartOfGs()) {
            $this->collectSingleViewDataForGs($ansuchen);
            return $this->htmlResponse();
        } else {
            $this->check($ansuchen);
            $this->collectSingleViewData($ansuchen);
            return $this->htmlResponse();
        }
    }

    public function showAction(Ansuchen $ansuchen): ResponseInterface
    {
        $this->check($ansuchen);
        $this->collectSingleViewData($ansuchen);
        return $this->htmlResponse();
    }

    public function pdfAction(Ansuchen $ansuchen): ResponseInterface
    {
        if ($this->isPartOfGs() || $this->isPartOfBM()) {
            $this->collectSingleViewData($ansuchen);
            return $this->htmlResponse();
        } else {
            $this->check($ansuchen);
            $this->collectSingleViewData($ansuchen);
            return $this->htmlResponse();
        }
    }
    
    public function pdfgsAction(Ansuchen $ansuchen): ResponseInterface
    {
        if ($this->isPartOfGs()) {
            $this->collectSingleViewDataForGs($ansuchen);
            return $this->htmlResponse();
        } 
    }

    private function collectSingleViewData(Ansuchen $ansuchen): void
    {
        $versions = $this->ansuchenRepository->getAllEsfVersionsOfAnsuchen($ansuchen);
        $typ = $ansuchen->getTyp();
        $versionTrainer = array();
        $versionBerater = array();
        $versionProjektleitung = array();
        $versionStandort = array();
        $nextuid = array();

        $i = 0;
        $len = count($versions);

        foreach ($versions as $version) {

            
            $thisVersion = $version -> getVersion();
            $uid = $version->getUid();

            $nextVersion = $this ->ansuchenRepository->getNextAnsuchen($uid);
            
            //von ... bis
            $von = 0;
            if ($version->getAkkreditierungEntscheidungDatum() === $version->getTstamp()) {
                $von = $version->getAkkreditierungEntscheidungDatum();
            } else {
                $von = $version->getTstamp();
            }

            $bis = 0;
            if ($nextVersion !== 0) {
                if ($nextVersion->getAkkreditierungEntscheidungDatum() === $nextVersion->getTstamp()) {
                    $bis = $nextVersion->getAkkreditierungEntscheidungDatum();
                } else {
                    $bis = $nextVersion->getTstamp();
                }
            } 
            if ($i == $len - 1) {
                $bis = 0;
            }

            $trainer = array();
            $berater = array();
            $projektleitung = array();
            $standort = array();

            $trainerKomms = [];
            $beraterKomms = [];

            if ($nextVersion) {
                $trainerKomms = $nextVersion->getCopyTrainerData();
                $uidOfNextAnsuchen = $nextVersion -> getUid();
                $beraterKomms = $nextVersion->getCopyBeraterData();
            }
            

            //TRAINER
            $trainers = $version->getCopyTrainerData();
            $trainerInVersion = array();
            foreach ($trainers as $trainer) {
                
                $trainerInVersion['fullName'] = $trainer['fullName'];
                $trainerInVersion['nachname'] = $trainer['nachname'];
                $trainerInVersion['uid'] = $trainer['uid'];
                $trainerInVersion['von'] = $von;
                $trainerInVersion['bis'] = $bis;
                

                $reviewC21BabiStatus = $trainer['reviewC21BabiStatus'];
                $reviewC22BabiStatus = $trainer['reviewC22BabiStatus'];
                // $trainerInVersion['reviewC21BabiStatus'] = $reviewC21BabiStatus;
                // $trainerInVersion['reviewC22BabiStatus'] = $reviewC22BabiStatus;
                
                $reviewC21PsaStatus = $trainer['reviewC21PsaStatus'];
                $reviewC22PsaStatus = $trainer['reviewC22PsaStatus'];
                // $trainerInVersion['reviewC21PsaStatus'] = $reviewC21PsaStatus;
                // $trainerInVersion['reviewC22PsaStatus'] = $reviewC22PsaStatus;

                // $trainerInVersion['uidOfAnsuchen'] = $uid;
                // $trainerInVersion['uidOfNextAnsuchen'] = $uidOfNextAnsuchen;
                
                // Trainerdaten aus nächster Version
                if ($nextVersion) {
                    foreach ($trainerKomms as $trainerKomm) {
                        if ($trainerKomm['uid'] === $trainer['uid']) {

                            if ($thisVersion == 0) {
                                $reviewC21BabiStatus = $trainerKomm['reviewC21BabiStatus'];
                                $reviewC22BabiStatus = $trainerKomm['reviewC22BabiStatus'];
                                $reviewC21PsaStatus = $trainerKomm['reviewC21PsaStatus'];
                                $reviewC22PsaStatus = $trainerKomm['reviewC22PsaStatus'];
                            }

                            if ($typ === 1) {
                                if ($reviewC21BabiStatus > 2 || $reviewC22BabiStatus > 2) {
                                    $trainerInVersion['auflage'] = $trainerKomm['reviewC2BabiCommentTr'];
                                } else {
                                    $trainerInVersion['auflage'] = '';
                                }
                            } else {
                                if ($reviewC21PsaStatus > 2 || $reviewC22PsaStatus > 2) {
                                    $trainerInVersion['auflage'] = $trainerKomm['reviewC2PsaCommentTr'];
                                } else {
                                    $trainerInVersion['auflage'] = '';
                                }
                                $trainerInVersion['qualifikationPsa1'] = $trainerKomm['qualifikationPsa1'];
                                $trainerInVersion['qualifikationPsa2'] = $trainerKomm['qualifikationPsa2'];
                                //$trainerInVersion['qualifikationPsa3'] = $trainerKomm['qualifikationPsa3'];
                                if($trainer['qualifikationPsa3'] === TRUE && $trainerKomm['reviewC22Quali3'] === TRUE) {
                                    $trainerInVersion['qualifikationPsa3'] = TRUE;
                                }
                                $trainerInVersion['qualifikationPsa3'] = $trainerKomm['qualifikationPsa3'];
                                $trainerInVersion['qualifikationPsa4'] = $trainerKomm['qualifikationPsa4'];
                                $trainerInVersion['qualifikationPsa5'] = $trainerKomm['qualifikationPsa5'];
                                $trainerInVersion['qualifikationPsa6'] = $trainerKomm['qualifikationPsa6'];
                                $trainerInVersion['qualifikationPsa7'] = $trainerKomm['qualifikationPsa7'];
                                $trainerInVersion['qualifikationPsa8'] = $trainerKomm['qualifikationPsa8'];
                                $trainerInVersion['qualifikationPsaKommentar'] =  $trainerKomm['qualifikationPsaKommentar'];
                            } 
                            // $trainerInVersion['nextReviewC21BabiStatus'] = $trainerKomm['reviewC21BabiStatus'];
                            // $trainerInVersion['nextReviewC22BabiStatus'] = $trainerKomm['reviewC22BabiStatus'];
                            // $trainerInVersion['nextReviewC21PsaStatus'] = $reviewC21PsaStatus;
                            // $trainerInVersion['nextReviewC22PsaStatus'] = $reviewC22PsaStatus;
                            // $trainerInVersion['t'] = $trainerKomm['reviewC2PsaCommentTr'];
                            $trainerInVersion['t1'] = $trainer['qualifikationPsa3'];
                            $trainerInVersion['t2'] = $trainerKomm['reviewC22Quali3'];
                        } 
                    }
                } else {
                    if ($typ === 1) {
                        if ($reviewC21BabiStatus > 2 || $reviewC21BabiStatus > 2) {
                            $trainerInVersion['auflage'] = $trainer['reviewC2BabiCommentTr'];
                        }
                    } else {
                        if ($reviewC21PsaStatus > 2 || $reviewC22PsaStatus > 2) {
                            $trainerInVersion['auflage'] = $trainer['reviewC2PsaCommentTr'];
                        }
                        $trainerInVersion['qualifikationPsa1'] = $trainer['qualifikationPsa1'];
                        $trainerInVersion['qualifikationPsa2'] = $trainer['qualifikationPsa2'];
                        //$trainerInVersion['qualifikationPsa3'] = $trainer['qualifikationPsa3'];
                        if($trainer['reviewC22Quali3'] !== null && $trainer['qualifikationPsa3']) {
                                    $trainerInVersion['qualifikationPsa3'] = 1;
                           }
                        $trainerInVersion['qualifikationPsa4'] = $trainer['qualifikationPsa4'];
                        $trainerInVersion['qualifikationPsa5'] = $trainer['qualifikationPsa5'];
                        $trainerInVersion['qualifikationPsa6'] = $trainer['qualifikationPsa6'];
                        $trainerInVersion['qualifikationPsa7'] = $trainer['qualifikationPsa7'];
                        $trainerInVersion['qualifikationPsa8'] = $trainer['qualifikationPsa8'];
                        $trainerInVersion['qualifikationPsaKommentar'] =  $trainer['qualifikationPsaKommentar'];
                    } 
                }
                
                $versionTrainer[] = $trainerInVersion;
                // keep $versionTrainer sorted by 'nachname' (case-insensitive)
                usort($versionTrainer, static function(array $a, array $b): int {
                    return strcasecmp($a['nachname'] ?? '', $b['nachname'] ?? '');
                });
            }

            // BERATER
            $beraters = $version->getCopyBeraterData();
            
            foreach ($beraters as $berater) {
                $beraterInVersion = array();
                $beraterInVersion['fullName'] = $berater['fullName'];
                $beraterInVersion['nachname'] = $berater['nachname'];
                $beraterInVersion['uid'] = $berater['uid'];
                $beraterInVersion['uidOfAnsuchen'] = $uid;
                $beraterInVersion['von'] = $von;
                $beraterInVersion['bis'] = $bis;

                $reviewC3Status = $berater['reviewC3Status'];

                // Beraterdaten aus nächster Version
                if ($nextVersion) {
                    foreach ($beraterKomms as $beraterKomm) {
                        if ($beraterKomm['uid'] === $berater['uid']) {
                            if ($thisVersion == 0) {
                                $reviewC3Status = $beraterKomm['reviewC3Status'];
                            }
                            if ($beraterKomm['reviewC3Status'] > 2 || $beraterKomm['reviewC32Status'] >2) {
                                $beraterInVersion['auflage'] = $beraterKomm['reviewC3CommentTr'];
                            }
                        }
                    }
                } else {
                    if ($berater['reviewC3Status'] > 2 || $berater['reviewC32Status'] >2) {
                        $beraterInVersion['auflage'] = $berater['reviewC3CommentTr'];
                    }
                }
                $versionBerater[] = $beraterInVersion;
                usort($versionBerater, static function(array $a, array $b): int {
                    return strcasecmp($a['nachname'] ?? '', $b['nachname'] ?? '');
                });
            }

            // Projektleitung
            $projektleitungs = $version->getCopyVerantwortlicheData();
            foreach ($projektleitungs as $projektleitung) {
                $projektleitungInVersion = array();
                $projektleitungInVersion['fullName'] = $projektleitung['fullName'];
                $projektleitungInVersion['nachname'] = $projektleitung['nachname'];
                $projektleitungInVersion['von'] = $von;
                $projektleitungInVersion['bis'] = $bis;

                $versionProjektleitung[] = $projektleitungInVersion;
                usort($versionProjektleitung, static function(array $a, array $b): int {
                    return strcasecmp($a['nachname'] ?? '', $b['nachname'] ?? '');
                });
            }

            // Standorte
            $standorts = $version->getCopyStandorteData();
            foreach ($standorts as $standort) {
                $standortInVersion = array();
                $standortInVersion['name'] = $standort['name'];
                $standortInVersion['adresse'] = $standort['adresse'];
                $standortInVersion['plz'] = $standort['plz'];
                $standortInVersion['ort'] = $standort['ort'];
                $standortInVersion['von'] = $von;
                $standortInVersion['bis'] = $bis;

                $versionStandort[] = $standortInVersion;
                usort($versionStandort, static function(array $a, array $b): int {
                    return strcasecmp($a['name'] ?? '', $b['name'] ?? '');
                });
            }

            $i++;
        }
        $this->view->assignMultiple([
            'ansuchen' => $ansuchen,
            'versions' => $versions,
            'trainer' => $versionTrainer,
            'berater' => $versionBerater,
            'standorte' => $versionStandort,
            'projektleitung' => $versionProjektleitung,
        ]);
    }


    private function isPartOfGs(): bool
    {
        return in_array($this->extensionConfiguration->getUsergroupGs(), self::getCurrentUserGroups(), true);
    }
    private function isPartOfBM(): bool
    {
        return in_array($this->extensionConfiguration->getUsergroupBM(), self::getCurrentUserGroups(), true);
    }

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectAnsuchenArchivRepository(AnsuchenArchivRepository $ansuchenArchivRepository): void
    {
        $this->ansuchenArchivRepository = $ansuchenArchivRepository;
    }



}