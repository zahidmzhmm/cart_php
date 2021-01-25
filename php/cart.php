<?php
session_start();
if (isset($_GET['add'])){
    $product_id = $_GET['add'];
    $quantity = $_GET['quantity'];
    $data = [
        'product_id'=>$product_id,
        'quantity'=>$quantity
    ];
    $add = addToCart($data);
    if ($add===true){
        $_SESSION['return']="Success";
        header("location:../purchase.php");
    }else{
        $_SESSION['return']="Already Added";
        header("location:../purchase.php");
    }
}elseif (isset($_POST['upQuantity'])){
    $data = [
        'product_id'=>$_POST['pid'],
        'quantity'=>($_POST['up']+1)
    ];
    $plus = update_quantity($data);
    if ($plus==true){
        echo "Success";
    }else{
        echo "500";
    }
}elseif (isset($_POST['downQuantity'])){
    $qnt = $_POST['down'];
    if ($qnt>1){
        $data = [
            "product_id"=>$_POST['pid'],
            "quantity"=>($_POST['down']-1)
        ];
        $min = update_quantity($data);
        if ($min==true){
            echo "Success";
        }else{
            echo "500";
        }
    }else{
        echo "500";
    }
}elseif (isset($_POST['removeProduct'])){
    $data = [
        "product_id"=>$_POST['remove']
    ];
    $remove = remove($data);
    if ($remove ==true){
        echo "Success";
    }else{
        echo "500";
    }
}elseif (isset($_POST['clearProducts'])){
    $unset = delete_cart();
    echo "Success";
}else{
    echo "Error";
}

function addToCart($data)
{
    if (isset($_SESSION['Product'])){
        $item_array_id = array_column($_SESSION['Product'],'product_id');
        if (!in_array($data['product_id'],$item_array_id)) {
            $count = count($_SESSION['Product']);
            $_SESSION['Product'][$count] = $data;
            return true;
        }else{
            return false;
        }
    }
    else {
        $_SESSION['Product'][0] = $data;
        return true;
    }
}
function update_quantity($data)
{
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];
    foreach ($_SESSION['Product'] as $keys=>$values){
        $main_pid = $_SESSION['Product'][$keys]['product_id'];
        if ($main_pid==$product_id){
            $_SESSION['Product'][$keys]["quantity"]=$quantity;
            return true;
        }
    }
}
function remove($data)
{
    $product_id = $data['product_id'];
    foreach ($_SESSION['Product'] as $keys=>$values){
        if ($values['product_id']==$product_id){
            unset($_SESSION['Product'][$keys]);
            return true;
        }
    }
}
function delete_cart()
{
    unset($_SESSION['Product']);
    return true;
}