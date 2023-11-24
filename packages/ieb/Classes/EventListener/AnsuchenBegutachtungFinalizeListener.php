<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Domain\Enum\AnsuchenStatus;
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
        $mails = AnsuchenUtility::getMailVeranwortliche($event->ansuchenAfterSnapshot);
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }

        $extensionConfiguration = new ExtensionConfiguration();
        $possibleMails = [];
        if ($event->ansuchenAfterSnapshot->getTyp() === 1) {
            $possibleMails = $extensionConfiguration->getEmailBabi();
        } elseif ($event->ansuchenAfterSnapshot->getTyp() === 2) {
            $possibleMails = $extensionConfiguration->getEmailPsa();
        }

        $status = $event->ansuchenAfterSnapshot->getStatus();
        if (in_array($status, [AnsuchenStatus::AKKREDITIERT->value, AnsuchenStatus::AKKREDITIERT_MIT_AUFLAGEN->value, AnsuchenStatus::NICHT_AKKREDITERT->value, AnsuchenStatus::AKKREDITIERUNG_ENTZOGEN->value], true)) {

            $mailsOfBundesland = $possibleMails[$event->ansuchenAfterSnapshot->getBundesland()] ?? false;
            if ($mailsOfBundesland) {
                if (is_array($mailsOfBundesland)) {
                    foreach ($mailsOfBundesland as $mail) {
                        $mails[$mail] = '';
                    }
                } elseif (is_string($mailsOfBundesland)) {
                    $mails[$mailsOfBundesland] = '';
                }
            }
        }


        $values = [
            'ansuchen' => $event->ansuchenAfterSnapshot,
            'newStatus' => $event->ansuchenAfterSnapshot->getStatus(),
        ];

        $this->mailService->send('Notification/AnsuchenBegutachtungFinalize', $mails, $values);
    }
}