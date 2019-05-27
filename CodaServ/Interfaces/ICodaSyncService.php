<?php

namespace CodaServ\Interfaces;

interface ICodaSyncService
{
    public function getTimeRecords();
    public function setTimeRecords(array $data);
}