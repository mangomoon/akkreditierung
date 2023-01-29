<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MailUtility;

class MailService
{

    public function send(array $assignedValues, string $templateName, string $recipientEmail, string $recipientName): void
    {
        $mailMessage = GeneralUtility::makeInstance(FluidEmail::class);
        $mailMessage->to(new Address($recipientEmail, $recipientName));
        $mailMessage->from(new Address(MailUtility::getSystemFromAddress(), MailUtility::getSystemFromName()));
        $mailMessage->format(FluidEmail::FORMAT_HTML);
        
        $mailMessage->assignMultiple($assignedValues);
        $mailMessage->setTemplate($templateName);
        GeneralUtility::makeInstance(Mailer::class)->send($mailMessage);
    }
}