<?php

namespace Techcouchits\Genie\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Env;
use Ramsey\Uuid\Uuid;
use Techcouchits\Genie\Models\Payment;

class GenieController extends Controller
{
    public function geniepayment(Request $request)
    {
        $apikey = env("GENIE_API");
        $redirecturl = env("GENIE_REDIRECT_URL");
        $amount = $request->amount * 100;

        if ($request->reference == null) {
            $reference = Uuid::uuid4();
        } else {
            $reference = $request->reference;
        }

        Payment::create($request->all());

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.geniebiz.lk/public/v2/transactions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => (int)$amount,
                'currency' => 'LKR',
                "customerReference" => $reference,
                "redirectUrl" => $redirecturl . "?reference" . $reference
            ]),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: " . $apikey,
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response);
        return redirect($data->url);
    }

    public function paymentRedirect(Request $request)
    {
        $reference = $request->reference;
        $status = $request->state;
        $invoices = Payment::where('reference', $reference)->first();
        if ($status == "CONFIRMED") {
            $order = Payment::where('reference', $reference)->update(['paymentstatus' => 1]);
            toastr()->success('Your Order has Successfully placed');
            return redirect()->route('/');
        } elseif ($status == "CANCELLED") {
            $order = Payment::where('reference', $reference)->update(['paymentstatus' => 3]);
            toastr()->warning('Your Order has been Canceled');
            return redirect()->route('/');
        }
    }
}
