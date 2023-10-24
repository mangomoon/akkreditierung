<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\EventListener;

use GeorgRinger\Ieb\Event\AnsuchenBegutachtungFinalizeEvent;
use GeorgRinger\Ieb\ExtensionConfiguration;
use GeorgRinger\Ieb\Service\MailService;
use GeorgRinger\Ieb\Utility\AnsuchenUtility;
use GeorgRinger\Ieb\Domain\Enum\Bundesland;

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

        $emailBabiBurgenland = (new ExtensionConfiguration())->getEmailBabiBurgenland();
        $emailBabiKärnten = (new ExtensionConfiguration())->getEmailBabiKärnten();
        $emailBabiNiederoesterreich = (new ExtensionConfiguration())->getEmailBabiNiederoesterreich();
        $emailBabiOberoesterreich = (new ExtensionConfiguration())->getEmailBabiOberoesterreich();
        $emailBabiSalzburg = (new ExtensionConfiguration())->getEmailBabiSalzburg();
        $emailBabiSteiermark = (new ExtensionConfiguration())->getEmailBabiSteiermark();
        $emailBabiTirol = (new ExtensionConfiguration())->getEmailBabiTirol();
        $emailBabiVorarlberg = (new ExtensionConfiguration())->getEmailBabiVorarlberg();
        $emailBabiWien = (new ExtensionConfiguration())->getEmailBabiWien();
        $emailPsaBurgenland = (new ExtensionConfiguration())->getEmailPsaBurgenland();
        $emailPsaKärnten = (new ExtensionConfiguration())->getEmailPsaKärnten();
        $emailPsaNiederoesterreich = (new ExtensionConfiguration())->getEmailPsaNiederoesterreich();
        $emailPsaOberoesterreich = (new ExtensionConfiguration())->getEmailPsaOberoesterreich();
        $emailPsaSalzburg = (new ExtensionConfiguration())->getEmailPsaSalzburg();
        $emailPsaSteiermark = (new ExtensionConfiguration())->getEmailPsaSteiermark();
        $emailPsaTirol = (new ExtensionConfiguration())->getEmailPsaTirol();
        $emailPsaVorarlberg = (new ExtensionConfiguration())->getEmailPsaVorarlberg();
        $emailPsaWien = (new ExtensionConfiguration())->getEmailPsaWien();

        // if ($event->ansuchen->getTyp() === 1) {
        //     $bundesland = $event->ansuchen->getBundesland();
        //     if ($bundesland) {
        //         switch ($bundesland) {
        //             case 1:
        //                 $mails[$emailBabiBurgenland] = '';
        //                 break;
        //             case 2:
        //                 $mails[$emailBabiKärnten] = '';
        //                 break;
        //             case 3:
        //                 $mails[$emailBabiNiederoesterreich] = '';
        //                 break;
        //             case 4:
        //                 $mails[$emailBabiOberoesterreich] = '';
        //                 break;
        //             case 5:
        //                 $mails[$emailBabiSalzburg] = '';
        //                 break;
        //             case 6:
        //                 $mails[$emailBabiSteiermark] = '';
        //                 break;
        //             case 7:
        //                 $mails[$emailBabiTirol] = '';
        //                 break;
        //             case 8:
        //                 $mails[$emailBabiVorarlberg] = '';
        //                 break;
        //             case 9:
        //                 $mails[$emailBabiWien] = '';
        //                 break;
        //         }
        //     }
        // } else if ($event->ansuchen->getTyp() === 2) {
        //     $bundesland = $event->ansuchen->getBundesland();
        //     if ($bundesland) {
        //         switch ($bundesland) {
        //             case 1:
        //                 $mails[$emailPsaBurgenland] = '';
        //                 break;
        //             case 2:
        //                 $mails[$emailPsaKärnten] = '';
        //                 break;
        //             case 3:
        //                 $mails[$emailPsaNiederoesterreich] = '';
        //                 break;
        //             case 4:
        //                 $mails[$emailPsaOberoesterreich] = '';
        //                 break;
        //             case 5:
        //                 $mails[$emailPsaSalzburg] = '';
        //                 break;
        //             case 6:
        //                 $mails[$emailPsaSteiermark] = '';
        //                 break;
        //             case 7:
        //                 $mails[$emailPsaTirol] = '';
        //                 break;
        //             case 8:
        //                 $mails[$emailPsaVorarlberg] = '';
        //                 break;
        //             case 9:
        //                 $mails[$emailPsaWien] = '';
        //                 break;
        //         }
        //     }
        // }


        $values = [
            'ansuchen' => $event->ansuchen,
            'newStatus' => $event->ansuchen->getStatus(),
        ];

        $this->mailService->send('Notification/AnsuchenBegutachtungFinalize', $mails, $values);
    }
}