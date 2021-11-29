<?php
class Database
{
    protected $connection = null;

    public function __construct()
    {
        try 
        {
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        } 
        catch (PDOException $exception) 
        {
            echo "Error: " . $exception->getMessage();
            die();
        }
    }

    public function select($query = "", $params = array())
    {
        try 
        {
            $statement = $this->executeStatement($query, $params);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement = null;

            return $result;
        } 
        catch (Exception $exception) 
        {
            throw New Exception($exception->getMessage());
        }
        return false;
    }

    public function executeStatement($query = "", $params = array())
    {
        try 
        {
            $statement = $this->connection->prepare($query);

            if ($statement === false) 
            {
                throw New Exception("Unable to prepare statement for execution: " . $query);
            }

            // Add parameter bindings if they are passed
            if ($params) 
            {
                foreach ($params as $key => $value) 
                {
                    $statement->bindParam($key, $value, PDO::PARAM_INT);
                }
            }

            $statement->execute();
            return $statement;
        } 
        catch (Exception $exception) 
        {
            throw New Exception($exception->getMessage());
        }
    }
}

?>