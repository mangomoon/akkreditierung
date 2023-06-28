<?php

namespace GeorgRinger\Ieb\Service;

use DrLenux\ArraySmartDiff\ArrayDiff;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use Neos\Diff\Diff;
use Rogervila\ArrayDiffMultidimensional;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DiffService
{

    public function generateDiff(int $ansuchenId, int $basedOn): array
    {
        $final = [];

        $current = $this->getRaw($ansuchenId);
        $previous = $this->getRaw($basedOn);

        if (($current['pid'] ?? 0) !== ($previous['pid'] ?? 0)) {
            throw new \UnexpectedValueException('Cannot compare ansuchen with different pid');
        }
//        $current = $this->getRaw(22);
//        $previous = $this->getRaw(12);

        $modifiedOrAdded = ArrayDiffMultidimensional::compare($current, $previous);
        foreach ($modifiedOrAdded as $field => $change) {
            if (is_string($change)) {
                $final[$field]['previous'] = $previous[$field] ?? null;
                $final[$field]['current'] = $current[$field] ?? null;
            } elseif (is_array($change)) {
                foreach ($change as $id => $rel) {
                    if (is_array($rel)) {
                        foreach ($rel as $relField => $relChange) {
                            if (is_string($relChange)) {
                                $final[$field][$id][$relField]['previous'] = $previous[$field][$id][$relField] ?? null;
                                $final[$field][$id][$relField]['current'] = $current[$field][$id][$relField] ?? null;
                            } elseif (is_array($relChange)) {
                                foreach ($relChange as $relId => $relRel) {
                                    $final[$field][$id][$relField][$relId]['previous'] = $previous[$field][$id][$relField][$relId] ?? null;
                                    $final[$field][$id][$relField][$relId]['current'] = $current[$field][$id][$relField][$relId] ?? null;
                                }
                            }
                        }
                    }
                }
            }
        }


//        // todo check if something is *removed* in current
//        // todo what if a raw is empty!!
        $result2 = ArrayDiffMultidimensional::compare($previous, $current);

        foreach ($result2 as $field => $change) {
            if (is_string($change)) {
                if (!isset($final[$field])) {
                    $final[$field]['previous'] = $previous[$field] ?? null;
                    $final[$field]['current'] = $current[$field] ?? null;
                }
            } elseif (is_array($change)) {
                foreach ($change as $id => $rel) {
                    if (is_array($rel)) {
                        foreach ($rel as $relField => $relChange) {
                            if (is_string($relChange)) {
                                if (!isset($final[$field][$id][$relField])) {
                                    $final[$field][$id][$relField]['previous'] = $previous[$field][$id][$relField] ?? null;
                                    $final[$field][$id][$relField]['current'] = $current[$field][$id][$relField] ?? null;
                                }
                            } elseif (is_array($relChange)) {
                                foreach ($relChange as $relId => $relRel) {
                                    if (!isset($final[$field][$id][$relField][$relId])) {
                                        $final[$field][$id][$relField][$relId]['previous'] = $previous[$field][$id][$relField][$relId] ?? null;
                                        $final[$field][$id][$relField][$relId]['current'] = $current[$field][$id][$relField][$relId] ?? null;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

//        print_r($modifiedOrAdded);
//        print_r($final);
//        die;
        return $final;
    }

    protected function getRaw(int $id)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');

        $row = $queryBuilder
            ->select('*')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAssociative();

        foreach (['uid', 'tstamp', 'crdate', 'version', 'version_based_on', 'version_active', 'status'] as $field) {
            unset($row[$field]);
        }
        // json fields
        foreach (['copy_stammdaten', 'copy_berater', 'copy_trainer', 'copy_standorte'] as $field) {
            if (!empty($row[$field])) {
                $items = json_decode($row[$field], true);
                foreach ($items as $k => $item) {
                    if (isset($items[$k]['tstamp'])) {
                        unset($items[$k]['tstamp']);

                    }
                }
                $row[$field] = $items;
            }

        }

        // bundesland
        $bl = array_column(BundeslandEnum::cases(), 'name', 'value');
        $row['bundesland'] = $bl[$row['bundesland']] ?? 'error mit bundesland';

        return $row;
    }
}