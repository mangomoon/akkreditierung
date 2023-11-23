<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Event\AnsuchenBegutachtungFinalizeAfterSnapshotEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;

final class AnsuchenBegutachtungFinalizeListener
{
    public function __construct(protected readonly MailService $mailService)
    {
    }

    public function __invoke(AnsuchenBegutachtungFinalizeAfterSnapshotEvent $event)
    {
        $mails = AnsuchenUtility::getMailVeranwortliche($event->ansuchen);
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }

        $extensionConfiguration = new ExtensionConfiguration();
        $possibleMails = [];
        if ($event->ansuchen->getTyp() === 1) {
            $possibleMails = $extensionConfiguration->getEmailBabi();
        } elseif ($event->ansuchen->getTyp() === 2) {
            $possibleMails = $extensionConfiguration->getEmailPsa();
        }

        $status = $event->ansuchen->getStatus();
        if ($status == 100 || $status == 140 || $status == 800 || $status == 810) {

            $mailsOfBundesland = $possibleMails[$event->ansuchen->getBundesland()] ?? false;
            if ($mailsOfBundesland) {
                if (is_array($mailsOfBundesland)) {
                    foreach($mailsOfBundesland as $mail) {
                        $mails[$mail] = '';
                    }
                } elseif(is_string($mailsOfBundesland)) {
                    $mails[$mailsOfBundesland] = '';
                }
            }
        }


        $values = [
            'ansuchen' => $event->ansuchen,
            'newStatus' => $event->ansuchen->getStatus(),
        ];

        $this->mailService->send('Notification/AnsuchenBegutachtungFinalize', $mails, $values);
    }
}