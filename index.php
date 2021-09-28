<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/db.php';
require __DIR__ . '/Includes/helper.php';
require __DIR__ . '/Includes/FactoryDB.php';
require __DIR__ . '/Includes/Route.php';
require __DIR__ . '/Routes/api.php';

if (INSTALLED) {
    $cart = getResult();
    $excute = excute();
} else {
    return view('install');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Take Home - Cart AjaxPage</title>
    <link href="<?php echo url('themes/default/css/cart.css') ?>" rel="stylesheet">
    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<main class="cd-main container margin-top-xxl">
    <div class="text-component text-center">
        <h1>Add to Cart Dynamic</h1>
        <p class="flex flex-wrap flex-center flex-gap-xxs">
        <form method="post">
            <button name="cmd" class="cd-cart cd-add-to-cart">Execute Cart Products</button>
        </form>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Item type</th>
                <th scope="col">Country</th>
                <th scope="col">Item price</th>
                <th scope="col">Weight</th>
                <th scope="col">Rate</th>
                <th scope="col">Shipping</th>
                <th scope="col">VAT</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($cart as $order) {
                echo '<tr>';
                echo '<th scope="row">#' . $order['CartID'] . '</th>';
                echo '<td>' . $order['ProductName'] . '</td>';
                echo '<td>' . $order['ShippingCountry'] . '</td>';
                echo '<td>$' . $order['CartPrice'] . '</td>';
                echo '<td>' . $order['ProductWeight'] . 'KG</td>';
                echo '<td>$' . $order['ShippingPrice'] . '</td>';
                echo '<td>$' . $order['CartShipping'] . '</td>';
                echo '<td>$' . $order['CartVat'] . '</td>';
                echo '<td>$' . $order['CartTotal'] . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

    </div>
</main>

</body>
</html>
