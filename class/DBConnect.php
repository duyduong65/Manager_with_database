<?php


class DBConnect
{
    protected $dsn;
    protected $userName;
    protected $password;

    public function __construct($dsn, $userName, $password)
    {
        $this->dsn = $dsn;
        $this->userName = $userName;
        $this->password = $password;
    }

    function connect()
    {
        $conn = null;
        try {
            $conn = new PDO($this->dsn, $this->userName, $this->password);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $conn;
    }
}