<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Command;

use GeorgRinger\Ieb\Service\Checks\FristUeberwachungService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            )
            ->addOption(
                'skipPersistSent',
                null,
                InputOption::VALUE_NONE,
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

        $ansuchenService = GeneralUtility::makeInstance(FristUeberwachungService::class, $emails, (bool)$input->getOption('skipPersistSent'));


        $io->section('Berater');
        $sentMails = $ansuchenService->sendEmailsBerater();
        if ($sentMails === 0) {
            $io->info('No emails sent!');
        } else {
            $io->success('Sent ' . $sentMails . ' emails!');
        }

        $io->section('Trainer');
        $sentMails = $ansuchenService->sendEmailsTrainer();
        if ($sentMails === 0) {
            $io->info('No emails sent!');
        } else {
            $io->success('Sent ' . $sentMails . ' emails!');
        }

        $io->section('Stammdaten ÖCERT');
        $sentMails = $ansuchenService->sendStammdatenMails();
        if ($sentMails === 0) {
            $io->info('No emails sent!');
        } else {
            $io->success('Sent ' . $sentMails . ' emails!');
        }

        $io->section('Stammdaten Sonstiges');
        $sentMails = $ansuchenService->sendEmails();
        if ($sentMails === 0) {
            $io->info('No emails sent!');
        } else {
            $io->success('Sent ' . $sentMails . ' emails!');
        }
        return Command::SUCCESS;
    }


}