<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .invoice-box {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            background: #ffffff;
            border-radius: 8px;
        }

        table {
            width: 100%;
            line-height: 1.6;
            text-align: left;
            border-collapse: collapse;
        }

        .top table {
            width: 100%;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .top .title {
            font-size: 32px;
            color: #333333;
            margin: 0;
        }

        .top .company-logo img {
            max-width: 200px;
        }

        .heading td {
            background: #f0f0f0;
            border-bottom: 1px solid #dddddd;
            font-weight: bold;
            padding: 10px;
        }

        .item td {
            border-bottom: 1px solid #eeeeee;
            padding: 10px;
        }

        .total td {
            border-top: 2px solid #dddddd;
            font-weight: bold;
            padding: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
            color: #333333;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .back-to-page {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            font-size: 16px;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-to-page:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="company-logo">
                                {{-- const logoUrl = '/assets/logo.png'; --}}
                                <!-- Add your company logo here -->
                                <img src="{{ asset('assets/logo.png') }}" alt="Company Logo">
                            </td>
                            <td>
                                <h2 class="title">Invoice</h2>
                                <strong>Invoice Number:</strong> {{ $orderDetails->invoice_number }}<br>
                                <strong>Order ID:</strong> {{ $orderDetails->id }}<br>
                                <strong>Order Date:</strong> {{ $orderDetails->created_at->format('F j, Y') }}
                              

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Customer Name:</strong> {{ $orderDetails->customer_name }}<br>
                                <strong>Phone Number:</strong> {{ $orderDetails->phone_number }}<br>
                                <strong>Email:</strong> {{ $user->email }}<br>
                                <strong>Address:</strong> {{ $orderDetails->address }}<br>
                                {{-- <strong>Area:</strong> {{ $orderDetails->area }}<br> --}}
                                {{-- <strong>Delivery Charge:</strong> {{ number_format($orderDetails->delivery_charge, 2) }}<br> --}}
                            </td>
                            <td>
                                <strong>Payment Method:</strong> {{ ucfirst($orderDetails->payment_method) }}<br>
                          
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item</td>
                <td>Quantity</td>
                <td>Price</td>
            </tr>

            @foreach ($products as $product)
                <tr class="item">
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td></td>
                <td>Total:</td>
                <td>{{ number_format($totalPrice, 2) }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Discount:</td>
                <td>-{{ number_format($discountAmount, 2) }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Shipping Cost:</td>
                <td>{{ number_format($shippingCost, 2) }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Final Total:</td>
                <td>{{ number_format($finalPrice, 2) }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>For any inquiries, please contact us at: <a href="mailto:support@example.com">support@example.com</a></p>
            <a href="{{ route('dashboard.pos.index') }}" class="back-to-page">Back to Page</a>
        </div>
    </div>
    
    <script>
        // Function to trigger PDF download
        function downloadPDF() {
            window.print(); 
        }

        setTimeout(function() {
            downloadPDF();
        }, 3000); 
    </script>
</body>
</html>
