<?php
    session_status();
?>
<?php
    include_once("class.db.php");
    if($_SERVER["REQUEST_METHOD"]=='GET'){
        echo json_encode(product_list(),JSON_UNESCAPED_UNICODE);

    }

    function product_list(){
        $db=new database();
        $db->connect();
        $sql="SELECT Product_id,Product_code,Product_Name,
                brand.Brand_name,unit.Unit_name,
                product.Cost,product.Stock_Quantity
            FROM product,brand,unit
            WHERE product.Brand_ID = brand.Brand_id
            AND product.Unit_ID=unit.Unit_id";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    /*function create_bill($_POST){
        $db=new database();
        $db->connect();
        $sql="SELECT Bill_id,Cus_ID";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }*/
?>