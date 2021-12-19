<?php
class Database
{
    protected $connection = null;

    public function __construct()
    {
        try 
        {
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $exception) 
        {
            echo "Error: " . $exception->getMessage();
            die();
        }
    }

    public function startTransaction() {
        $this->connection->beginTransaction();
    }

    public function commitTransaction() {
        $this->connection->commit();
    }

    public function rollBackTransaction() {
        $this->connection->rollBack();
    }

    public function getLastInsertedId() {
        return $this->connection->lastInsertId();
    }

    public function select($query = "", $params = null)
    {
        try 
        {
            $statement = $this->executeStatement($query, $params);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } 
        catch (Exception $exception) 
        {
            throw new Exception($exception->getMessage());
        }
        return false;
    }

    public function insert($query = "", $params = null)
    {
        try 
        {
            $this->executeStatement($query, $params);
            return $this->connection->lastInsertId();
        } 
        catch (Exception $exception) 
        {
            throw new Exception($exception->getMessage());
        }
    }

    public function executeStatement($query = "", $params = null)
    {
        try 
        {
            $statement = $this->connection->prepare($query);

            if ($statement === false) 
            {
                throw new Exception("Unable to prepare statement for execution: " . $query);
            }
            $statement->execute($params ? (is_array($params) ? $params : [$params]) : null);
            return $statement;
        } 
        catch (Exception $exception) 
        {
            throw new Exception($exception->getMessage());
        }
    }
}

?>