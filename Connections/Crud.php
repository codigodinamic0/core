<?php
/*
 * @author Andres Arbelaez Acevedo
 * @email andresa58@gmail.com
 * ©2013
 * crud para consultas a la base de datos
 */
 class Crud{
    private $host="";
    private $database="";
    private $user="";
    private $password="";
    public  $mysqli="";
    public  $resulset="";
    public  $insert_id="";
    public $last_query="";
    private $cons="";
    public function __construct($host,$user,$pass,$db) {
        //datos solicitados para la creacion de conexion 
        $this->host=$host;
        $this->database=$db;
        $this->user=$user;
        $this->password=$pass;
    }
    
    public function connect(){
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->mysqli->connect_errno) {
            echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }
    public function getConnection(){
        return $this->mysqli;
    }
    // consultas simple
    public function consulta_s($dato)
      {
        $this->resulset = $this->mysqli->query($dato);
        $this->insert_id = $this->mysqli->insert_id;
      }

      // public function fetch_array_s()
      // {
      //    return $this->cons->fetch_array();
      // }
    // fin consulsimple
    //seleccionar datos 
    public function select($table,$fields,$action=null){
            $query=$this->mysqli->query("SELECT ".$fields." FROM ".$table." ".$action);
            $this->last_query="SELECT ".$fields." FROM ".$table." ".$action;
                if($query){
                    $this->resulset=$query;
                }else{
                   die( "error".$this->mysqli->error );
                }
    }
    //insertar datos
    public function insert($table,$values){
        $metadata=$this->cleanInsertQuery($values);
        $query=$this->mysqli->query("INSERT INTO " . $table . "(" .$metadata[0]. ") VALUES(" .$metadata[1]. ")");
        $this->insert_id = $this->mysqli->insert_id;
        $this->last_query= "INSERT INTO " . $table . "(" . $metadata[0] . ") VALUES(" . $metadata[1] . ")";
        return $query;
    }
    //actualizar datos
    public function update($table, $fields, $action = null) {
            $query=$this->mysqli->query("UPDATE " . $table . " SET " . $this->cleanUpdateQuery($fields) . " " . $action);
            $this->last_query = "UPDATE " . $table . " SET " . $this->cleanUpdateQuery($fields) . " " . $action;
            return $query;
    }
    //borrar datos
    public function delete($table,$action=null){
            $query=$this->mysqli->query("DELETE FROM " . $table . " " . $action);
            return $query;
    }
    //consltas preparadas y almacenadas
    public function prepare($query){
        return $this->mysqli->prepare($query);
    }
    //tipos datos retornado
    public function num_rows() {
        return $this->resulset->num_rows;
    }
    public function fetch_object() {
        return $this->resulset->fetch_object();
    }
    public function fetch_row() {
        return $this->resulset->fetch_row();
    }
    public function fetch_array() {
        return $this->resulset->fetch_array();
    }
    public function fetch_assoc(){
        return $this->resulset->fetch_assoc();
    }
    //obtener la ultima consulta hecha
    public function last_query(){
       echo $this->last_query;
    }
    public function free_result(){
        return $this->resulset->free_result();
    }
    public function scape_string($str){
        return $this->mysqli->real_escape_string($str);
    }
    public function setNames($charset){
     return $this->mysqli->set_charset($charset);
    }
    public function close() {
        return $this->mysqli->close();
    }
    public function fetch_field()
    {
        $dato = $this->resulset->fetch_field();  
        return $dato;
    }
    public function field_count()
    {
        $dato = $this->resulset->field_count;
        return $dato;
    }
    /**/
    public function field_name($fieldnr)
    {
        $dato = $this->resulset->fetch_field_direct($fieldnr)->name;  
        return $dato;
    }
    //sql seguro 
    private  function saveSql($str){
    $str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
    $str = function_exists("mysql_real_escape_string") ? strip_tags($this->scape_string(trim($str))):strip_tags($this->scape_string(trim($str)));
    $str = str_ireplace("SELECT","",$str);
    $str = str_ireplace("COPY","",$str);
    $str = str_ireplace("DELETE","",$str);
    $str = str_ireplace("DROP","",$str);
    $str = str_ireplace("DUMP","",$str);
    $str = str_ireplace(" OR ","",$str);
    $str = str_ireplace("%","",$str);
    $str = str_ireplace("LIKE","",$str);
    $str = str_ireplace("--","",$str);
    $str = str_ireplace("^","",$str);
    $str = str_ireplace("[","",$str);
    $str = str_ireplace("]","",$str);
    $str = str_ireplace("\\","",$str);
    $str = str_ireplace("!","",$str);
    $str = str_ireplace("¡","",$str);
    $str = str_ireplace("?","",$str);
    $str = str_ireplace("=","",$str);
    $str = str_ireplace("&","",$str);
    return ($str);
    }
    
    // sql seguro para el uso del update
    private function cleanUpdateQuery($fields) {
       $fill="";
        foreach ($fields as $key => $field) {
            $field = (is_string($field)&&!is_numeric($field)) ? $field = "'" .  $this->saveSql($field) . "'" : $this->saveSql($field);
            $fill.= ",".$key . "=" . $field;
        }
        return substr($fill,1);
    }
    //sql seguro para el uso de insert
    private function cleanInsertQuery($fields){
        $fill="";
        $meta="";
        $wellFormat=array();
        foreach ($fields as $key => $field) {
            $field = (is_string($field)&&!is_numeric($field)) ? $field = "'" .  $field . "'" :$field;
            $fill.= ",".$field;
            $meta.=",".$key;
        }
        $wellFormat[0]=substr($meta,1);
        $wellFormat[1]=substr($fill,1);
        return $wellFormat;
    }

    // crud sencillo
    
}
?>
