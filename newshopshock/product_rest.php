<?php 
    session_start();
?>
<?php
    include_once("class.db.php");
    if($_SERVER["REQUEST_METHOD"]=='GET'){
        echo json_encode(product_list(),JSON_UNESCAPED_UNICODE);
    }else if($_SERVER["REQUEST_METHOD"]=='POST'){
        echo json_encode(create_bill($_POST));

    }
    function product_list(){
        $db = new database();
        $db->connect();
        $sql = "SELECT Product_id,Product_code,Product_Name,
                       brand.Brand_name, unit.Unit_name,
                       product.Cost, product.Stock_Quantity
                FROM  product,brand,unit 
                WHERE product.Brand_ID = brand.Brand_id
                and   product.Unit_ID  = unit.Unit_id";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }
    function create_bill($post){
        $db = new database();
        $db->connect();
        // 1check first bill?
        // 1.1 yes bill_id=1 , bill sta = 0;
        //         add bill+detail - > bill_id, product_id , qty, price
        // 1.2 chack last bill_stat of user?
        // 1.3 check p_id is exist
        //     yes add productid qty price
        //     no update product qty
        // 1.4 new bill but ont first bill
        //     bill_id = last_id

        $sql="SELECT  Bill_id,Bill_Status FROM bill ORDER by Bill_id DESC LIMIT 1";
        $bill_result=$db->query($sql);
        $p_id    = $_POST['p_id'];
        $p_price = $_POST['p_price'];
        $p_qty   = $_POST['p_qty'];
        if(sizeof($bill_result)==0){
            $sql="INSERT INTO bill(Bill_id, Cus_ID,Bill_Status) VALUES (1,{$_SESSION['cus_id']},0)";
            
            $result=$db->exec($sql);
            $sql="INSERT INTO bill_detail(Bill_id, Product_ID, Quantity, Unit_Price) 
                  VALUES (1,{$p_id},{$p_qty},{$p_price},)";
            $result=$db->exec($sql);
        }else{
            $sql="SELECT  Bill_id,Bill_Status FROM bill WHERE Cus_ID={$_SESSION['cus_id']} ORDER by Bill_id DESC LIMIT 1";
            $user_bill_result=$db->query($sql);
            if(sizeof($user_bill_result)==1&&$user_bill_result[0][1]==0){
                $bill_id=$user_bill_result[0][0];
                $sql="INSERT INTO bill_detail(Bill_id, Product_ID, Quantity, Unit_Price) 
                  VALUES ({$bill_id},{$p_id},{$p_qty},{$p_price})";
                $result=$db->exec($sql);
            }
            //show_cart
            $sql="SELECT Bill_id ,Product_ID ,Quantity"
        }


/*
        $result = $db->exec("SELECT Bill_id, Cus_ID, Bill_Status FROM bill WHERE Cus_ID=1 and Bill_Status=0");
        if($result->num_rows==0){
            $result = $db->query("SELECT Bill_id FROM bill order by Bill_id DESC limit 1");
            echo sizeof($result);
            if(sizeof($result)==0){
                $db->exec("INSERT INTO bill(Bill_id, Cus_ID,Bill_Status) VALUES (1,1,0)");
                $result = $db->query("SELECT Bill_id FROM bill WHERE cus_ID=1 order by Bill_id DESC limit 1");
            }else{
            
            }
            $result = $db->query("SELECT Bill_id FROM bill WHERE cus_ID=1 order by Bill_id DESC limit 1");
            $db->exec("INSERT INTO bill_detail(Bill_id, Product_ID, Quantity, Unit_Price) 
                       VALUES {$result[0]},{$post['pid']},{$post['qty']},{$post['price']})");
        }*/
        $db->close();
        return $result;
    }
?>