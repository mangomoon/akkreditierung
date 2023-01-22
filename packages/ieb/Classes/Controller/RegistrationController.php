<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use GeorgRinger\Ieb\Domain\Model\Dto;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Annotation as Extbase;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class RegistrationController extends BaseController
{


    public function indexAction(): ResponseInterface
    {

        return $this->htmlResponse();
    }

    /**
     * @Extbase\IgnoreValidation("newBlog")
     */
    public function registrationFormAction(Dto\RegistrationForm $registrationForm = null)
    {
        $this->view->assignMultiple([
            'registrationForm' => $registrationForm,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @Extbase\Validate("GeorgRinger\Ieb\Domain\Validator\RegistrationFormValidator", param="registrationForm")
     */
    public function registrationSuccessAction(Dto\RegistrationForm $registrationForm)
    {
        $this->view->assign('registrationForm', $registrationForm);
        return $this->htmlResponse();
    }

    public function doubleOptInAction()
    {
        return $this->htmlResponse();
    }

}
