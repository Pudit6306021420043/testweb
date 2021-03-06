<?php
    class db{
        private $db;
        private $debug_mode;

        public function __construct($user,$pass,$db,$debug){
            $this->debug_mode = $debug;
            $this->db =new mysqli ("localhost",$user,$pass,$db);
            $this->db->set_charset("utf8");
            if($this->db->connect_errno){
                echo "database connect fail {$this->db->connect_error}";
                exit();
                }else{
                    $this->text_debug("database Connect success");
                }
            }

        public function sel_data($sql){
            $result = $this->db->query($sql);
            $this->text_debug($sql);
            $data=$result->fetch_all(MYSQLI_ASSOC);
            if($this->debug_mode){
                echo "<pre>";
                echo print_r($data);
                echo "</pre>";
            }
            return $data;
        }

        public function query($sql){
            $result = $this->db->query($sql);
            return $result;
        }
        public function close(){
            $this->db->close();
        }

        private function text_debug($text){
            if($this->debug_mode==true){
                echo $text;
            }
        }
    }
    //$my_db = new db("book","1234","book",true);
    //$my_db->query("select * from user");

?>