<?php

namespace App\infrastructure\database;

use SQLite3;

class Connection
{
    private SQLite3 $db;
    public function __construct()
    {
        $this->db = new SQLite3(__DIR__ . "/db.sqlite");
    }

    public function create_table(): void
    {
        $this->db->exec("CREATE TABLE IF NOT EXISTS user( id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT UNIQUE NOT NULL, age INTEGER NOT NULL )");
    }
    public function client(): SQLite3
    {
        return  $this->db;
    }
    public function close()
    {
        $this->db->close();
    }
}
