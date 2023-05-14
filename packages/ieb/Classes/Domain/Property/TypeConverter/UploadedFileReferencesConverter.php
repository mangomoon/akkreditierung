<?php

namespace GeorgRinger\Ieb\Domain\Property\TypeConverter;


use GeorgRinger\Ieb\Domain\Model\FileReference;
use TYPO3\CMS\Core\Resource\DuplicationBehavior;
use TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException;
use TYPO3\CMS\Core\Resource\File as FalFile;
use TYPO3\CMS\Core\Resource\FileReference as FalFileReference;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\Security\FileNameValidator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Error\Error;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Property\Exception\TypeConverterException;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;

/**
 * Class UploadedFileReferenceConverter
 */
class UploadedFileReferencesConverter extends AbstractTypeConverter
{

    /**
     * Folder where the file upload should go to (including storage).
     */
    const CONFIGURATION_UPLOAD_FOLDER = 1;

    /**
     * How to handle a upload when the name of the uploaded file conflicts.
     */
    const CONFIGURATION_UPLOAD_CONFLICT_MODE = 2;

    /**
     * Whether to replace an already present resource.
     * Useful for "maxitems = 1" fields and properties
     * with no ObjectStorage annotation.
     */
    const CONFIGURATION_ALLOWED_FILE_EXTENSIONS = 4;

    /**
     * @var string
     */
    protected $defaultUploadFolder = '1:/user_upload/';

    /**
     * @var array<string>
     */
    protected $sourceTypes = ['array'];

    /**
     * @var string
     */
    protected $targetType = ObjectStorage::class;

    /**
     * Take precedence over the available FileReferenceConverter
     */
    protected $priority = 30;

    protected ResourceFactory $resourceFactory;
    protected HashService $hashService;
    protected PersistenceManager $persistenceManager;


    public function injectResourceFactory(ResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
    }

    public function injectHashService(HashService $hashService)
    {
        $this->hashService = $hashService;
    }

    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * @var \TYPO3\CMS\Core\Resource\FileInterface[]
     */
    protected $convertedResources = [];

    /**
     * Actually convert from $source to $targetType, taking into account the fully
     * built $convertedChildProperties and $configuration.
     *
     * @param array $source
     * @param string $targetType
     * @param array $convertedChildProperties
     * @param \TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface $configuration
     * @throws \TYPO3\CMS\Extbase\Property\Exception
     * @api
     */
    public function convertFrom($sources, $targetType, array $convertedChildProperties = [], PropertyMappingConfigurationInterface $configuration = null)
    {
        $out = new ObjectStorage();
        foreach ($sources ?? [] as $source) {
            $skip = false;
            if (!isset($source['error']) || $source['error'] === \UPLOAD_ERR_NO_FILE) {
                if (isset($source['submittedFile']['resourcePointer'])) {
                    try {
                        $resourcePointer = $this->hashService->validateAndStripHmac($source['submittedFile']['resourcePointer']);
                        if (strpos($resourcePointer, 'file:') === 0) {
                            $fileUid = substr($resourcePointer, 5);
                            $someFile = $this->createFileReferenceFromFalFileObject($this->resourceFactory->getFileObject($fileUid));
                        } else {
                            $someFile= $this->createFileReferenceFromFalFileReferenceObject($this->resourceFactory->getFileReferenceObject($resourcePointer), $resourcePointer);
                        }
                        $out->attach($someFile);
                    } catch (\InvalidArgumentException $e) {
                        // Nothing to do. No file is uploaded and resource pointer is invalid. Discard!
                    }
                }
            }

            if ($source['error'] !== \UPLOAD_ERR_OK) {
                switch ($source['error']) {
                    case \UPLOAD_ERR_INI_SIZE:
                    case \UPLOAD_ERR_FORM_SIZE:
                    case \UPLOAD_ERR_PARTIAL:
                        return new Error('Error Code: ' . $source['error'], 1264440823);
                    default:
                        return new Error('An error occurred while uploading. Please try again or contact the administrator if the problem remains', 1340193849);
                }
            }

            // todo
//            if (isset($this->convertedResources[$source['tmp_name']])) {
//                return $this->convertedResources[$source['tmp_name']];
//            }

            try {
                $someFile = $this->importUploadedResource($source, $configuration);
                $out->attach($someFile);
            } catch (\Exception $e) {
                return new Error($e->getMessage(), $e->getCode());
            }

            $this->convertedResources[$source['tmp_name']] = $someFile;
        }
        return $out;
    }

    /**
     * Import a resource and respect configuration given for properties
     *
     * @param array $uploadInfo
     * @param PropertyMappingConfigurationInterface $configuration
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @throws TypeConverterException
     * @throws ExistingTargetFileNameException
     */
    protected function importUploadedResource(array $uploadInfo, PropertyMappingConfigurationInterface $configuration)
    {
        if (!GeneralUtility::makeInstance(FileNameValidator::class)->isValid($uploadInfo['name'])) {
            throw new TypeConverterException('Uploading files with PHP file extensions is not allowed!', 1399312430);
        }

        $allowedFileExtensions = $configuration->getConfigurationValue('Helhum\\UploadExample\\Property\\TypeConverter\\UploadedFileReferenceConverter', self::CONFIGURATION_ALLOWED_FILE_EXTENSIONS);

        if ($allowedFileExtensions !== null) {
            $filePathInfo = PathUtility::pathinfo($uploadInfo['name']);
            if (!GeneralUtility::inList($allowedFileExtensions, strtolower($filePathInfo['extension']))) {
                throw new TypeConverterException('File extension is not allowed!', 1399312430);
            }
        }

        $uploadFolderId = $configuration->getConfigurationValue(UploadedFileReferencesConverter::class, self::CONFIGURATION_UPLOAD_FOLDER) ?: $this->defaultUploadFolder;
        if (class_exists(DuplicationBehavior::class)) {
            $defaultConflictMode = \TYPO3\CMS\Core\Resource\DuplicationBehavior::RENAME;
        } else {
            // @deprecated since 7.6 will be removed once 6.2 support is removed
            $defaultConflictMode = 'changeName';
        }
        $conflictMode = $configuration->getConfigurationValue(UploadedFileReferencesConverter::class, self::CONFIGURATION_UPLOAD_CONFLICT_MODE) ?: $defaultConflictMode;

        $uploadFolder = $this->resourceFactory->retrieveFileOrFolderObject($uploadFolderId);
        $uploadedFile = $uploadFolder->addUploadedFile($uploadInfo, $conflictMode);

        $resourcePointer = isset($uploadInfo['submittedFile']['resourcePointer']) && strpos($uploadInfo['submittedFile']['resourcePointer'], 'file:') === false
            ? $this->hashService->validateAndStripHmac($uploadInfo['submittedFile']['resourcePointer'])
            : null;

        $fileReferenceModel = $this->createFileReferenceFromFalFileObject($uploadedFile, $resourcePointer);

        return $fileReferenceModel;
    }

    /**
     * @param FalFile $file
     * @param int $resourcePointer
     * @return FileReference
     */
    protected function createFileReferenceFromFalFileObject(FalFile $file, $resourcePointer = null)
    {
        $fileReference = $this->resourceFactory->createFileReferenceObject(
            [
                'uid_local' => $file->getUid(),
                'uid_foreign' => uniqid('NEW_'),
                'uid' => uniqid('NEW_'),
                'crop' => null,
            ]
        );
        return $this->createFileReferenceFromFalFileReferenceObject($fileReference, $resourcePointer);
    }

    /**
     * @param FalFileReference $falFileReference
     * @param int $resourcePointer
     * @return FileReference
     */
    protected function createFileReferenceFromFalFileReferenceObject(FalFileReference $falFileReference, $resourcePointer = null)
    {
        if ($resourcePointer === null) {
            /** @var $fileReference FileReference */
            $fileReference = $this->objectManager->get(FileReference::class);
        } else {
            $fileReference = $this->persistenceManager->getObjectByIdentifier($resourcePointer, FileReference::class, false);
        }

        $fileReference->setOriginalResource($falFileReference);

        return $fileReference;
    }
}