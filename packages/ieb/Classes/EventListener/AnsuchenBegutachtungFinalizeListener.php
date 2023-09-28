<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Event\AnsuchenBegutachtungFinalizeEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;

final class AnsuchenBegutachtungFinalizeListener
{
    public function __construct(protected readonly MailService $mailService)
    {
    }

    public function __invoke(AnsuchenBegutachtungFinalizeEvent $event)
    {
        $mails = AnsuchenUtility::getMailVeranwortliche($event->ansuchen);
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }

        $values = [
            'ansuchen' => $event->ansuchen,
            'newStatus' => $event->ansuchen->getStatus(),
        ];

        $this->mailService->send('Notification/AnsuchenBegutachtungFinalize', $mails, $values);
    }
}