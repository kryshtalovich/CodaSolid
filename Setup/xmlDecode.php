<?php
namespace Setup;

class xmlDecode
{
    #region Properties

    private function setCodaToken($token){
        if(strlen($token))
            $this->codaToken = $token;
    }

    private function setCodaDocumentId($docId){
        if(strlen($docId))
            $this->codaDocumentId = $docId;
    }

    private function setCodaTableName($tableName){
        if(strlen($tableName))
            $this->codaTableName = $tableName;
    }

    private function setRedmineToken($token){
        if(strlen($token))
            $this->redmineToken = $token;
    }

    private function setRedmineUri($redmineUri){
        if(strlen($redmineUri))
            $this->redmineUri = $redmineUri;
    }

    public function getCodaToken() {
        return $this->codaToken;
    }

    public function getCodaDocumentId()
    {
        return $this->codaDocumentId;
    }

    public function getCodaTableName()
    {
        return $this->codaTableName;
    }

    public function getRedmineToken()
    {
        return $this->redmineToken;
    }

    public function getRedmineUri()
    {
        return $this->redmineUri;
    }

    #endregion

    #region Private Fields

    private $xmlItterator = null;

    //Coda data from xml
    private $codaToken = null;
    private $codaDocumentId = null;
    private $codaTableName = null;

    //Redmine data from xml
    private $redmineToken = null;
    private $redmineUri = null;

    #endregion

    #region Constructor

    /**
     * Default constructor
     * xmlDecode constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $xml = file_get_contents($filename);
    }

    #endregion

    #region Public Reader

    /**
     *Read xml file with settings and set properties
     */
    public function readxmlData()
    {
        foreach ($this->xmlItterator as $key => $val) {
            if (!is_array($val)) {
                switch ($key){
                    case "redmineUri":
                        $this->setRedmineUri($val);
                        break;
                    case "redmineToken":
                        $this->setRedmineToken($val);
                        break;
                    case "codaToken":
                        $this->setCodaToken($val);
                        break;
                    case "codaDocumentId":
                        $this->setCodaDocumentId($val);
                        break;
                    case "codaTableName":
                        $this->setCodaTableName($val);
                        break;
                }
            }
        }
    }

    #endregion
}