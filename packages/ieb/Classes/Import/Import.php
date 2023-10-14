<?php

namespace GeorgRinger\Ieb\Import;

class Import
{

    public function run()
    {
        $response = [];
//        $feUserImport = new FeUserImport();
//        $response['User import'] = $feUserImport->run();;
//
//        $trainerImport = new TrainerImport();
//        $response['Trainer Import'] = $trainerImport->run();

//        $beraterImport = new BeraterImport();
//        $response['Berater Import'] = $beraterImport->run();

        $verantwortlichImport = new AngebotsVerantwortlichImport();
        $response['Angebotsveranwortlich'] = $verantwortlichImport->run();


//        $stammdaten = new StammdatenImport();
//        $response['Stammdaten Import'] = $stammdaten->run();
        return $response;
    }

}