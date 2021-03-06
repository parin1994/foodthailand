<script src="https://res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/vconsole/3.0.0/vconsole.min.js"></script>
        <script> var vConsole = new VConsole();</script>
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
                <div class="form-group col-12">
                    <label for="InputBranch">เลือกโต๊ะ<span>*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <select id="id_table" class="form-control required" required>
                            <option selected="" disabled="">เลือกโต๊ะ</option>
                            <?php foreach ($store as $value) { ?>
                                <option value='<?php echo $value->id_table ?>'><?php echo $value->table ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="userid" name="userid" value="">
                <?php foreach ($product as $row) { ?>
                    <div class="col-md-4" style="padding:16px; background-color:#f1f1f1; border:1px solid #ccc; margin-bottom:16px; height:400px" align="center">
                        <!-- <img src="<?php echo base_url($row->img) ?>" class="img-thumbnail" style="height: 100px; width: 100px;"><br /> -->
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
            <table class="table table-bordered" id="foodTable">
                <thead>
                    <th width="40%">Name</th>
                    <th width="15%">Quantity</th>
                    <th width="15%">Price</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    <tr id="tr"></tr>
                </tbody>
            </table>
            <button type="submit" id="save" class="btn btn-primary">save</button>
        </div>
    </div>
</body>
<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
<script src="liff-starter.js"></script>
<script>
    window.onload = function(e) {
        liff.init( function(data) {
             runApp();
        });
    };

    function runApp() {
        liff.getProfile().then(profile => {
            document.getElementById("userid").value = profile.userId;
            
        }).catch(err => console.error(err));
    }
    
    liff.init({
        liffId: "1655534162-7ao0X1Pb"
    }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
    }, err => console.error(err.code, error.message));
</script>

<script>
    $(document).ready(function() {
        $('#save').click(function() {
            let userid = document.getElementById("userid").value
            var id_table = $('#id_table').val();
            console.log(id_table);
            var myTab = document.getElementById('foodTable');
            var myTableArray = [];
            $("table#foodTable tr").each(function() {
                var arrayOfThisRow = [];
                var tableData = $(this).find('td');
                if (tableData.length > 0) {
                    tableData.each(function() {
                        arrayOfThisRow.push($(this).text());
                    });
                    myTableArray.push(arrayOfThisRow);
                }
            });
            console.log(myTableArray);
            $.ajax({
                    url: "<?php echo base_url(); ?>booking/create",
                    method: "POST",
                    data: {
                        id_table: id_table,
                        userid : userid,
                        myTableArray
                    },
                    success: function(data) {
                        alert('บันทึกข้อมูลสำเร็จ');
                    }
                });            
        });

        $('.add_cart').click(function() {
            var id_food = $(this).data("id_food");
            var name_food = $(this).data("name_food");
            var price = $(this).data("price");
            var quantity = $('#' + id_food).val();
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
                        var values = $.parseJSON(data);
                        var html;
                        html += '<tr>' +
                            '<td>' + values.name_food + '</td>' +
                            '<td>' + values.quantity + '</td>' +
                            '<td>' + values.price + '</td>' +
                            '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="' + values.id_food + '">Remove</button></td>'
                        '</tr>';

                        $('#tr').after(html);
                    }
                });
            } else {
                alert("Please Enter quantity");
            }
        });

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
<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
<script src="liff-starter.js"></script>
<script>
    window.onload = function(e) {
        liff.init(function(data) {
            initializeApp(data);
        });
    };

    function initializeApp(data) {
        document.getElementById('userid').value = data.context.userId;
    }
</script>

</html>