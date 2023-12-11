<?php

namespace Harkor\WhiseDemo\cli;

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Whise\Api\WhiseApi;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

$api = new WhiseApi();
$api->setAccessToken($_SERVER['WHISE_TOKEN']);

$application = new Application();

$application->register('estates')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($api): int {

        $estates = $api->estates()->list();

        $estatesTable = [];
        foreach ($estates as $estate) {
            $estatesTable[] = [
                $estate->id,
                $estate->name ?? 'NULL',
                $estate->number ?? 'NULL',
                $estate->address ?? 'NULL',
                $estate->city ?? 'NULL',
                $estate->zip ?? 'NULL',
                $estate->pictures ? sizeof($estate->pictures) .' pictures' : 0 .' picture',
            ];
        }

        $estatesTable[] = new TableSeparator();
        $estatesTable[] = [new TableCell(sizeof($estates).' estates found', ['colspan' => 6])];

        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Name', 'Street number', 'Address', 'City', 'Zip', 'Photos'])
            ->setRows($estatesTable);

        $table->render();

        return Command::SUCCESS;
    });

$application->register('offices')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($api): int {

        $offices = $api->offices()->list(['clientId' => $_SERVER['WHISE_CLIENTID']]);

        $officesTable = [];
        foreach ($offices as $office) {
            $officesTable[] = [
                $office->id,
                $office->name ?? 'NULL',
                $office->number ?? 'NULL',
                $office->address1 ?? 'NULL',
                $office->city ?? 'NULL',
                $office->zip ?? 'NULL',
                $office->telephone ?? 'NULL',
                $office->mobile ?? 'NULL',
                $office->website ?? 'NULL',
            ];
        }

        $officesTable[] = new TableSeparator();
        $officesTable[] = [new TableCell(sizeof($offices).' offices found', ['colspan' => 9])];

        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Title', 'Street number', 'Address', 'City', 'Zip', 'Phone', 'Mobile', 'Website'])
            ->setRows($officesTable);

        $table->render();

        return Command::SUCCESS;
    });

$application->run();