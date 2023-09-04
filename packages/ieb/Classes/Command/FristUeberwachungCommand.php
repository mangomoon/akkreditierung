<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Command;

use GeorgRinger\Ieb\Service\Checks\FristUeberwachungService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FristUeberwachungCommand extends Command
{

    /**
     * Defines the allowed options for this command
     */
    protected function configure()
    {
        $this
            ->addArgument(
                'email',
                InputArgument::REQUIRED,
                'Comma separated list of email addresses'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $emails = GeneralUtility::trimExplode(',', (string)$input->getArgument('email'), true);
        if (empty($emails)) {
            $io->error('No email given');
            return Command::INVALID;
        }
        foreach ($emails as $email) {
            if (!GeneralUtility::validEmail($email)) {
                $io->error('Invalid email given: ' . $email);
                return Command::INVALID;
            }
        }

        $ansuchenService = GeneralUtility::makeInstance(FristUeberwachungService::class, $emails);
        $ansuchenService->sendEmails();

        return Command::SUCCESS;
    }


}