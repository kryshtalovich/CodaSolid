<?php


namespace CodaServ;

use CodaServ\Interfaces\ICodaSyncService;

class CodaServiceDecorator implements ICodaSyncService
{
    private $codaClient = null;

    public function __construct(ICodaSyncService $service)
    {
        $this->codaClient = $service;
    }

    public function getTimeRecords()
    {
        return $this->codaClient->getTimeRecords();
    }

    public function setTimeRecords(array $data)
    {
        $arCodaTimes = $this->getTimeRecords();

        foreach ($arCodaTimes['items'] as $item) {
            $id = $item['values']['ID'];
            if ($id && $data[$id]) {
                unset($data[$id]);
            }
        }

        $this->codaClient->setTimeRecords($data);
    }
}