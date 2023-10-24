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

        $emailBabiBurgenland = (new ExtensionConfiguration())->getEmailBabiBurgenland();
        $emailBabiKärnten = (new ExtensionConfiguration())->getEmailBabiKärnten();
        $emailBabiNiederoesterreich = (new ExtensionConfiguration())->getEmailBabiNiederoesterreich();
        $emailBabiOberoesterreich = (new ExtensionConfiguration())->getEmailBabiOberoeserreich();
        $emailBabiSalzburg = (new ExtensionConfiguration())->getEmailBabiSalzburg();
        $emailBabiSteiermark = (new ExtensionConfiguration())->getEmailBabiSteiermark();
        $emailBabiTirol = (new ExtensionConfiguration())->getEmailBabiTirol();
        $emailBabiVorarlberg = (new ExtensionConfiguration())->getEmailBabiVorarlberg();
        $emailBabiWien = (new ExtensionConfiguration())->getEmailBabiWien();
        $emailPsaBurgenland = (new ExtensionConfiguration())->getEmailPsaBurgenland();
        $emailPsaKärnten = (new ExtensionConfiguration())->getEmailPsaKärnten();
        $emailPsaNiederoesterreich = (new ExtensionConfiguration())->getEmailPsaNiederoesterreich();
        $emailPsaOberoesterreich = (new ExtensionConfiguration())->getEmailPsaOberoeserreich();
        $emailPsaSalzburg = (new ExtensionConfiguration())->getEmailPsaSalzburg();
        $emailPsaSteiermark = (new ExtensionConfiguration())->getEmailPsaSteiermark();
        $emailPsaTirol = (new ExtensionConfiguration())->getEmailPsaTirol();
        $emailPsaVorarlberg = (new ExtensionConfiguration())->getEmailPsaVorarlberg();
        $emailPsaWien = (new ExtensionConfiguration())->getEmailPsaWien();

        if ($event->ansuchen->getTyp() === 1) {
            $bundesland = BundeslandEnum::tryFrom($event->ansuchen->getBundesland());
            if ($bundesland) {
                switch ($bundesland->name) {
                    case 'Burgenland':
                        $mails[$emailBabiBurgenland] = '';
                        break;
                    case 'Kärnten':
                        $mails[$emailBabiKärnten] = '';
                        break;
                    case 'Niederösterreich':
                        $mails[$emailBabiNiederoesterreich] = '';
                        break;
                    case 'Oberösterreich':
                        $mails[$emailBabiOberoesterreich] = '';
                        break;
                    case 'Salzbug':
                        $mails[$emailBabiSalzburg] = '';
                        break;
                    case 'Steiermark':
                        $mails[$emailBabiSteiermark] = '';
                        break;
                    case 'Tirol':
                        $mails[$emailBabiTirol] = '';
                        break;
                    case 'Vorarlberg':
                        $mails[$emailBabiVorarlberg] = '';
                        break;
                    case 'Wien':
                        $mails[$emailBabiWien] = '';
                        break;
                }
            }
        } else if ($event->ansuchen->getTyp() === 2) {
            $bundesland = BundeslandEnum::tryFrom($event->ansuchen->getBundesland());
            if ($bundesland) {
                switch ($bundesland->name) {
                    case 'Burgenland':
                        $mails[$emailPsaBurgenland] = '';
                        break;
                    case 'Kärnten':
                        $mails[$emailPsaKärnten] = '';
                        break;
                    case 'Niederösterreich':
                        $mails[$emailPsaNiederoesterreich] = '';
                        break;
                    case 'Oberösterreich':
                        $mails[$emailPsaOberoesterreich] = '';
                        break;
                    case 'Salzbug':
                        $mails[$emailPsaSalzburg] = '';
                        break;
                    case 'Steiermark':
                        $mails[$emailPsaSteiermark] = '';
                        break;
                    case 'Tirol':
                        $mails[$emailPsaTirol] = '';
                        break;
                    case 'Vorarlberg':
                        $mails[$emailPsaVorarlberg] = '';
                        break;
                    case 'Wien':
                        $mails[$emailPsaWien] = '';
                        break;
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