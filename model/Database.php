<?php

namespace model;

use Exception;
use PDO;

class Database
{
    protected $connection = null;
    protected $table = '';

    public function __construct($table)
    {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE_NAME . ";charset=utf8",
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->table = $table;

        } catch (Exception $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
    }

    public function select($query = "", $params = [], $fetch = 'one')
    {
        $stmt = $this->connection->prepare($query);
        if (!empty($params)) {
            foreach ($params as $key => &$param) {
                if (is_numeric($param)) {
                    $stmt->bindParam($key, $param, PDO::PARAM_INT);
                } else {
                    $stmt->bindParam($key, $param);
                }
            }
        }

        $stmt->execute();
//        $stmt->debugDumpParams();
        if ($stmt !== false) {
            if ($fetch == 'all') {
                return $stmt->fetchall(PDO::FETCH_ASSOC);
            }

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function insert($data)
    {
        $table = $this->table;
        $keys = implode(',', array_keys($data));
        $value_keys = "";
        foreach ($data as $key => $value) {
            $value_keys .= ":$key,";
        }
        $value_keys = trim($value_keys, ',');

        $query = "INSERT INTO {$table} ($keys) VALUES ($value_keys)";

        $sql = $this->connection->prepare($query);
//        $sql->debugDumpParams();
        if ($sql->execute($data)) {
            $result = $data;
            $result['id'] = $this->connection->lastInsertId();
            return $result;
        }

        return false;
    }

    public function update($data, $id)
    {
        $table = $this->table;
        $value_keys = "";
        foreach ($data as $key => $value) {
            $value_keys .= "$key = :$key,";
        }
        $value_keys = trim($value_keys, ',');

        $query = "UPDATE {$table} SET {$value_keys} WHERE id = :id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $table = $this->table;

        $query = "DELETE FROM {$table} WHERE id = :id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
