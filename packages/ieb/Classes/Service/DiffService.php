<?php

namespace GeorgRinger\Ieb\Service;

use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use Rogervila\ArrayDiffMultidimensional;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DiffService
{

    public function __construct(
        protected readonly array $forcedOverlayCurrent = [],
        protected readonly array $forcedOverlayPrevious = []
    )
    {

    }

    public function generateDiff(int $ansuchenId, int $basedOn): array
    {
        $final = [];

        $current = $this->getRaw($ansuchenId, $this->forcedOverlayCurrent);
        $previous = $this->getRaw($basedOn, $this->forcedOverlayPrevious);

        if ($previous && (($current['pid'] ?? 0) !== ($previous['pid'] ?? 0))) {
            throw new \UnexpectedValueException('Cannot compare ansuchen with different pid');
        }

//        $current = $this->getRaw(22);
//        $previous = $this->getRaw(12);

        $modifiedOrAdded = ArrayDiffMultidimensional::compare($current, $previous);
//        DebuggerUtility::var_dump($modifiedOrAdded);die;
        foreach ($modifiedOrAdded as $field => $change) {
            if (is_scalar($change)) {
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
                    } elseif (is_scalar($rel)) {
                        $final[$field][$id]['previous'] = $previous[$field][$id] ?? null;
                        $final[$field][$id]['current'] = $current[$field][$id] ?? null;
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

    protected function getRaw(int $id, array $overlay = []): array
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

        if (!$row) {
            return [];
        }

        $row = array_merge($row, $overlay);

        foreach (['tstamp', 'crdate', 'version', 'version_based_on', 'version_active', 'status', 'cruser_id', 'locked_by'] as $field) {
            unset($row[$field]);
        }
        // json fields
        foreach (['copy_stammdaten', 'copy_berater', 'copy_trainer', 'copy_standorte', 'copy_verantwortliche', 'copy_verantwortliche_mail'] as $field) {
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
//DebuggerUtility::var_dump($row);
        // bundesland
        $bl = array_column(BundeslandEnum::cases(), 'name', 'value');
        $row['bundesland'] = $bl[$row['bundesland']] ?? 'error mit bundesland';

        return $row;
    }
}