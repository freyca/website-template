<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;
use Exception;
use Illuminate\Support\Str;
use Ssheduardo\Redsys\Facades\Redsys;

class BizumPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    protected string $key;

    protected string $merchantcode;

    protected int $terminal;

    protected string $enviroment;

    protected string $urlOk;

    protected string $urlKo;

    protected string $urlNotification;

    protected string $tradeName;

    protected string $titular;

    protected string $description;

    public function __construct()
    {
        $this->key = config('payments.redsys.key'); // @phpstan-ignore-line
        $this->merchantcode = config('payments.redsys.merchantcode'); // @phpstan-ignore-line
        $this->terminal = intval(config('payments.redsys.terminal')); // @phpstan-ignore-line
        $this->enviroment = config('payments.enviroment'); // @phpstan-ignore-line
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
    public function payPurchase(Order $order): string
    {
        try {
            Redsys::setAmount($order->purchase_cost);
            Redsys::setOrder(Str::take($order->id, 12));
            Redsys::setMerchantcode($this->merchantcode);
            Redsys::setCurrency(978); // Euros
            Redsys::setTransactiontype(0);
            Redsys::setTerminal($this->terminal);
            Redsys::setMethod('z');
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

            return Redsys::executeRedirection();
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
