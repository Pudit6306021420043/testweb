<?php
    include_once "01 dbcontrol.php";
    include_once "util.php";

    $debug_mode=false;

    if($_SERVER['REQUEST_METHOD']=='GET'){
        text_debug("for GET Method",$debug_mode);
       show_data($debug_mode);
    }else if($_SERVER['REQUEST_METHOD'=='POST']){
        text_debug("POST may be support next time<br>",$debug_mode);
        //echo json_encode("{'Message':"print_r($_POST)+"}");
        if(isset($_POST["new_id"])&&isset($_POST["new_name"])){
            $new_id=$_POST["new_id"];
            $new_name=$_POST["new_name"];
            insert_newdata($new_id,$new_name,$debug_mode);
            echo json_encode(show_data($debug_mode));
        }
    }else{
        http_response_code(405);
    }

    function show_data($debug_mode){
        $mydb = new db("book","1234","book",$debug_mode);
        echo json_encode($mydb->sel_data("select * from user"));
        $mydb->close();
    }

    function insert_newdata($new_id, $new_name,$debug_mode){
        $mydb = new db("root","","book",$debug_mode);
        $sql = "INSERT INTO user(id,name) VALUES({$new_id},{$new_name})";
        $data=$mydb->query($sql);
        $mydb->close();
    }
?>