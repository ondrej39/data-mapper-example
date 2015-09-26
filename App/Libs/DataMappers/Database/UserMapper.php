<?php

namespace App\Libs\DataMappers\Database;

use App\Libs\DataMappers\Database\Abstraction\DbMapper,
    App\Models\Abstraction\Model as AbstractModel,
    App\Models\UserModel,
    App\Models\Exceptions\DataForModelNotFoundException,
    App\Models\Exceptions\InvalidModelTypeException;

class UserMapper extends DbMapper
{
    /**
     * @param mixed $id Unique ID bound to a record in a table
     * @throws DataForModelNotFoundException    Is thrown when there is no record for specified $id
     * @return UserModel
     */
    public function get($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $result = $this->_dbDriver->doQuery($sql, array(
            ":id" => $id,
        ));

        if (count($result) === 0) {
            throw new DataForModelNotFoundException("No data was found for user with the id {$id}");
        }

        $this->_dbRowId = $result['id'];

        $username = $result['username'];
        $password = $result['password'];
        $email = $result['email'];
        $dateOfRegistration = new \DateTime($result['date_of_registration']);
        $lastActivity = null;

        if ($result['last_activity'] !== null) {
            $lastActivity = new \DateTime($result['last_activity']);
        }

        return new UserModel($username, $password, $email, $dateOfRegistration, $lastActivity);
    }

    /**
     * @param array $conditions Array specifying conditions for search
     * @param array $orderBy Order by as columnName => orderDirection
     * @param int $limit Sets the limit to return the maximum of specified models
     * @return AbstractModel[]
     */
    public function find(array $conditions = array(), array $orderBy = array(), $limit = 0)
    {
        // logic to find users based on passed parameters
    }

    /**
     * @param AbstractModel $model A child of an AbstractModel class you want to persist
     * @throws InvalidModelTypeException    Is thrown when an object of invalid instance is passed to this method
     * @return boolean                      True on successful operation, false when something has failed,
     *                                      errors may be accessed via getErrors method
     */
    public function save(AbstractModel $model)
    {
        if ($this->_dbRowId !== null) {
            // call update on row
        } else {
            // call insert
        }
    }
}