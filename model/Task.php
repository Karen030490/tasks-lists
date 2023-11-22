<?php

namespace model;


class Task extends Database
{
    public static $tableName = 'tasks';
    public $db = null;
    public $limit = 3;

    public function __construct()
    {
        parent::__construct(self::$tableName);
        if (empty($this->db)) {
            $this->db = new Database(self::$tableName);
        }
    }

    public function getTasksList($offset = 0, $order_by = '', $sort = '')
    {
        $query = "SELECT * FROM tasks";
        if(!empty($sort) && !empty($order_by)){
            $query .= " ORDER BY $order_by $sort";
        }
        $query .= " LIMIT $offset,{$this->limit}";

        return $this->db->select($query, [], 'all');
    }

    public function getTasksCount()
    {
        return $this->db->select("SELECT COUNT(id) as total FROM tasks");
    }

    public function getTaskByID($id)
    {
        return $this->db->select("SELECT * FROM tasks WHERE id = :id LIMIT 1", [":id" => $id]);
    }

    public function setTask($data)
    {
        $result = $this->db->insert(
            [
                'task' => $data['task'],
                'email' => $data['email'],
                'username' => $data['username'],
                'is_done' => 0,
            ]
        );

        if (!empty($result['id'])) {
            return $result;
        }

        return false;
    }

    public function deleteTask($id)
    {
        return $this->db->delete($id);
    }

    public function updateTask($data, $id)
    {
        return $this->db->update($data, $id);
    }


}