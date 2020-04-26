<base href="{{ asset('') }}">

<div marginheight="0" marginwidth="0" style="background:#f0f0f0">
    <div id="wrapper" style="background-color:#f0f0f0">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
            style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
            <tbody>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border-bottom:1px solid #ff3333" cellpadding="0" cellspacing="0"
                            border="0">
                            <tbody>
                                <tr>
                                    <td colspan="3" height="2"></td>
                                </tr>
                                <tr style="line-height:0px">
                                    <td width="100%" style="font-size:0px" align="center" height="1"><img
                                            src="https://cf.shopee.vn/file/a165a88e2bdc421d104dc8fa6db354a6"
                                            style="max-height:100px;width:150px" alt="" width="40px" class="CToWUd">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style=" line-height:25px" border="0"
                                            align="center">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" height="3"></td>
                                                </tr>
                                                <tr>
                                                    <td width="36"></td>
                                                    <td width="454" align="left"
                                                        style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:proxima_nova,'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif';max-width:454px"
                                                        valign="top">
                                                        <p
                                                            style="text-align:left;font-family:'Atlas Grotesk','Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif';font-size:14px;color:#555555;line-height:25px">
                                                        </p>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:24px;font-weight:300;line-height:32px"
                                                                        align="center">
                                                                        <b style="color: #ee4d2d">Asics &
                                                                            Mizuno<br>Shoes Volleyballs</b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br>
                                                        <a href="https://www.dropbox.com/l/AACM1bItR5RN3-XIuVzPXkiT0fRhAqQey7w/downloading"
                                                            target="_blank"
                                                            data-saferedirecturl="https://www.google.com/url?q=https://www.dropbox.com/l/AACM1bItR5RN3-XIuVzPXkiT0fRhAqQey7w/downloading&amp;source=gmail&amp;ust=1587539229204000&amp;usg=AFQjCNEPmkGpQdCET5XPueNV68s048KLCQ">
                                                            <center><img width="100%" style="max-width:300px"
                                                                    src="https://i.pinimg.com/originals/9d/60/2c/9d602c4db36e1cea6a168f0ad895793e.jpg"
                                                                    class="CToWUd"></center>
                                                        </a>

                                                    </td>
                                                    <td width="36"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" height="36"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                        Bill Detail for you have order success!!!
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="middle"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                        Hi {{ $order->customer->name }},
                                        <br> Thank you for shopping at Asics & Mizuno
                                        <br>
                                        <br> Your order is
                                        <b> waiting shop</b>
                                        <b> confirm</b> (within 24h)
                                        <br> We will inform <b>order status</b> in the next email.
                                        <br> Please check your email regularly.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border:1px solid #ff3333;border-top:3px solid #ff3333" cellpadding="0"
                            cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td colspan="2" align="left" valign="top"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px">
                                        <b>Your order #</b>
                                        <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none"
                                            target="_blank">{{ $order->id }}
                                        </a>
                                        <span
                                            style="font-size:12px">{{ date("M d, Y H:i", strtotime($order->created_at)) }}</span>
                                    </td>
                                </tr>
                                <?php $i =0?>
                                @foreach ($orderdetail as $item)

                                <tr>
                                    <td align="left" valign="top">
                                        <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px">
                                                        <b>Products</b>
                                                    </td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                                        :</td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">

                                                        {{ $item->name_product }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px">
                                                        <b>Information order:</b>
                                                    </td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                                        :</td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                        Quantity: {{ $order->bill_detail->sum('quantity')  }}
                                                        - Size:{{ $item->size }}
                                                        - Id product: SKU00{{ $item->id }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                                        <b>Total payment:</b>
                                                    </td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                                        :</td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                        {{ number_format($item->total_price, 2) }} VND &nbsp;

                                                        @if(($item->unit_price * $order->bill_detail->sum('quantity') )
                                                        > $item->total_price)
                                                        <span
                                                            style="text-decoration: line-through; font-size: 11px; font-weight:400; color: #b2b2b2;">
                                                            {{ number_format($item->unit_price * $order->bill_detail->sum('quantity') ) }}VND
                                                        </span>
                                                        @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px">
                                                        <b>Receiver: </b>
                                                    </td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                                        :</td>
                                                    <td align="left" valign="top"
                                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                        <b>{{ $order->customer->name }}</b> -
                                                        +84 {{ $order->customer->phone }}
                                                        <br>
                                                        {{ $order->customer->address }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <?php $i ++?>
                                @endforeach


                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                        <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="middle"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                        This is an automated mail from the system. Please do not reply to this email.
                                        <br> If you have any questions or need help, please visit
                                        <b>
                                            <ul>
                                                <li>Start Something New on <a href="{{ route('shoesHome') }}"
                                                        target="_blank"
                                                        data-saferedirecturl="">asicsmizuochinhhang.com</a>
                                                </li>
                                                {{-- <li>Authentic Products, Free Delivery*, Easy Exchange and Return, Express Store
                                                    Pickup</li>
                                                <li>FashionStore.com: Shop Anytime, Anywhere!</li> --}}
                                            </ul>
                                        </b>
                                        <center><a
                                                style="border-radius:6px;font-size:15px;color:white;text-decoration:none;padding:14px 7px 14px 7px;width:210px;max-width:210px;font-family:proxima_nova,'Open Sans','lucida grande','Segoe UI',arial,verdana,'lucida sans unicode',tahoma,sans-serif;margin:6px auto;display:block;background-color:#007ee5;text-align:center"
                                                href="{{ route('shoesHome') }}" target="_blank"
                                                data-saferedirecturl="">Go
                                                To Shop Now</a></center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
