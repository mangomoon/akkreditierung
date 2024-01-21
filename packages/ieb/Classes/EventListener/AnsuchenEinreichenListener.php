<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Event\AnsuchenEinreichenEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;

final class AnsuchenEinreichenListener
{
    public function __construct(protected readonly MailService $mailService)
    {
    }

    public function __invoke(AnsuchenEinreichenEvent $event)
    {
        $this->duplicateStammdatenToOtherAnsuchen($event);
        $this->sendMail($event);
    }

    /**
     * @see https://github.com/georgringer/ieb/issues/94
     *
     * Wenn EIN akkreditiertes (oder mit Auflagen akkreditiertes) Ansuchen zur Nachakkreditierung eingereicht wird
     * und in der Begutachtung die Teil-Status reviewA1Status und reviewA2Status "ok" bleiben,
     * soll bei ALLEN Ansuchen dieses TR, die akkreditiert (oder akkr. mit Aufl.) sind, egal in welchem der Status (das entspricht statusAkkreditiert),
     * bei finalizeStatus, die copy_stammdaten aktualisiert werden, also die aktuellen copy_stammdaten dieses Ansuchens (also auch mit den möglicherweise neu eingtragenen Fristen zu Ö-Cert etc.) in die anderen kopiert werden.
     */
    protected function duplicateStammdatenToOtherAnsuchen(AnsuchenEinreichenEvent $event): void
    {
        $ansuchen = $event->ansuchen;
        $stammdaten = $event->stammdaten;
        if (in_array($ansuchen->getStatus(), [AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG->value, AnsuchenStatus::EINGEREICHT_ZUR_NACHAKKREDITIERUNG_ODER_AUFLAGENERFUELLUNG->value])
            && $stammdaten->getReviewA1Status()
            && $stammdaten->getReviewA2Status()
        ) {
            $table = 'tx_ieb_domain_model_ansuchen';
            $rawRow = BackendUtility::getRecord($table, $ansuchen->getUid());
            if (!$rawRow['copy_stammdaten']) {
                return;
            }
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_ieb_domain_model_ansuchen');
            $queryBuilder->update('tx_ieb_domain_model_ansuchen')
                ->where(
                    $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($rawRow['pid'], \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('version_active', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->in('status', $queryBuilder->createNamedParameter(AnsuchenStatus::statusAkkreditiert(), Connection::PARAM_INT_ARRAY)),
                )
                ->set('copy_stammdaten', $rawRow['copy_stammdaten'])
                ->execute();
        }
    }

    protected function sendMail(AnsuchenEinreichenEvent $event): void
    {
        $mails = AnsuchenUtility::getMailVeranwortliche($event->ansuchen);
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }

        $values = [
            'ansuchen' => $event->ansuchen,
            'newStatus' => $event->ansuchen->getStatus(),
            'previousStatus' => $event->previousStatus->value,
            'user' => $event->user,
            'stammdaten' => $event->stammdaten,
        ];

        $this->mailService->send('Notification/AnsuchenEinreichen', $mails, $values);
    }
}