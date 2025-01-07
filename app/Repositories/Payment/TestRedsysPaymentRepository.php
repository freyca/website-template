<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Repositories\Payment\Traits\PaymentActions;

class TestRedsysPaymentRepository extends RedsysPaymentRepository
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
        $this->key = config('payments.redsys-test.key'); // @phpstan-ignore-line
        $this->merchantcode = config('payments.redsys-test.merchantcode'); // @phpstan-ignore-line
        $this->terminal = intval(config('payments.redsys-test.terminal')); // @phpstan-ignore-line
        $this->enviroment = config('payments.enviroment'); // @phpstan-ignore-line
        $this->urlOk = url(config('payments.redsys-test.url_ok')); // @phpstan-ignore-line
        $this->urlKo = url(config('payments.redsys-test.url_ko')); // @phpstan-ignore-line
        $this->urlNotification = url(config('payments.redsys-test.url_notification')); // @phpstan-ignore-line
        $this->tradeName = config('payments.redsys-test.tradename'); // @phpstan-ignore-line
        $this->titular = config('payments.redsys-test.titular'); // @phpstan-ignore-line
        $this->description = config('payments.redsys-test.description'); // @phpstan-ignore-line
    }
}
