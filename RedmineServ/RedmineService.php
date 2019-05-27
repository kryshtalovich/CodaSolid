<?php

namespace RedmineServ;

use DateTime;
use Redmine\Client;
use RedmineServ\Interfaces\IRedmineService;

class RedmineService implements IRedmineService
{
    #region Private Members

    //Default redmine client object
    private $redmineClient = null;

    //Redmine settings from json
    private $redmineUri = null;
    private $redmineToken = null;

    #endregion

    #region Constructor

    /**
     * RedmineService constructor.
     * @param $redmineUri
     * @param $redmineToken
     */
    public function __construct($redmineUri, $redmineToken)
    {
        //Setup redmine settings
        $this->redmineToken = $redmineToken;
        $this->redmineUri = $redmineUri;

        //Create redmine client
        $this->redmineClient = new Client($this->redmineUri,  $this->redmineToken);
    }

    #endregion

    #region Public Methods

    /**
     * Get data from redmine by period and limit
     * @param string $period
     * @param $limits
     * @return array
     */
    public function getTimeRecords(string $period, $limits)
    {
        $allTimes = $this->redmineClient->time_entry->all([
            'spent_on' => $period,
            'limit' => $limits
        ]);

        if (count($allTimes) <= 0)
            return [];

        $currentDate = new DateTime();
        foreach ($allTimes['time_entries'] as $time) {
            $arTimes[$time['id']] = [
                'ID' => $time['id'],
                'Пользователь' => $time['user']['name'],
                'Списано' => $time['hours'],
                'Проект' => $time['project']['name'],
                'Задача' => $time['issue']['id'] ?? 0,
                'Коммент' => $time['comments'],
                'Списано за' => $time['spent_on'],
                'Создано' => $time['created_on'],
                'Время импорта' => $currentDate->format('Y-m-d H:i:s')
            ];
        }
        return $arTimes;
    }

    #endregion
}