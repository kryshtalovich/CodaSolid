<?php


class TestClass extends \CodaPHP\CodaPHP
{
    public function listRows($doc, $table, array $params = [])
    {
        return print_r($params);
    }
}