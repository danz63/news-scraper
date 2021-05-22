<?php
class Database
{
    public $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect(HOST, USER, PASS, DBNAME);
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }


    public function get($table = '')
    {
        $query = "SELECT * FROM $table";
        $execQuery = mysqli_query($this->conn, $query);
        if (!$execQuery) {
            die("Error description: " . mysqli_error($this->conn));
        }
        $data = [];
        while ($row = mysqli_fetch_assoc($execQuery)) {
            $data[] = $row;
        }
        return $data;
    }


    public function getWhere($table = '', $where = [], $operator = false)
    {
        $query = "SELECT * FROM $table ";
        if ($operator) {
            $query .= "WHERE ";
            foreach ($where as $k => $v) {
                $query .= "$k='$v' $operator ";
            }
            $query = trim(rtrim(trim($query), $operator));
        } else {
            $query .= "WHERE ";
            foreach ($where as $k => $v) {
                $query .= "$k='$v'";
                break;
            }
        }
        $execQuery = mysqli_query($this->conn, $query);
        if (!$execQuery) {
            die("Error description: " . mysqli_error($this->conn));
        }
        $data = [];
        while ($row = mysqli_fetch_assoc($execQuery)) {
            $data[] = $row;
        }
        if (count($data) == 1) {
            $data = $data[0];
        }
        return $data;
    }


    public function insert($table, $data, $opt = false)
    {
        $columns = '';
        $values = '';
        foreach ($data as $c => $v) {
            $columns .= $c . ", ";
            $values .= "\"" . $v . "\", ";
        }
        $columns = rtrim($columns, ', ');
        $values = rtrim($values, ', ');
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $exec = mysqli_query($this->conn, $query);
        if (!$exec) {
            die("Error description: " . mysqli_error($this->conn));
        }
        if ($opt) {
            return $this->query("SELECT last_insert_id();", 'get');
        }
        return true;
    }


    public function update($table = '', $data = [], $where = [])
    {
        $values = '';
        $clause = '';
        foreach ($data as $c => $v) {
            $values .= $c . "=" . "\"" . $v . "\", ";
        }
        foreach ($where as $c => $v) {
            $clause .= $c . "=" . "\"" . $v . "\", ";
        }
        $values = trim(rtrim(trim($values), ','));
        $clause = trim(rtrim(trim($clause), ','));
        $query = "UPDATE $table SET $values WHERE $clause";
        $exec = mysqli_query($this->conn, $query);
        if (!$exec) {
            die("Error description: " . mysqli_error($this->conn));
        }
        return true;
    }


    public function delete($table = '', $where = [], $operator = false)
    {
        $clause = '';
        if ($operator) {
            foreach ($where as $c => $v) {
                $clause .= $c . "=" . "'" . $v . "' $operator ";
            }
            $clause = trim(rtrim(trim($clause), $operator));
        } else {
            foreach ($where as $c => $v) {
                $clause .= $c . "=" . "'" . $v . "'";
                break;
            }
        }
        $clause = trim(rtrim(trim($clause), ','));
        $query = "DELETE FROM $table WHERE $clause";
        $exec = mysqli_query($this->conn, $query);
        if (!$exec) {
            die("Error description: " . mysqli_error($this->conn));
        }
        return true;
    }


    public function query($query = '', $return = '')
    {
        $execQuery = mysqli_query($this->conn, $query);
        if (!$execQuery) {
            die("Error description: " . mysqli_error($this->conn));
        }
        if ($return == 'get') {
            $data = [];
            while ($row = mysqli_fetch_assoc($execQuery)) {
                $data[] = $row;
            }
            if (count($data) == 1) {
                $data = $data[0];
            }
        } else {
            $data = mysqli_affected_rows($this->conn);
        }
        return $data;
    }

    public function pluck($table = '', $column = '')
    {
        $query = "SELECT $column FROM $table";
        $execQuery = mysqli_query($this->conn, $query);
        if (!$execQuery) {
            die("Error description: " . mysqli_error($this->conn));
        }
        $data = [];
        while ($row = mysqli_fetch_assoc($execQuery)) {
            $data[] = $row[$column];
        }
        return $data;
    }
}
