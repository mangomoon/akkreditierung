<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Repository;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use TYPO3\CMS\Backend\Utility\BackendUtility;

trait AnsuchenRepositoryTrait
{

    /**
     * See https://github.com/georgringer/ieb/issues/138
     * if status not in AnsuchenStatus::statusSichtbarDurchGs
     *  => use previous version
     */
    public function switchToParentVersion(array $rows): array
    {
        $newRows = [];
        
        foreach ($rows as $row) {
            
            
            if (is_array($row)) {
                $uid = $row['uid'];
                //var_dump($uid);
                if ($row['version_based_on'] > 0 && !in_array($row['status'], AnsuchenStatus::statusSichtbarDurchGs(), true)) {
                    $previous = BackendUtility::getRecord('tx_ieb_domain_model_ansuchen', $row['version_based_on']);
                    if ($previous) {
                        foreach (['stammdatenMarkenname', 'stammdatenName'] as $copyFields) {
                            if (isset($row[$copyFields])) {
                                $previous[$copyFields] = $row[$copyFields];
                            }
                        }
                        $previous['lastuid']=$uid;
                        $newRows[] = $previous;
                    }
                } else {
                    $previous['lastuid']=$uid;
                    $newRows[] = $row;
                }
            } elseif($row instanceof Ansuchen) {
                // wenn external View
                $uid = $row->getUid();

                if ($row->getVersionBasedOn() > 0) {

                    
                    $previous = $this->ansuchenRepository->findByIdentifier($row->getVersionBasedOn());
                    if ($previous) {
                        $previous->lastuid = $uid;
                        $newRows[] = $previous;
                    }
                    
                    
                    // m...
                    foreach ($newRows as $row) {
                        if ($row['version_based_on'] && !in_array($row->getStatus(), AnsuchenStatus::statusSichtbarDurchGs(), true)) {
                            $previous = $this->ansuchenRepository->findByIdentifier($newRows->getVersionBasedOn());
                            // $uidn = $previous->getUid();
                            // var_dump($uidn);
                            if ($previous) {
                                $previous->lastuid = $uid;
                                $newRows[] = $previous;
                            }
                        }
                    }
                    // m... ENDE
                    
                } else {
                    //$previous->lastuid = $uid;
                    $newRows[] = $row;                   
                }
            }
        }

        return $newRows;
    }
}