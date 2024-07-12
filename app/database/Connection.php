<?php

namespace App\App\Database;

use \PDO;

class Connection
{
    /**
     * Creates a PDO connection based on the provided configuration array.
     *
     * This static method constructs a PDO object using the database configuration
     * details provided in the `$config` array. It handles exceptions by catching
     * any errors that occur during the connection attempt and displays the error
     * message using the `dd` function.
     *
     * @param array $config An associative array containing the database connection details:
     *                      - CONNECTION: The type of database connection (e.g., 'mysql').
     *                      - NAME: The name of the database.
     *                      - HOST: The database server host.
     *                      - USERNAME: The username for the database connection.
     *                      - PASSWORD: The password for the database connection.
     * @return PDO The PDO instance representing the database connection.
     * @throws Exception If the connection attempt fails, an exception is caught and the error message is displayed.
     */
    public static function make(array $config)
    {
        try {
            return new PDO(
                "{$config['CONNECTION']}:dbname={$config['NAME']};host={$config['HOST']}",
                $config['USERNAME'],
                $config['PASSWORD']
            );
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
