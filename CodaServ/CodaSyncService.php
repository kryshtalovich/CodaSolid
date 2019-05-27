<?php

namespace CodaServ;

use CodaServ\Interfaces\ICodaSyncService;
use CodaPHP;

class CodaSyncService implements ICodaSyncService
{

    #region Private Members

    //Default coda client
    private $codaClient = null;

    //Coda settings from json
    private $apiToken = null;
    private $docId = null;
    private $tableName = null;

    #endregion

    #region Constructor

    /**
     * CodaSyncService constructor.
     * @param $apiToken
     * @param $docId
     * @param $tableName
     */
    public function __construct(string $apiToken, int $docId, string $tableName)
    {

        //Setup default data
        $this->apiToken = $apiToken;
        $this->docId = $docId;
        $this->tableName = $tableName;

        //Create client
        $this->codaClient = new CodaPHP\CodaPHP($this->apiToken);
    }

    #endregion

    #region Public Methods

    /**
     * Get data from coda table
     */
    public function getTimeRecords()
    {
        return $this->codaClient->listRows($this->docId, $this->tableName);
    }

    /**
     * Set new records
     * @param array $data
     * @return bool
     */
    public function setTimeRecords(array $data)
    {
        $arCodaTimes = $this->getTimeRecords();

        foreach ($arCodaTimes['items'] as $item) {
            $id = $item['values']['ID'];
            if ($id && $data[$id]) {
                unset($data[$id]);
            }
        }

        $ins = $this->codaClient->insertRows(
            $this->docId,
            $this->tableName,
            $data
        );

        return $ins;
    }

    #endregion

}