<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Order</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            /*padding: 20px;*/
            background-color: #f4f4f4;
            font-size: 14px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #000;
            margin: 0;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            color: #000;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            align-items: end;
        }

        .footer div {
            margin: 5px 0;
        }

        .signature {
            margin-left: auto; /* Pushes the signature section to the end of the flex container */
        }

        .driver_signature{
            padding-top: 4rem;
        }
        .center-table {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Sale Order</h2>
    </div>

    <table class="center-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Sale Qty.</th>
            <th>Grand Total</th>
            <th>Payment Status</th>
            <th>Is Returned?</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ !empty($sale) ? $sale->sale_date : '' }}</td>
            <td>
                {{ !empty($sale) ? $sale->product->product_name : '' }}
                <small>Price: {{ !empty($sale) ? $sale->product->product_price : '--' }} Tk</small>
                <small>CS: {{ !empty($sale) ? $sale->product->quantity : '--' }}</small>
            </td>
            <td>{{ !empty($sale) ? $sale->customer->customer_name : '' }}</td>
            <td>{{ !empty($sale) ? $sale->sale_quantity : '' }}</td>
            <td>{{ !empty($sale) ? $sale->sale_total : '' }}</td>
            <td>{{ !empty($sale) ? $sale->payment_status : '' }}</td>
            <td>{{ !empty($sale) ? ($sale->is_returned == 1 ? 'YES': 'NO') : '' }}</td>
        </tr>
        </tbody>
    </table>

</div>
</body>
</html>
