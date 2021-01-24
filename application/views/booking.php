<html>

<head>
    <title>Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <br /><br />

        <div class="col-lg-6 col-md-6">
            <div class="table-responsive">
                <h3 align="center">เมนูอาหาร</h3><br />
                <?php foreach ($product as $row) { ?>
                    <div class="col-md-4" style="padding:16px; background-color:#f1f1f1; border:1px solid #ccc; margin-bottom:16px; height:400px" align="center">
                        <img src="<?php echo base_url($row->img) ?>" class="img-thumbnail" style="height: 100px; width: 100px;"><br />
                        <h4><?php echo $row->name_food ?></h4>
                        <h3 class="text-danger"><?php echo $row->price ?></h3>
                        <input type="text" name="quantity" class="form-control quantity" id=<?php echo $row->id_food ?>><br />
                        <button type="button" name="add_cart" class="btn btn-success add_cart" data-name_food=<?php echo $row->name_food ?> data-price=<?php echo $row->price ?> data-id_food=<?php echo $row->id_food ?>>Add to Cart</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div id="cart_details">
            <h3 align="center">ตะกร้าสินค้า</h3>
        </div>
    </div>

    </div>
</body>

</html>
<script>
    $(document).ready(function() {

        $('.add_cart').click(function() {
            var id_food = $(this).data("id_food");
            var name_food = $(this).data("name_food");
            var price = $(this).data("price");
            var quantity = $('#' + id_food).val();
            console.log(quantity);
            if (quantity != '' && quantity > 0) {
                $.ajax({
                    url: "<?php echo base_url(); ?>booking/add",
                    method: "POST",
                    data: {
                        id_food: id_food,
                        name_food: name_food,
                        price: price,
                        quantity: quantity
                    },
                    success: function(data) {
                        alert("Product Added into Cart");
                        $('#cart_details').html(data);
                        $('#' + id_food).val('');
                    }
                });
            } else {
                alert("Please Enter quantity");
            }
        });

        $('#cart_details').load("<?php echo base_url(); ?>booking/load");

        $(document).on('click', '.remove_inventory', function() {
            var row_id = $(this).attr("id");
            if (confirm("Are you sure you want to remove this?")) {
                $.ajax({
                    url: "<?php echo base_url(); ?>booking/remove",
                    method: "POST",
                    data: {
                        row_id: row_id
                    },
                    success: function(data) {
                        alert("Product removed from Cart");
                        $('#cart_details').html(data);
                    }
                });
            } else {
                return false;
            }
        });

        $(document).on('click', '#clear_cart', function() {
            if (confirm("Are you sure you want to clear cart?")) {
                $.ajax({
                    url: "<?php echo base_url(); ?>booking/clear",
                    success: function(data) {
                        alert("Your cart has been clear...");
                        $('#cart_details').html(data);
                    }
                });
            } else {
                return false;
            }
        });

    });
</script>