<?php

namespace App\Libs\PersistenceDrivers;

use App\Libs\PersistenceDrivers\SQL\Interfaces\DbDriver;

final class MySQLPdoDriver implements DbDriver
{
    /** @var \PDO */
    private $_pdo;

    /**
     * @param string $host
     * @param string $database
     * @param string $username
     * @param string $password
     * @param array $options
     */
    public function __construct($host, $database, $username, $password, array $options = array())
    {
        $dsn = "mysql:dbname={$database};host={$host}";
        $this->_pdo = new \PDO($dsn, $username, $password, $options);
    }

    /**
     * @param string $sql SQL to be executed
     * @param array $parameters Array used to bind parameters to values
     * @param array $options Optional options
     * @return array
     */
    public function doQuery($sql, array $parameters = array(), array $options = array())
    {
        $statement = $this->_pdo->prepare($sql, $options);

        foreach ($parameters as $parameter => $value) {
            $statement->bindValue($parameter, $value);
        }

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return boolean
     */
    public function beginTransaction()
    {
        return $this->_pdo->beginTransaction();
    }

    /**
     * @return boolean
     */
    public function rollbackTransaction()
    {
        return $this->_pdo->rollBack();
    }

    /**
     * @return boolean
     */
    public function commitTransaction()
    {
        return $this->_pdo->commit();
    }
}