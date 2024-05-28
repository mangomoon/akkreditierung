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
                if ($row['version_based_on'] > 0 && !in_array($row['status'], AnsuchenStatus::statusSichtbarDurchGs(), true)) {
                    $previous = BackendUtility::getRecord('tx_ieb_domain_model_ansuchen', $row['version_based_on']);
                    if ($previous) {
                        foreach (['stammdatenMarkenname', 'stammdatenName'] as $copyFields) {
                            if (isset($row[$copyFields])) {
                                $previous[$copyFields] = $row[$copyFields];
                            }
                        }
                        $newRows[] = $previous;
                    }
                } else {
                    $newRows[] = $row;
                }
            } elseif($row instanceof Ansuchen) {
                if ($row->getVersionBasedOn() > 0 && !in_array($row->getStatus(), AnsuchenStatus::statusSichtbarDurchGs(), true)) {
                    $previous = $this->ansuchenRepository->findByIdentifier($row->getVersionBasedOn());
                    if ($previous) {
                        $newRows[] = $previous;
                        
                    }
                } else {
                    $newRows[] = $row;                   
                }
            }
        }

        return $newRows;
    }
}