<?php

class Model
{
    public $conn;
    public $table;
    public $query;

    public function __construct()
    {
        $this->conn = new mysqli('', '', '', '');
        $this->query = [
            'limit' => '',
            'where' => '',
            'order' => '',
            'select' => '',
        ];
    }
    public function get($desk = null)
    {
        $order = '';

            $order = 'ORDER BY id DESC ';


        $select = mysqli_query($this->conn,  "SELECT ".$this->query['select']." FROM ".$this->table." ". $this->query['where'] . $order . $this->query['order'] . $this->query['limit'])->fetch_all(true);

        if (!$select) {
            return false;
        } else {
            return $select;
        }
    }
    public function count(){
        $count = mysqli_query($this->conn, "SELECT COUNT(*) as qty FROM $this->table")->fetch_all(true);

        return $count[0]['qty'];
    }
    public function where($arr){
        $SelectCondition = 'WHERE ';
        foreach ($arr as $key => $value) {
            $SelectCondition = $SelectCondition . $key . '=' . "'$value'" . ' AND ';
        }
            $this->query ['where']= substr($SelectCondition, 0, -5);
            return $this;
    }
    public function limit($start = NULL, $end = NULL){
        if ($start != NULL){
            $limit = "LIMIT $start";
        }else{
            return false;
        }
        if ($end != NULL){
            $limit .= ", $end";
        }
        $this->query ['limit'] = $limit;
        return $this;
    }
    public function insert($arr)
    {

        $keys = '';
        $values = '';
        foreach ($arr as $key => $value) {
            $keys = $keys . "$key" . ',';
            $values = $values . "'$value'" . ',';
        }
        $keys = substr($keys, 0, -1);
        $values = substr($values, 0, -1);
//        echo "INSERT INTO $this->table ($keys) VALUES ($values)"; //                                              ------------------------- for test -------------------------
        mysqli_query($this->conn, "INSERT INTO $this->table ($keys) VALUES ($values)");
    }

    public function update($arr, $id)
    {

        $setCV = '';
        foreach ($arr as $key => $value) {
            $setCV = $setCV . $key . '=' . "'$value'" . ', ';
        }
        $setCV = substr($setCV, 0, -2);
        mysqli_query($this->conn, "UPDATE $this->table SET $setCV WHERE id = $id");
    }

    public function delete($id)
    {Q

        $delete =  mysqli_query($this->conn, "DELETE FROM $this->table WHERE id = $id ");
        return $delete;
    }

    public function select($param = NULL)
    {
        if ($param != NULL){
            $newParam = '';
            foreach ($param as $item) {
                $newParam .= $item . ',';
            }
            $newParam = substr($newParam, 0, -1);

            $this->query['select'] = $newParam;

        }else{
            $this->query['select'] = '*';

        }
        return $this;
//        'SELECT * FROM table'  --- query ---
    }
}
