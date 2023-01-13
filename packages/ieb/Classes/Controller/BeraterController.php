<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Berater;
use GeorgRinger\Ieb\Domain\Model\Dto\BeraterSearch;
use GeorgRinger\Ieb\Domain\Model\FileReference;
use GeorgRinger\Ieb\Domain\Model\Trainer;
use GeorgRinger\Ieb\Domain\Property\TypeConverter\UploadedFileReferenceConverter;
use GeorgRinger\Ieb\Domain\Repository\BeraterRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class BeraterController extends BaseController
{

    protected BeraterRepository $beraterRepository;

    public function injectBeraterRepository(BeraterRepository $BeraterRepository)
    {
        $this->beraterRepository = $BeraterRepository;
    }

    public function indexAction(BeraterSearch $beraterSearch = null): ResponseInterface
    {
        $this->view->assignMultiple([
            'beraters' => $this->beraterRepository->findBySearch($beraterSearch),
            'beraterSearch' => $beraterSearch,
        ]);
        return $this->htmlResponse();
    }

    public function showAction(Trainer $trainer): ResponseInterface
    {
        $this->view->assign('trainer', $trainer);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function initializeCreateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('newBerater');
    }

    public function initializeUpdateAction()
    {
        $this->setTypeConverterConfigurationForImageUpload('berater');
    }


    public function createAction(Berater $newBerater)
    {
        $this->beraterRepository->add($newBerater);
        $this->redirect('index');
    }

    public function editAction(Berater $berater): ResponseInterface
    {
        $this->check($berater);
        $this->view->assign('berater', $berater);
        return $this->htmlResponse();
    }

    public function updateAction(Berater $berater)
    {
        $this->check($berater);
        $this->beraterRepository->update($berater);
        $this->redirect('index');
    }

    public function deleteAction(Berater $berater)
    {
        $this->check($berater);
        $this->beraterRepository->remove($berater);
        $this->redirect('index');
    }

    protected function setTypeConverterConfigurationForImageUpload($argumentName)
    {
        \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
            ->registerImplementation(
                \TYPO3\CMS\Extbase\Domain\Model\FileReference::class,
                FileReference::class
            );

        $uploadConfiguration = [
            UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/',
        ];
        /** @var PropertyMappingConfiguration $newExampleConfiguration */
        $newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
        $newExampleConfiguration->forProperty('lebenslauf')
            ->setTypeConverterOptions(
                UploadedFileReferenceConverter::class,
                $uploadConfiguration
            );
//        $newExampleConfiguration->forProperty('imageCollection.0')
//            ->setTypeConverterOptions(
//                UploadedFileReferenceConverter::class,
//                $uploadConfiguration
//            );
    }
}
