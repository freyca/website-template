<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;
use Exception;
use Ssheduardo\Redsys\Facades\Redsys;

class RedsysPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    private string $key;

    private string $merchantcode;

    private int $terminal;

    private string $enviroment;

    private string $urlOk;

    private string $urlKo;

    private string $urlNotification;

    private string $tradeName;

    private string $titular;

    private string $description;

    public function __construct()
    {
        $this->key = config('payments.redsys.key'); // @phpstan-ignore-line
        $this->merchantcode = config('payments.redsys.merchantcode'); // @phpstan-ignore-line
        $this->terminal = config('payments.redsys.terminal'); // @phpstan-ignore-line
        $this->enviroment = config('payments.redsys.enviroment'); // @phpstan-ignore-line
        $this->urlOk = url(config('payments.redsys.url_ok')); // @phpstan-ignore-line
        $this->urlKo = url(config('payments.redsys.url_ko')); // @phpstan-ignore-line
        $this->urlNotification = url(config('payments.redsys.url_notification')); // @phpstan-ignore-line
        $this->tradeName = config('payments.redsys.tradename'); // @phpstan-ignore-line
        $this->titular = config('payments.redsys.titular'); // @phpstan-ignore-line
        $this->description = config('payments.redsys.description'); // @phpstan-ignore-line
    }

    /**
     * @throws Exception
     */
    public function payPurchase(Order $order): bool
    {
        try {
            Redsys::setAmount($order->purchase_cost);
            Redsys::setOrder($order);
            Redsys::setMerchantcode($this->merchantcode);
            Redsys::setCurrency(978); // Euros
            Redsys::setTransactiontype(0);
            Redsys::setTerminal($this->terminal);
            Redsys::setMethod('T');
            Redsys::setNotification($this->urlNotification);
            Redsys::setUrlOk($this->urlOk);
            Redsys::setUrlKo($this->urlKo);
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName($this->tradeName);
            Redsys::setTitular($this->titular);
            Redsys::setProductDescription($this->description);
            Redsys::setEnviroment($this->enviroment);

            $signature = Redsys::generateMerchantSignature($this->key);

            Redsys::setMerchantSignature($signature);

            Redsys::setAttributesSubmit('btn_submit', 'btn_id', 'Enviar', 'display:none');

            Redsys::executeRedirection();

            return true;
        } catch (Exception $e) {

            throw $e;
        }
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        // TODO: get merchant params
        $merchantParams = [];

        try {
            $key = $this->key;
            $parameters = Redsys::getMerchantParameters($merchantParams);
            $DsResponse = $parameters['Ds_Response'];
            $DsResponse += 0;

            if (Redsys::check($key, $merchantParams) && $DsResponse <= 99) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
