<?php
class Diary{
 
    // database connection and table name
    private $conn;
    private $table_name;
 
    // object properties
    public $id;
    public $evento;
    public $pulpo;

 
    public function __construct($db){
        $this->conn = $db;
    }
 

    function read() {
        //select all data
        $query = "select GROUP_CONCAT(DISTINCT de.Evento SEPARATOR ', ' ) as 'eventos',d.pulpo
        from diaevento de, diario d where d.Dia = de.Dia GROUP BY d.dia";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    function insert($dia) {
        $this->table_name = "diario";
        
        $query = "INSERT INTO 
                    $this->table_name (Id,Dia,Pulpo)
                  VALUES
                    ($dia,$dia,$this->pulpo)";

                $stmt = $this->conn->prepare($query);
                $stmt->execute();

                return $stmt;

    }

    function insertDayEvent($id,$dia) {

        $this->table_name = "diaevento";

        $query = "INSERT INTO
                    $this->table_name (ID,Dia,Evento) 
                    VALUES 
                    ($id,$dia,'$this->evento')";

                $stmt = $this->conn->prepare($query);
                $stmt->execute();


                return $stmt;
    }
}
?>