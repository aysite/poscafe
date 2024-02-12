<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NOTA</title>
    <style>
        @page, body {
            margin: 0;
            padding: 0;
        }

        #nota {
            max-width: 200px;
        }

        #nota header {
            text-align: center;
        }

        #nota header .logo {
            width: 80%;
        }

        #nota header p {
            font-family: Tahoma;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        #nota header table {
            margin: 5px 0;
            padding: 5px 0;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        #nota header table td {
            font-family: Tahoma;
            font-size: 14px;
            margin: 0;
            padding: 0;
            text-align: left;
        }

        #nota .content table {
            border-collapse: collapse;
        }

        #nota .content table td {
            font-size: 12px;
            font-family: Tahoma;
        }

        #nota .right {
            text-align: right;
        }

        #nota td.price {
            vertical-align: top;
            text-align: right;
            font-size: 16px;
        }

        #nota .grandtotal {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            margin: 5px 0;
            padding: 5px 0;
        }

        #nota .grandtotal table tr td {
            font-size: 14px;
            font-family: Tahoma;
        }

        #nota .thank p {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="nota">
        <header>
            <img src="{{ asset('img/logo-cafe.png') }}" alt="" class="logo">
            <p>{{ $rsTrans->no_trans }}</p>
            <p>{{ $rsTrans->tgl_trans }}</p>
            <table width="100%">
                <tr>
                    <td width="35%">Customer</td>
                    <td width="1%">: </td>
                    <td width="64%"> {{ $rsTrans->nm_customer }}</td>
                </tr>
                <tr>
                    <td width="35%">Layanan</td>
                    <td width="1%">: </td>
                    <td width="64%">{{ $rsTrans->id_table == 0 ? 'Take Away' : 'Dine In' }}</td>
                </tr>
                @if ($rsTrans->id_table > 0)
                    <tr>
                        <td width="35%">Meja</td>
                        <td width="1%">: </td>
                        <td width="64%">{{ $rsTrans->no_table }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Kasir</td>
                    <td>: </td>
                    <td> {{ $rsTrans->name }}</td>
                </tr>
            </table>
        </header>
        <div class="content">
            <table width="100%">
                @php
                    $total = 0;
                @endphp
                @foreach ($details as $rsDetail)
                    <tr>
                        <td width="65%">
                            {{ $rsDetail->nm_menu_detail }}<br />
                            @ {{ number_format($rsDetail->harga_menu_detail, "0",",",".") }} x {{ $rsDetail->qty_menu_detail }}
                            @php
                                $subtotal = $rsDetail->harga_menu_detail * $rsDetail->qty_menu_detail;
                            @endphp
                        </td>
                        <td width="35%" class="right price">{{ number_format($subtotal, "0",",",".") }} </td>
                    </tr>
                    {{-- Menjumlahkan Subtotal --}}
                    @php
                        $total += $subtotal;
                    @endphp
                    {{-- End Sub Total --}}
                @endforeach
            </table>
        </div>
        <div class="grandtotal">
            {{-- Hitung Bayar --}}
            <table width="100%">
                <tr>
                    <td width="65%"><strong>TOTAL</strong></td>
                    <td class="right">{{ number_format($total, "0",",",".") }} </td>
                </tr>
                <tr>
                    <td width="65%"><strong>DISKON</strong></td>
                    <td class="right">{{ number_format($rsTrans->diskon_trans, "0",",",".") }}</td>
                </tr>
                <tr>
                    <td width="65%" style="font-size: 12px;"><strong>BIAYA LAYANAN</strong></td>
                    <td class="right">{{ number_format($rsTrans->by_layanan_trans, "0",",",".") }}</td>
                </tr>
                <tr>
                    <td width="65%"><strong>PPN 10%</strong></td>
                    <td class="right">{{ number_format($rsTrans->tax_trans, "0",",",".") }}</td>
                </tr>
                <tr>
                    <td width="65%"><strong>AMOUNT</strong></td>
                    <td class="right">{{ number_format($rsTrans->gtotal_trans, '0',',','.') }} </td>
                </tr>
            </table>
        </div>
        <div class="thank">
            <p>Thank You For Your Visit !</p>
        </div>
    </div>
    {{-- Print --}}
    <script>
        window.print();
    </script>
</body>

</html>
