<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Event\AnsuchenZuteilungEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;

final class AnsuchenZuteilungListener
{
    public function __construct(protected readonly MailService $mailService)
    {
    }

    public function __invoke(AnsuchenZuteilungEvent $event)
    {
        $mails = AnsuchenUtility::getMailVeranwortliche($event->ansuchen);
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }

        $values = [
            'ansuchen' => $event->ansuchen,
        ];

        $this->mailService->send('Notification/AnsuchenZuteilung', $mails, $values);
    }
}