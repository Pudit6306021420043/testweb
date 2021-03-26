<?php
    include_once "control.php";
    $debug_mode = false;
    
    if($_SERVER['REQUEST_METHOD']=='GET'){
        echo json_encode(get_data($debug_mode));

    }else if($_SERVER['REQUEST_METHOD']=='POST'){
        text_debug("POST may be support next time<br>", $debug_mode);
        if(isset($_POST["name"]) && isset($_POST["user"]) && isset($_POST["pass"])){
            $name  = $_POST["name"];
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            insert_newdata($member_id,$name, $user ,$pass,$debug_mode);
            echo json_encode(get_data($debug_mode));
        }
    }else{
        http_response_code(405); //Error unsupport by current version
    }

    function get_data($debug_mode){
        $my_db = new db("root","","shopshock", $debug_mode);
        $data = $my_db->sel_data("select * from member");
        //echo json_encode($data);
        $my_db->close();
        return $data;
    }

    function insert_newdata($name, $user ,$pass,$debug_mode){
        $my_db = new db("root","","shopshock", $debug_mode);
        $sql = "INSERT INTO member(member_id ,name, user, password) VALUES ('124',{$name},{$user},{$pass})";
        $data = $my_db->query($sql);
        $my_db->close();
    }
?>