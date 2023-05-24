<!DOCTYPE html>
<html>
<head>
	<title>Bill Payment</title>
    <?php 
    session_start();
    include "../import.php"; ?>
</head>
<body>
	<!-- Page content goes here -->
    <header>
        <div class="logo">
            <!-- <img src="path/to/logo.png" alt="Restaurant Logo"> -->
            <h1>I GK ADI WIRAWAN</h1>
            <br>
            <h5 style="margin-top: -10%; margin-left: 12%;">081 338 431 832 <span class="middle-dot">.</span> 085 954 169 929</h5>
        </div>
        <div class="restaurant-name">
            <label>03 des 2020</label>
            <br>
            <center>
                <h2>Hotel Rangke</h2>
            </center>
        </div>
    </header>

    <style>
        body {
            background: white;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .logo img {
            height: 50px;
        }
        .restaurant-name {
            font-size: 15px;
            font-weight: bold;
        }
        .middle-dot {
            position: relative;
            top: -.1em;
            font-size: 1.5em;
        }
    </style>

    <section>
        <h2>Order Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Generate random order data
                $orders = array(
                    array('item' => 'Pizza', 'quantity' => 2, 'price' => 10.99),
                    array('item' => 'Burger', 'quantity' => 1, 'price' => 6.99),
                    array('item' => 'Fries', 'quantity' => 1, 'price' => 3.99),
                    array('item' => 'Soda', 'quantity' => 2, 'price' => 1.99)
                );

                // Loop through orders and display them in the table
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<td>' . $order['item'] . '</td>';
                    echo '<td>' . $order['quantity'] . '</td>';
                    echo '<td>Rp ' . number_format($order['price'], 2) . '</td>';
                    echo '<td>Rp ' . number_format($order['price'] * $order['quantity'], 2) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </section>

    <style>
        section {
            padding: 20px;
        }
        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

    <footer>
        <div class="total">
            Total: <span id="total"></span>
        </div>
        <button style="width: 100px;" id="print-button" onclick="window.print()">Print</button>
    </footer>

    <style>
        footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .total {
            font-size: 24px;
            font-weight: bold;
        }
        button {
            padding: 10px px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            height: 50px;
        }
        button:hover {
            background-color: #3e8e41;
        }
        
        @media print {
            #print-button {
                display: none;
            }
            @page {
                margin-bottom: 0;
            }
        }
    </style>

<script>
        // Calculate total using JavaScript
        var orders = <?php echo json_encode($orders); ?>;
        var total = 0;
        for (var i = 0; i < orders.length; i++) {
            total += orders[i].quantity * orders[i].price;
        }
        document.getElementById('total').innerHTML = '$' + number_format(total, 2);

        // Helper function to format numbers with commas
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>

</body>
</html>