<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\FileReference;
use GeorgRinger\Ieb\Domain\Property\TypeConverter\UploadedFileReferenceConverter;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Seo\IebTitleProvider;
use GeorgRinger\Ieb\Service\RelationLockService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;
use GeorgRinger\News\Pagination\QueryResultPaginator;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\Container\Container;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BaseController extends ActionController
{

    use CurrentUserTrait;

    protected RelationLockService $relationLockService;
    protected ExtensionConfiguration $extensionConfiguration;

    public function initializeAction()
    {
        $this->extensionConfiguration = new ExtensionConfiguration();
        $this->relationLockService = GeneralUtility::makeInstance(RelationLockService::class);
    }

    protected function initializeView($view)
    {
        $view->assignMultiple([
            'currentUser' => self::getCurrentUser(),
            'extensionConfiguration' => $this->extensionConfiguration,
        ]);
    }

    protected function check(AbstractEntity $item)
    {
        if (!$this->isObjectAllowedForCurrentUser($item)) {
            $this->addFlashMessage('Fehler bei PID check', '', AbstractMessage::ERROR);
            $this->redirect('index');
        }
    }

    protected function isObjectAllowedForCurrentUser(AbstractEntity $object): bool
    {
        if ($object->getPid() === 0) {
            return false;
        }
        $currentUser = self::getCurrentUser();
        if (!$currentUser) {
            return false;
        }
        return $object->getPid() === $currentUser['pid'];
    }

    protected function setTypeConverterConfigurationForImageUpload($argumentName)
    {
        $mapping = [
            'berater' => ['lebenslauf', 'qualifikationsnachweise'],
            'newBerater' => ['lebenslauf', 'qualifikationsnachweise'],
            'stammdaten' => ['nachweis', 'leitbildDatei', 'qmsZertifikatDatei', 'qualitaetPersonalDatei', 'qualitaetSicherungDatei', 'pruefbescheidDatei'],
            'newStammdaten' => ['nachweis', 'leitbildDatei', 'qmsZertifikatDatei', 'qualitaetPersonalDatei', 'qualitaetSicherungDatei', 'pruefbescheidDatei'],
            'angebotVerantwortlich' => ['lebenslaufDatei'],
            'newAngebotVerantwortlich' => ['lebenslaufDatei'],
            'trainer' => ['qualifikationBabiDatei', 'lehrBefugnisDatei', 'qualifikationPsaDatei', 'lebenslaufDatei'],
            'newTrainer' => ['qualifikationBabiDatei', 'lehrBefugnisDatei', 'qualifikationPsaDatei', 'lebenslaufDatei'],
            'ansuchen' => ['uebersichtDatei', 'zielgruppenAnspracheDatei', 'lernziele', 'lernstandserhebung', 'diversity', 'beratungDatei', 'pruefbescheidDatei', 'kooperationDatei'],
            'newAnsuchen' => ['uebersichtDatei', 'zielgruppenAnspracheDatei', 'lernziele', 'lernstandserhebung', 'diversity', 'beratungDatei', 'pruefbescheidDatei', 'kooperationDatei'],
        ];
        if (!isset($mapping[$argumentName])) {
            throw new \RuntimeException(sprintf('Argument "%s" not found in image conversion configuration', $argumentName), 1673611646);
        }

        GeneralUtility::makeInstance(Container::class)
            ->registerImplementation(
                \TYPO3\CMS\Extbase\Domain\Model\FileReference::class,
                FileReference::class
            );

        $uploadFolder = AnsuchenUtility::getFilePath(self::getCurrentUserPid());
        // if folder does not exist
        $path = Environment::getPublicPath() . '/fileadmin/' . str_replace('1:/', '', $uploadFolder);
        if (!is_dir($path)) {
            // create folder
            GeneralUtility::mkdir_deep($path);
        }

        $uploadConfiguration = [
            UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => $uploadFolder,
        ];
        /** @var PropertyMappingConfiguration $newExampleConfiguration */
        $newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();

        foreach ($mapping[$argumentName] as $property) {
            $newExampleConfiguration->forProperty($property)
                ->setTypeConverterOptions(
                    UploadedFileReferenceConverter::class,
                    $uploadConfiguration
                );
        }

//        $newExampleConfiguration->forProperty('imageCollection.0')
//            ->setTypeConverterOptions(
//                UploadedFileReferenceConverter::class,
//                $uploadConfiguration
//            );
    }

    /**
     * @param $argumentName
     */
    protected function setTypeConverterConfigurationForDate(string $argumentName, string $property): void
    {
        if (!isset($this->arguments[$argumentName])) {
            return;
        }
        /** @var PropertyMappingConfiguration $mappingConfiguration */
        $mappingConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
        $mappingConfiguration
            ->forProperty($property)
            ->setTypeConverterOption(
                DateTimeConverter::class,
                DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                'd.m.Y'
            );

    }

    public function setTitleTag($title): void
    {
        GeneralUtility::makeInstance(IebTitleProvider::class)->setTitle($title);
    }

    public function translate(string $key, string $fallback = ''): string
    {
        $label = LocalizationUtility::translate($key, 'ieb');
        return $label ?: $fallback;
    }

    protected function getPropertiesOfBegutachtung($object): array
    {
        $properties = ObjectAccess::getGettableProperties($object);
        foreach (['stammdatenId', 'ansuchenId', 'trainerId', 'beraterId', 'pid', 'uid'] as $property) {
            unset($properties[$property]);
        }
        return $properties;
    }

    protected function deleteFiles(array $fileDelete, AbstractEntity $object): void
    {
//        DebuggerUtility::var_dump($fileDelete);die;
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_file_reference');
        foreach ($fileDelete as $propertyType => $deletes) {
            $split = explode('_', $propertyType);
            $property = $split[1];
            foreach ($deletes as $fileId => $action) {
                if ($action !== '1') {
                    continue;
                }
                $fileId = (int)$fileId;
                $getter = 'get' . ucfirst($property);
//DebuggerUtility::var_dump($split);
                if ($split[0] === 's') {
                    $file = $object->$getter();
                    if ($file && $file->getUid() === $fileId) {
                        $connection->update('sys_file_reference', ['deleted' => 1], ['uid' => $fileId]);
                    }
                } elseif ($split[0] === 'm') {
                    /** @var ObjectStorage $files */
                    $files = $object->$getter();
                    foreach ($files as $file) {
                        if ($file->getUid() === $fileId) {
                            //DebuggerUtility::var_dump([$split, $fileId, $files]);
                            $connection->update('sys_file_reference', ['deleted' => 1], ['uid' => $fileId]);
                        }
                    }
                }
            }
        }
    }

    protected function getPaginator(QueryResultInterface|array $items, int $itemsPerPage = 20): ArrayPaginator|QueryResultPaginator
    {
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        if (is_array($items)) {
            $paginator = new ArrayPaginator($items, $currentPage, $itemsPerPage);
        } elseif ($items instanceof QueryResultInterface) {
            $paginator = new QueryResultPaginator($items, $currentPage, $itemsPerPage);
        } else {
            throw new \RuntimeException(sprintf('Only array and query result interface allowed for pagination, given "%s"', get_class($items)), 1611168593);
        }
        return $paginator;
    }

}
