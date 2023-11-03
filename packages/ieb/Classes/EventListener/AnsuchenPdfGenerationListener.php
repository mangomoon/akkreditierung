<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
use GeorgRinger\Ieb\Domain\Model\Ansuchen;
use GeorgRinger\Ieb\Event\AnsuchenBegutachtungFinalizeEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\DuplicationBehavior;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

final class AnsuchenPdfGenerationListener
{

    protected ResourceFactory $resourceFactory;

    public function __construct()
    {
        $this->resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
    }

    public function __invoke(AnsuchenBegutachtungFinalizeEvent $event): void
    {
        if (!in_array($event->ansuchen->getStatus(), [AnsuchenStatus::AKKREDITIERT->value, AnsuchenStatus::AKKREDITIERT_MIT_AUFLAGEN->value], true)) {
            return;
        }

        $pdf = $this->getPdfString($event);
        $this->writeFile($pdf, $event->ansuchen);
    }

    private function writeFile(string $pdf, Ansuchen $ansuchen): void
    {
        $tmpFile = GeneralUtility::tempnam('ieb', 'pdf');
        GeneralUtility::writeFile($tmpFile, $pdf);
        $storage = $this->resourceFactory->getDefaultStorage();
        if (!$storage) {
            die('No storage found');
        }
        $directory = str_replace('1:/', '', AnsuchenUtility::getFilePath($ansuchen->getPid()));

        $ansuchenStatus = $ansuchen->getStatus();
        if ($ansuchenStatus === AnsuchenStatus::AKKREDITIERT->value) {
            $ansuchenStatus = '_akkreditiert';
        } elseif ($ansuchenStatus === AnsuchenStatus::AKKREDITIERT_MIT_AUFLAGEN->value) {
            $ansuchenStatus = '_akkreditiert-mit-Auflagen';
        }
        try {
            $targetFileName = $ansuchen->getNummer() . '_' . date_format($ansuchen->getAkkreditierungDatum(), 'Y-m-d') . $ansuchenStatus . '_' . $ansuchen->getUid() . '.pdf';
            $potentialFile = $storage->addFile($tmpFile, $storage->getFolder($directory), $targetFileName, DuplicationBehavior::RENAME);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }

        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_ieb_domain_model_ansuchen');

        if (!$potentialFile) {
            die('PDF could not be created for ansuchen: ' . $ansuchen->getUid());
        }

        $connection->insert('sys_file_reference', [
            'table_local' => 'sys_file',
            'uid_local' => $potentialFile->getUid(),
            'tablenames' => 'tx_ieb_domain_model_ansuchen',
            'uid_foreign' => $ansuchen->getUid(),
            'fieldname' => 'akkreditierung_pdf',
            'pid' => $ansuchen->getPid(),
        ]);

        $connection->update(
            'tx_ieb_domain_model_ansuchen',
            ['akkreditierung_pdf' => 1],
            ['uid' => $ansuchen->getUid()]);
    }

    private function getPdfString(AnsuchenBegutachtungFinalizeEvent $event): string
    {
        $standaloneView = GeneralUtility::makeInstance(StandaloneView::class);
        $templatePath = GeneralUtility::getFileAbsFileName('EXT:ieb/Resources/Private/Templates/Ansuchen/CertificateDownload.html');

        $standaloneView->setFormat('html');
        $standaloneView->setTemplatePathAndFilename($templatePath);
        $standaloneView->assignMultiple([
            'ansuchen' => $event->ansuchen,
            'stammdaten' => $event->stammdaten,
            'extensionConfiguration' => new ExtensionConfiguration(),
            'outputDestination' => 'string',
        ]);

        return $standaloneView->render();
    }
}