<div id="form_wish" class="row mt-5 beverages">
    <div class="col-md-6 m-auto">
        <?php
        include "../php/controller.php";
        if (isset($_SESSION['Product'])){
            $total_rows = 1;
            $totalamnt  = 0;
            $cardamount = 0;
            $idp        = 0;
            foreach ($_SESSION['Product'] as $cart=>$values){
                $idp = $values['product_id'];
                $qntity = $values['quantity'];
                $select = $config->query("select * from products where id='$idp'");
                $array = mysqli_fetch_array($select);
                $price = $array['price']*$qntity;
                $totalamnt += $price;
                $cardamount = $totalamnt*100;
                global $totalamnt;
                global $cardamount;
                ?>
                <div class="py-3 option">
                    <input type="hidden" name="idp[]" value="<?= $idp ?>">
                    <div class="d-flex">
                        <b class="mr-2"><?= $total_rows ?>.</b>
                        <div class="one w-75 overflow-hidden"><div class=""><?= $array['title'] ?></div></div>
                        <div class="ml-2 w-25 text-right">&dollar;<?= $price ?></div>
                    </div>
                    <div class="d-flex">
                        <div class="remove mt-2"><a href="javascript:void(0);" class="removeProduct" data-pid="<?= $array['id'] ?>">Remove</a></div>
                        <div class="plus_m mt-2 ml-auto text-right">
                            <a class="btn btn-sm downQuantity btn-danger text-light mr-2" data-pdctid="<?= $array['id']; ?>" data-pqnty="<?= $values['quantity'] ?>" href="javascript:void(0);">-</a>
                            <span class="number"><?= $values['quantity'] ?></span>
                            <a class="btn btn-sm upQuantity btn-warning ml-2" data-pdctid="<?= $array['id']; ?>" data-pqnty="<?= $values['quantity'] ?>" href="javascript:void(0);">+</a>
                        </div>
                    </div>
                </div>
                <?php
                $total_rows++;
            }
            ?>
            <input type="hidden" name="product_id" class="product_id">
            <div class="text-left"><button class="btn btn-sm mt-4 btn-danger clearProducts">Clear All</button></div>
            <div class="total text-right ml-auto my-3 text-capitalize"> total: <b>&dollar;<?= isset($totalamnt)?$totalamnt:'0.00' ?></b> </div>
            <?php
        }else{
            ?>
            <div class="py-4 option">
                <h5 class="text-center">Empty Cart</h5>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script src="cart.js"></script>