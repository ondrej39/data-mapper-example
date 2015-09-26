<?php

namespace App\Libs\DataMappers\Interfaces;

use App\Models\Abstraction\Model as AbstractModel,
    App\Models\Exceptions\DataForModelNotFoundException,
    App\Models\Exceptions\InvalidModelTypeException;

interface DataMapper
{
    /**
     * @param mixed $id                         Unique ID bound to a record in a table
     * @throws DataForModelNotFoundException    Is thrown when there is no record for specified $id
     * @return AbstractModel
     */
    public function get($id);

    /**
     * @param array $conditions     Array specifying conditions for search
     * @param array $orderBy        Order by as columnName => orderDirection
     * @param int   $limit          Set the limit to return the maximum of specified models
     * @return AbstractModel[]
     */
    public function find(array $conditions = array(), array $orderBy = array(), $limit = 0);

    /**
     * @param AbstractModel $model          A child of an AbstractModel class you want to persist
     * @throws InvalidModelTypeException    Is thrown when an object of invalid instance is passed to this method
     * @return boolean                      True on successful operation, false when something has failed,
     *                                      errors may be accessed via getErrors method
     */
    public function save(AbstractModel $model);

    /**
     * @return array                Array of strings containing errors should the save method fail
     */
    public function getErrors();
}