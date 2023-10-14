<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Command;

use GeorgRinger\Ieb\Import\Import;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ImportCommand extends Command
{

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $import = GeneralUtility::makeInstance(Import::class);
        $data = $import->run();

        print_r($data);
        return Command::SUCCESS;
    }


}