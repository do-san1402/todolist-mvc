<?php

namespace App\App\Database;

use PDO;

class QueryBuilder
{
    protected $db;

    /**
     * Constructor to initialize the PDO instance.
     *
     * @param PDO $db The PDO instance representing the database connection.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetch the first record from the specified table based on ID.
     *
     * @param string $table The name of the table to query.
     * @param string|null $fetchClass Optional class name to fetch results into.
     * @param int $id The ID of the record to fetch. Default is 0.
     * @return array The result set as an array of objects or instances of $fetchClass.
     */
    public function first(string $table, string $fetchClass = null, $id = 0)
    {
        $query = $this->db->prepare("SELECT * FROM {$table} WHERE id = {$id};");
        $query->execute();

        if ($fetchClass) {
            return $query->fetchAll(PDO::FETCH_CLASS, $fetchClass);
        }

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fetch all records from the specified table with optional ordering.
     *
     * @param string $table The name of the table to query.
     * @param string|null $fetchClass Optional class name to fetch results into.
     * @param string|null $order Optional SQL ORDER BY clause.
     * @return array The result set as an array of objects or instances of $fetchClass.
     */
    public function selectAll(string $table, string $fetchClass = null, string $order = null)
    {
        $statement = $this->db->prepare("SELECT * FROM {$table} {$order}");
        $statement->execute();

        if ($fetchClass) {
            return $statement->fetchAll(PDO::FETCH_CLASS, $fetchClass);
        }

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Insert a new record into the specified table.
     *
     * @param string $table The name of the table to insert into.
     * @param array $parameters An associative array of column names and values.
     */
    public function insert(string $table, array $parameters)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
    }

    /**
     * Update an existing record in the specified table based on ID.
     *
     * @param string $table The name of the table to update.
     * @param array $parameters An associative array of column names and values.
     * @param int $id The ID of the record to update. Default is 0.
     */
    public function update(string $table, array $parameters, $id = 0)
    {
        $str = '';
        foreach (array_keys($parameters) as $key => $value) {
            $str .= $value . '=:' . $value;
            if ($key != count(array_keys($parameters)) - 1) {
                $str .= ', ';
            }
        }

        $sql = sprintf(
            "UPDATE %s SET %s WHERE id={$id}",
            $table,
            $str
        );
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
    }

    /**
     * Delete a record from the specified table based on ID.
     *
     * @param string $table The name of the table to delete from.
     * @param int $id The ID of the record to delete. Default is 0.
     */
    public function delete(string $table, $id = 0)
    {
        $stmt = $this->db->prepare("DELETE FROM {$table} WHERE id =:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
