<?php

class payment_robokassa_pay_method_request_all extends \Robokassa\Payment\WC_WP_robokassa {
    public function __construct() {
        $this->id = 'all';
        $this->method_title = 'Robokassa';
        $this->long_name = 'Оплата через Robokassa';
        $this->description = get_option('RobokassaOrderPageDescription', 'Оплатить через Robokassa');

        parent::__construct();
    }
}

class payment_robokassa_pay_method_request_Podeli extends \Robokassa\Payment\WC_WP_robokassa {
    public function __construct() {
        $this->id = 'Podeli';
        $this->method_title = 'Robokassa';
        $this->long_name='Оплата через Robokassa';
        $this->title = 'Robokassa Х Подели';

        ob_start();
        podeli_checkout_widget();
        $podeli_widget_content = ob_get_clean();

        $this->description = '25% сегодня, остальное - тремя платежами раз в 2 недели' . $podeli_widget_content;

        parent::__construct();
    }
}

/**
 * @var array $methods
 *
 * @return array
 */
function robokassa_payment_add_WC_WP_robokassa_class($methods = null) {
    $methods[] = 'payment_robokassa_pay_method_request_all';
    if (get_option('robokassa_podeli') == '1' && WC()->cart->total >= 300 && WC()->cart->total <= 30000) {
        $methods[] = 'payment_robokassa_pay_method_request_Podeli';
    }

    return $methods;
}