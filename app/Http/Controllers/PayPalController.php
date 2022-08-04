<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function payment(Request $request  ){
        // $data = [];
         $data['items']= $request->products;
                 // foreach($product as $item) {
        //     $data['items'].array_push([
        //         'name' => $item['name'],
        //         'price'=>$item.['price'],
        //         "desc"=>$item.['description'],
        //         'qty'=>$item.['quantity']
        //     ]);
        // }
        // $data['items'] = [
        //     [
        //         'name' => 'Product 1',
        //         'price' => 100,
        //         'desc' => 'Description for Product 1',
        //         'qty' => 1
        //     ]
        // ];

        $data['invoice_id'] = 1;

        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";

        $data['return_url'] = route('payment.success');

        $data['cancel_url'] = route('payment.cancel');

        $data['total'] = $request->total_price;

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);

         return redirect($response['paypal_link']);

    }

    public function paymentCancel()
    {
        return response()->json( 'Your payment has been declend. The payment cancelation page goes here!');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return response()->json(
                'Payment was successfull. The payment success page goes here!'
            );
        }

        return response()->json( 'something went wrong!') ;
    }

}
