<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;

use GeorgRinger\Ieb\Domain\Model\FileReference;
use GeorgRinger\Ieb\Domain\Property\TypeConverter\UploadedFileReferenceConverter;
use GeorgRinger\Ieb\Domain\Repository\CurrentUserTrait;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;

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

    protected function initializeView($view)
    {
        $view->assignMultiple([
            'currentUser' => self::getCurrentUser(),
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


    protected function setTypeConverterConfigurationForImageUpload($argumentName, $uploadFolder = '1:/content')
    {
        $mapping = [
            'berater' => ['lebenslauf', 'qualifikationsnachweise'],
            'newBerater' => ['lebenslauf', 'qualifikationsnachweise'],
        ];
        if (!isset($mapping[$argumentName])) {
            throw new \RuntimeException(sprintf('Argument "%s" not found in image conversion configuration', $argumentName), 1673611646);
        }

        \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
            ->registerImplementation(
                \TYPO3\CMS\Extbase\Domain\Model\FileReference::class,
                FileReference::class
            );

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
}
