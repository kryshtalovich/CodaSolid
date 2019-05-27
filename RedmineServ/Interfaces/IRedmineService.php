<?php

namespace RedmineServ\Interfaces;

interface IRedmineService
{
    public function getTimeRecords(string $period, $limits);
}