<!DOCTYPE html>
<html>
<head>
	<title>Bill Payment</title>
	<style>
		/* CSS styles go here */
	</style>
</head>
<body>
	<!-- Page content goes here -->
    <header>
        <div class="logo">
            <img src="path/to/logo.png" alt="Restaurant Logo">
        </div>
        <div class="restaurant-name">
            Restaurant Name
        </div>
    </header>

    <style>
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
            font-size: 24px;
            font-weight: bold;
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
                    echo '<td>$' . number_format($order['price'], 2) . '</td>';
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
        <button style="length: 10000px;" id="print-button" onclick="window.print()">Print</button>
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