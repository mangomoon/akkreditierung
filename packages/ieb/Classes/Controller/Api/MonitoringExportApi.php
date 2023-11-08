<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller\Api;


use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Enum\BundeslandEnum;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MonitoringExportApi implements RequestHandlerInterface
{

    protected array $stammdaten = [];

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->getData();
        $data = $this->enrichData($data);
        return new JsonResponse($data);
    }

    protected function enrichData(array $data): array
    {
        $allCounties = array_column(BundeslandEnum::cases(), 'name', 'value');
        $allStatus = array_column(AnsuchenStatus::cases(), 'name', 'value');
        foreach ($data as &$ansuchen) {
            $ansuchen['bundesland'] = $allCounties[$ansuchen['bundesland']] ?? 'error';
            $ansuchen['status'] = $allStatus[$ansuchen['status']] ?? 'error';
            $ansuchen['stammdaten'] = $this->fetchStammdaten($ansuchen['pid']);

            
        }
        return $data;
    }

    protected function fetchStammdaten(int $pid)
    {
        if (!isset($this->stammdaten[$pid])) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_stammdaten');
            $row = $queryBuilder
                ->select('uid', 'name', 'strasse', 'plz', 'ort')
                ->from('tx_ieb_domain_model_stammdaten')
                ->where(
                    $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($pid, Connection::PARAM_INT)),
                )
                ->setMaxResults(1)
                ->orderBy('uid', 'desc')
                ->executeQuery()
                ->fetchAssociative();
            $this->stammdaten[$pid] = $row;
        }

        return $this->stammdaten[$pid];
    }

    protected function getData(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');

        return $queryBuilder
            ->select('uid', 'pid', 'nummer', 'name', 'typ', 'status', 'bundesland', 'akkreditierung_datum', 'kompetenz1', 'kompetenz2', 'kompetenz3', 'kompetenz4', 'kompetenz5', 'kompetenz_text1')
            ->from('tx_ieb_domain_model_ansuchen')
            ->where(
                $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, Connection::PARAM_INT)),
                $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusForMonitoringExport(), Connection::PARAM_INT_ARRAY))
            )
            ->orderBy('uid', 'ASC')
            ->executeQuery()
            ->fetchAllAssociative();
    }
}