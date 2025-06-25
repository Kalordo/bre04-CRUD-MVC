<?php

abstract class AbstractManager {
    protected PDO $db;

    public function __construct() {
        $host = 'db.3wa.io';
        $dbName = 'yohannleperson_crud_mvc';
        $username = 'yohannleperson';
        $password = '5eeae6eea83db7d74811ce859cb08bb2';

        $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8";
        $this->db = new PDO($dsn, $username, $password);
    }
}