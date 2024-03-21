<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\Service;

use League\Csv;
use League\Csv\CharsetConverter;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class CsvService
{

    public function generateCsv(iterable $items, array $fieldList): string
    {
        $csv = $this->getCsv();
        $csv->insertOne(array_values($fieldList));
        $allowedKeys = array_keys($fieldList);
        $csv->setDelimiter(";");
        foreach ($items as $item) {
            if ($item instanceof AbstractEntity) {
                $item = $item->_getCleanProperties();
            }
            $limitedSet = array_intersect_key($item, array_flip($allowedKeys));

            $csv->insertOne($limitedSet);
        }

        return $csv->toString();
    }

    public function generateDirect(array $items, array $keys): string
    {
        $csv = $this->getCsv();
        $csv->setDelimiter(";");
        $csv->insertOne($keys);
        $csv->insertAll($items);
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

    /**
     * @return Csv\Writer
     */
    protected function getCsv(): Csv\Writer
    {
        $encoder = (new CharsetConverter())
            ->inputEncoding('utf-8')
            ->outputEncoding('iso-8859-15');
        $csv = Csv\Writer::createFromString();
        $csv->addFormatter($encoder);
        return $csv;
    }

}