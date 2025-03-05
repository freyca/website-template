<?php

namespace App\Http\Controllers;

use App\DTO\SeoTags;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Database\Order\Order\OrderRepositoryInterface;
use App\Services\Cart;
use App\Services\Payment;
use App\Services\ProductsWithDiscountPerPurchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class PaymentController extends Controller
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly Cart $cart,
        private readonly ProductsWithDiscountPerPurchase $purchasedProducts,
    ) {}

    public function redirectToPayment(Order $order)
    {
        $paymentService = new Payment($order);

        return $paymentService->payPurchase();
    }

    public function orderFinishedOk(Order $order): View
    {
        $this->cart->clear();

        // Refreshes user purchased products in cart session so discounts
        // can be applied if decides to make another purchase
        $this->purchasedProducts->savePurchasedProducts(true);

        return view('pages.purchase-complete', [
            'order' => $order,
            'seotags' => new SeoTags('order_ok'),
        ]);
    }

    public function orderFinishedKo(Order $order): View
    {
        $this->cart->clear();

        $this->orderRepository->changeStatus($order, OrderStatus::PaymentFailed);

        return view('pages.purchase-complete', [
            'order' => $order,
            'seotags' => new SeoTags('order_ko'),
        ]);
    }

    public function paymentGatewayNotification(Order $order, Request $request): void
    {
        $paymentService = new Payment($order);
        $paymentService->isGatewayOkWithPayment($request);
    }

    public function paypalGatewayNotification(Request $request): void
    {
        try {
            $order_id = $request->resource['purchase_units'][0]['invoice_id'];
            $order = $this->orderRepository->find($order_id);

            if ($order === null) {
                throw new Exception('Invalid PayPal request '.json_encode($request->all()));
            }

            $this->paymentGatewayNotification($order, $request);
        } catch (Throwable $th) {
            throw ($th);
        }
    }
}
