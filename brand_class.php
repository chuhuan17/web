<?php 
include "../database/database.php";
?>
<?php
    class brand {
        private $db;
        public function __construct(){
            $this -> db = new Database;
        }
        public function insert_brand($brand_name){
            $query = "INSERT INTO brands (brand_name) VALUES('$brand_name')";
            $result = $this ->db->insert($query);
            header('Location: brandlist.php');
        }
        public function show_brand(){
            $query= "SELECT * FROM brands ORDER BY brand_id DESC";
            $result = $this ->db->select($query);
            return $result;
        }
        public function get_brand($brand_id){
            $query= "SELECT * FROM brands WHERE brand_id = '$brand_id'";
            $result = $this ->db->select($query);
            return $result;
        }
        public function update_brand($brand_id, $brand_name) {
            $query = "UPDATE brands SET brand_name = '$brand_name' WHERE brand_id = '$brand_id'";
            $result = $this->db->update($query); 
            header('Location: brandlist.php');
            return $result;
        }
        public function delete_brand($brand_id){
            $query = "DELETE FROM brands WHERE brand_id = '$brand_id'";
            $result = $this->db->delete($query);
            header('Location: brandlist.php');
            return $result;
        }
    }
?>