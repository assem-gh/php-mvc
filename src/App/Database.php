<?php

namespace App;

use PDO;

class Database
{
    public function __construct(
        private readonly string $host,
        private readonly string $user,
        private readonly string $password,
        private readonly string $dbname,
        private readonly int    $port = 3306,
    )
    {
    }

    public function getConnection(): PDO
    {
        $dns = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8;$this->port";
        return new PDO($dns, $this->user, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
}