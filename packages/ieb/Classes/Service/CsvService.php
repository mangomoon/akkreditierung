<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use League\Csv;
use League\Csv\CharsetConverter;

class CsvService
{

    public function generateCsv(array $rows, array $fieldList): string
    {
        $encoder = (new CharsetConverter())
            ->inputEncoding('utf-8')
            ->outputEncoding('iso-8859-15')
        ;
        $csv = Csv\Writer::createFromString();
        $csv->addFormatter($encoder);
        $csv->insertOne(array_values($fieldList));
        $allowedKeys = array_keys($fieldList);
        $csv->setDelimiter(";");
        foreach ($rows as $row) {
            $limitedSet = array_intersect_key($row, array_flip($allowedKeys));
            $csv->insertOne($limitedSet);
        }

        return $csv->toString();
    }

    public function response(string $result, string $filename)
    {
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: text/csv');
        header('Content-Length: ' . strlen($result));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        echo $result;
        exit;
    }

}