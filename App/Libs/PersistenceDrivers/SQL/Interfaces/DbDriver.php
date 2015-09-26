<?php

namespace App\Libs\PersistenceDrivers\SQL\Interfaces;

interface DbDriver
{
    /**
     * @param string    $sql        SQL to be executed
     * @param array     $parameters Array used to bind parameters to values
     * @param array     $options    Optional options
     * @return array
     */
    public function doQuery($sql, array $parameters = array(), array $options = array());

    /**
     * @return boolean
     */
    public function beginTransaction();

    /**
     * @return boolean
     */
    public function rollbackTransaction();

    /**
     * @return boolean
     */
    public function commitTransaction();
}