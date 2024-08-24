<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Return Order</title>
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
        <h2>Sale Return Order</h2>
    </div>

    <table class="center-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Product</th>
            <th>Return Qty.</th>
            <th>Grand Total</th>
            <th>Payment Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ !empty($saleReturn) ? $saleReturn->return_date : '' }}</td>
            <td>
                {{ !empty($saleReturn) ? $saleReturn->product->product_name : '' }}
                <small>Price: {{ !empty($saleReturn) ? $saleReturn->product->product_price : '--' }} Tk</small>
                <small>CS: {{ !empty($saleReturn) ? $saleReturn->product->quantity : '--' }}</small>
            </td>
            <td>{{ !empty($saleReturn) ? $saleReturn->return_quantity : '' }}</td>
            <td>{{ !empty($saleReturn) ? $saleReturn->return_amount : '' }}</td>
            <td>{{ !empty($saleReturn) ? $saleReturn->payment_status : '' }}</td>
        </tr>
        </tbody>
    </table>

</div>
</body>
</html>
