<?php

    function sign_form_data(string $key, array $data) : string {
        ksort($data);
        $s = '';
        foreach($data as $k=>$value) {
            if (in_array(gettype($value), array('array', 'object', 'NULL')) ){
                continue;
            }
            if(is_bool($value)){
                $s .= $value ? "true" : "false";
            } else {
                $s .= $value;
            }
        }
        return hash_hmac('sha512', strtolower($s), $key);
    }


    $data = [
        'merchant' => '1135',
        'amount' => '100.00',
        'in_curr' => 'UAH',
        'payment' => '',
        'externalid' => '130',
        'expiry' => '6000',
        'client_email' => 'khmara@mail.ua',
        'callback_url' => 'http://mjt.grebola.com/order_handler',
        'redirect_url' => 'http://mjt.grebola.com/order_page/'
    ];
    $key = 'tyEepYR_99pyw3c8K9wYlwofXPIdtM6AOssyMI6PpXy0IvN_spVR7I3Djmh5tpD_hLkj';

    $sign = sign_form_data( $key, $data )
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form name="payment" method="post" action="https://sci.any.money/invoice" accept-charset="UTF-8">
                    <!-- ToDo -->
                    <input type="hidden" name="sign" value="<?php echo( $sign ); ?>"/>
                    <input type="hidden" name="merchant" value="1135"/>
                    <input type="hidden" name="amount" value="100.00"/>
                    <input type="hidden" name="in_curr" value="UAH"/>
                    <input type="hidden" name="payway" value=""/>
                    <input type="hidden" name="externalid" value="130"/>
                    <input type="hidden" name="expiry" value="6000"/>
                    <input type="hidden" name="client_email" value="khmara@mail.ua"/>
                    <input type="hidden" name="callback_url" value="http://mjt.grebola.com/order_handler"/>
                    <input type="hidden" name="redirect_url" value="http://mjt.grebola.com/order_page/"/>
                    <input type="submit" value="Pay">
                </form>
            </div>
        </div>
    </div>
