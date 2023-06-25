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

    public function generateDiff(Ansuchen $ansuchen)
    {

        $current = $this->getRaw($ansuchen->getUid());
//        $current = $this->getRaw(22);
        $previous = $this->getRaw($ansuchen->getVersionBasedOn());
//        $previous = $this->getRaw(12);

//        unset($current['copy_trainer'][1]);
        $result = ArrayDiffMultidimensional::compare($current, $previous);

        // todo check if something is *removed* in current
        // todo what if a raw is empty!!
        $result2 = ArrayDiffMultidimensional::compare($previous, $current);
//        print_r($result);
//        print_r($result2);
//        return $result;
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