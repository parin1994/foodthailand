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
                <input type="hidden" id="userid" name="userid" value="">
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
    </div>
</body>


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
                    }
                });
            } else {
                alert("Please Enter quantity");
            }
        });
        
    });
</script>
<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
    <script src="liff-starter.js"></script>
    <script>
        window.onload = function (e) {
            liff.init(function (data) {
                initializeApp(data);
            });
        };

        function initializeApp(data) {
            document.getElementById('userid').value = data.context.userId;
        }
    </script>
    </html>