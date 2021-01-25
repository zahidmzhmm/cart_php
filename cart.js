$(".upQuantity").on("click",function () {
    var product = $(this).data("pdctid");
    var quantity = $(this).data("pqnty");
    $.post("php/cart.php", { up: quantity, pid: product, upQuantity: 201 })
        .done(function( data ) {
            console.log(data);
            $(".mainCart").load("cartComponent.php");
        });
})
$(".downQuantity").on("click",function () {
    var quantity = $(this).data("pqnty");
    var product = $(this).data("pdctid");
    $.post("php/cart.php", { down: quantity, pid: product, downQuantity: 201 })
        .done(function( data ) {
            console.log(data);
            $(".mainCart").load("cartComponent.php");
        });
})
$(".removeProduct").on("click",function () {
    var pid = $(this).data("pid");
    $.post("php/cart.php", { remove: pid, removeProduct: 201 })
        .done(function( data ) {
            console.log(data);
            $(".mainCart").load("cartComponent.php");
        });
})
$(".clearProducts").on("click",function () {
    $.post("php/cart.php", { clearProducts: 201 })
        .done(function( data ) {
            console.log(data);
            $(".mainCart").load("cartComponent.php");
        });
})
var product_value = $("input[name='idp[]']").map(function(){return $(this).val();}).get();
$(".product_id").val(product_value)