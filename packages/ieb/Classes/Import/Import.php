<?php

namespace GeorgRinger\Ieb\Import;

class Import
{

    public function run()
    {
        $response = [];
        // $feUserImport = new FeUserImport();
        // $response['User'] = $feUserImport->run();

        // $trainerImport = new TrainerImport();
        // $response['Trainer'] = $trainerImport->run();

        // $beraterImport = new BeraterImport();
        // $response['Berater'] = $beraterImport->run();

        // $verantwortlichImport = new AngebotsVerantwortlichImport();
        // $response['Angebotsveranwortlich'] = $verantwortlichImport->run();

        // $stammdaten = new StammdatenImport();
        // $response['Stammdaten'] = $stammdaten->run();

        $ansuchenImport = new AnsuchenImport();
        $response['Ansuchen'] = $ansuchenImport->run();

        return $response;
    }

}