<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Event\AnsuchenBegutachtungsSchlussEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;

final class AnsuchenBegutachtungsSchlussListener
{
    public function __construct(protected readonly MailService $mailService)
    {
    }

    public function __invoke(AnsuchenBegutachtungsSchlussEvent $event)
    {
        // $mails = (new ExtensionConfiguration())->getEmailAddressGs();
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }

        $values = [
            'ansuchen' => $event->ansuchen,
            'stammdaten' => $event->stammdaten,
            'newStatus' => $event->ansuchen->getStatus(),
        ];

        $this->mailService->send('Notification/AnsuchenBegutachtungsSchluss', $mails, $values);
    }
}