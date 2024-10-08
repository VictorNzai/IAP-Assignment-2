<?php
class dbConnection
{
    // Database connection variables
    private $connection;
    private $dbType;
    private $hostName;
    private $dbPort;
    private $hostUser;
    private $hostPass;
    private $dbName;

    // Constructor
    public function __construct($dbType, $hostName, $dbPort, $hostUser, $hostPass, $dbName)
    {
        $this->dbType = $dbType;
        $this->hostName = $hostName;
        $this->dbPort = $dbPort;
        $this->hostUser = $hostUser;
        $this->hostPass = $hostPass;
        $this->dbName = $dbName;

        // Call the connection function
        $this->connection($dbType, $hostName, $dbPort, $hostUser, $hostPass, $dbName);
    }

    public function connection($dbType, $hostName, $dbPort, $hostUser, $hostPass, $dbName)
    {
        switch($dbType)
        {
            case "PDO":
                try
                {
                    // Include the port in the connection string
                    $dsn = "mysql:host=$hostName;port=$dbPort;dbname=$dbName";
                    $this->connection = new PDO($dsn, $hostUser, $hostPass);
                    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Connected successfully 😁 <br>";
                }
                catch(PDOException $pdoError)
                {
                    echo "Connection Failed 😞: " . $pdoError->getMessage();
                }
                break;

            case "MySQLi":
                // For MySQLi, include the port in the connection
                $this->connection = new mysqli($hostName, $hostUser, $hostPass, $dbName, $dbPort);
                if($this->connection->connect_error)
                {
                    echo "Connection Failed 😞: " . $this->connection->connect_error;
                }
                else
                {
                    echo "Connected successfully 😁";
                }
                break;
        }
    }

    // Insert function remains unchanged
    public function insert($table, $data)
    {
        ksort($data);
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO `$table` (`$fieldNames`) VALUES ($fieldValues)";
        $stmt = $this->connection->prepare($sql);

        try
        {
            foreach ($data as $key => $value)
            {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return true;
        }
        catch (PDOException $e)
        {
            echo "Insert failed: " . $e->getMessage();
            return false;
        }
    }

    // Count results function
    public function countResults($sql)
    {
        try
        {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount();
        }
        catch (PDOException $e)
        {
            echo "Count failed: " . $e->getMessage();
            return 0;
        }
    }

    // Escape values function
    public function escapeValues($value)
    {
        return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
    }

    // Function to return the connection (for manual queries if needed)
    public function getConnection()
    {
        return $this->connection;
    }
}
