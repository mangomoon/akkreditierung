<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Domain\Model\User;
use GeorgRinger\Ieb\Event\AnsuchenZuteilungEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class AnsuchenZuteilungListener
{
    public function __construct(protected readonly MailService $mailService)
    {
    }

    public function __invoke(AnsuchenZuteilungEvent $event)
    {
        $ansuchen = $event->ansuchen;
        //$mails = AnsuchenUtility::getMailVeranwortliche($ansuchen);
        $gsEmail = (new ExtensionConfiguration())->getEmailAddressGs();
        if ($gsEmail) {
            $mails[$gsEmail] = '';
        }
        $this->addEmailFromGutachter($mails, $ansuchen->getGutachter1());
        $this->addEmailFromGutachter($mails, $ansuchen->getGutachter2());

        $values = [
            'ansuchen' => $ansuchen,
            'stammdaten' => $event->stammdaten,
        ];

        $this->mailService->send('Notification/AnsuchenZuteilung', $mails, $values);
    }

    private function addEmailFromGutachter(array &$emailAddresses, ?User $user): void
    {
        if ($user && GeneralUtility::validEmail($user->getEmail())) {
            $emailAddresses[$user->getEmail()] = $user->getFullName();
        }
    }
}