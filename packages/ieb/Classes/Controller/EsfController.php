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
        if ($this->isPartOfGs()) {
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
        $bereich = $ansuchen->getTyp();
        $versionTrainer = array();
        $versionBerater = array();
        $versionProjektleitung = array();
        $versionStandort = array();
        $nextuid = array();
        foreach ($versions as $version) {

            
            
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
            if ($nextVersion !== null) {
                if ($nextVersion->getAkkreditierungEntscheidungDatum() === $nextVersion->getTstamp()) {
                    $bis = $nextVersion->getAkkreditierungEntscheidungDatum();
                } else {
                    $bis = $nextVersion->getTstamp();
                }
            } else {
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
            }
            if ($nextVersion) {
                $beraterKomms = $nextVersion->getCopyBeraterData();
            }
            

            //TRAINER
            $trainers = $ansuchen->getCopyTrainerData();
            
            foreach ($trainers as $trainer) {
                $trainerInVersion = array();
                $trainerInVersion['fullName'] = $trainer['fullName'];
                $trainerInVersion['nachname'] = $trainer['nachname'];
                $trainerInVersion['uid'] = $trainer['uid'];
                $trainerInVersion['von'] = $von;
                $trainerInVersion['bis'] = $bis;


                $trainerInVersion['uidOfAnsuchen'] = $uid;

                // Trainerdaten aus nächster Version
                foreach ($trainerKomms as $trainerKomm) {
                    if ($trainerKomm['uid'] === $trainer['uid']) {
                        if ($typ = 1) {
                            if ($trainerKomm['reviewC21BabiStatus'] > 2 || $trainerKomm['reviewC22BabiStatus'] > 2) {
                                $trainerInVersion['auflage'] = $trainerKomm['reviewC2BabiCommentTr'];
                            }
                        } else {
                            if ($trainerKomm['reviewC21PsaStatus'] > 2 || $trainerKomm['reviewC22PsaStatus'] > 2) {
                                $trainerInVersion['auflage'] = $trainerKomm['reviewC2PsaCommentTr'];
                                $trainerInVersion['qualifikationPsa1'] = $trainerKomm['qualifikationPsa1'];
                                $trainerInVersion['qualifikationPsa2'] = $trainerKomm['qualifikationPsa2'];
                                $trainerInVersion['qualifikationPsa3'] = $trainerKomm['qualifikationPsa3'];
                                $trainerInVersion['qualifikationPsa4'] = $trainerKomm['qualifikationPsa4'];
                                $trainerInVersion['qualifikationPsa5'] = $trainerKomm['qualifikationPsa5'];
                                $trainerInVersion['qualifikationPsa6'] = $trainerKomm['qualifikationPsa6'];
                                $trainerInVersion['qualifikationPsa7'] = $trainerKomm['qualifikationPsa7'];
                                $trainerInVersion['qualifikationPsa8'] = $trainerKomm['qualifikationPsa8'];
                                $trainerInVersion['qualifikationPsaKommentar'] = $trainerKomm['qualifikationPsaKommentar'];
                            }
                        } 
                    }
                }
                $versionTrainer[] = $trainerInVersion;
                // keep $versionTrainer sorted by 'nachname' (case-insensitive)
                usort($versionTrainer, static function(array $a, array $b): int {
                    return strcasecmp($a['nachname'] ?? '', $b['nachname'] ?? '');
                });
            }

            // BERATER
            $beraters = $ansuchen->getCopyBeraterData();
            
            foreach ($beraters as $berater) {
                $beraterInVersion = array();
                $beraterInVersion['fullName'] = $berater['fullName'];
                $beraterInVersion['nachname'] = $berater['nachname'];
                $beraterInVersion['uid'] = $berater['uid'];
                $beraterInVersion['uidOfAnsuchen'] = $uid;
                $beraterInVersion['von'] = $von;
                $beraterInVersion['bis'] = $bis;

                // Beraterdaten aus nächster Version
                foreach ($beraterKomms as $beraterKomm) {
                    if ($beraterKomm['uid'] === $berater['uid']) {
                        if ($beraterKomm['reviewC3Status'] >2 || $beraterKomm['reviewC32Status'] >2) {
                            $beraterInVersion['auflage'] = $beraterKomm['reviewC3CommentTr'];
                        }
                    }
                }
                $versionBerater[] = $beraterInVersion;
                usort($versionBerater, static function(array $a, array $b): int {
                    return strcasecmp($a['nachname'] ?? '', $b['nachname'] ?? '');
                });
            }

            // Projektleitung
            $projektleitungs = $ansuchen->getCopyVerantwortlicheData();
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
            $standorts = $ansuchen->getCopyStandorteData();
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

    public function injectAnsuchenRepository(AnsuchenRepository $ansuchenRepository): void
    {
        $this->ansuchenRepository = $ansuchenRepository;
    }

    public function injectAnsuchenArchivRepository(AnsuchenArchivRepository $ansuchenArchivRepository): void
    {
        $this->ansuchenArchivRepository = $ansuchenArchivRepository;
    }



}