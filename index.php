<?php

use Setup\xmlDecode;

require_once ("Setup/xmlDecode.php");

$xmldata = simplexml_load_file(__DIR__."/Setup/Settings.xml") or die("Failed to load");
echo $xmldata->Redmine->redmineUri . "</br>";
echo $xmldata->Redmine->redmineToken . "</br>";
echo $xmldata->Coda->codaToken . "</br>";
echo $xmldata->Coda->codaDocumentId . "</br>";
echo $xmldata->Coda->codaTableName . "</br>";

$reader = new xmlDecode(__DIR__."/Setup/Settings.xml");

var_dump($reader->getCodaTableName());

?>