<?php

namespace App\Http\Controllers\Integration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckBalanceRequest;
use App\Traits\GeneralTrait;
use GuzzleHttp\Client;
use Validator;

class ResellerController extends Controller
{

    use GeneralTrait;

    public function _checkBalance(CheckBalanceRequest $request)
    {
        

        try {
            
           
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
            ]);
            $response = $client->post('https://bbapi.ocstaging.net/integration/check-balance', [
                'json' => [
                    'resellerUsername' => $request->resellerUsername,
                    'password' => md5($request->resellerUsername.$request->secretKey),
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $this->returnData("data", $data);

        } catch (\Exception $e) {
            return $this->returnError("s001", "something went wrong !");
        } catch (\Throwable $th){
            return $this->returnError("s001", "something went wrong!");
        }

        
    
    }

    public function detailedProductsList(Request $request)
    {
        
        try {
            
            $validator = Validator::make($request->all(), [
                'resellerUsername' => 'required|string|max:255',
                'secretKey' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('https://bbapi.ocstaging.net/integration/detailed-products-list', [
                'json' => [
                    'resellerUsername' => $request->resellerUsername,
                    'password' => md5($request->resellerUsername.$request->secretKey),
                    'merchantId' => "",
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $this->returnData("data", $data);

        } catch (\Exception $e) {
            return $this->returnError("s001", "something went wrong !");
        } catch (\Throwable $th){
            return $this->returnError("s001", "something went wrong!");
        }

        
    
    }

    public function productDetailedInfo(Request $request)
    {
        
        try {
            
            $validator = Validator::make($request->all(), [
                'resellerUsername' => 'required|string|max:255',
                'secretKey' => 'required|string|max:255',
                'productID' => 'required'
            ]);

            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('https://bbapi.ocstaging.net/integration/product-detailed-info', [
                'json' => [
                    'resellerUsername' => $request->resellerUsername,
                    'password' => md5($request->resellerUsername.$request->productID.$request->secretKey),
                    'productID' => $request->productID,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $this->returnData("data", $data);

        } catch (\Exception $e) {
            return $this->returnError("s001", "something went wrong !");
        } catch (\Throwable $th){
            return $this->returnError("s001", "something went wrong!");
        }

        
    
    }
    
    public function purchaseProduct(Request $request)
    {
        
        try {
            
            $validator = Validator::make($request->all(), [
                'resellerUsername' => 'required|string|max:255',
                'secretKey' => 'required|string|max:255',
                'productID' => 'required',
                'resellerRefNumber' => 'required',
            ]);

            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('https://bbapi.ocstaging.net/integration/purchase-product', [
                'json' => [
                    'resellerUsername' => $request->resellerUsername,
                    'password' => md5($request->resellerUsername.$request->productID.$request->resellerRefNumber.$request->secretKey),
                    'productID' => $request->productID,
                    'resellerRefNumber'=> $request->resellerRefNumber
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $this->returnData("data", $data);

        } catch (\Exception $e) {
            return $this->returnError("s001", "something went wrong !");
        } catch (\Throwable $th){
            return $this->returnError("s001", "something went wrong!");
        }

        
    
    }

    public function checkTransactionStatus(Request $request)
    {
        
        try {
            
            $validator = Validator::make($request->all(), [
                'resellerUsername' => 'required|string|max:255',
                'secretKey' => 'required|string|max:255',
                'resellerRefNumber' => 'required',
            ]);

            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('https://bbapi.ocstaging.net/integration/check-transaction-status', [
                'json' => [
                    'resellerUsername' => $request->resellerUsername,
                    'password' => md5($request->resellerUsername.$request->resellerRefNumber.$request->secretKey),
                    'resellerRefNumber'=> $request->resellerRefNumber
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $this->returnData("data", $data);

        } catch (\Exception $e) {
            return $this->returnError("s001", "something went wrong !");
        } catch (\Throwable $th){
            return $this->returnError("s001", "something went wrong!");
        }

        
    
    }

    public function reconcile(Request $request)
    {
        
        try {
            
            $validator = Validator::make($request->all(), [
                'resellerUsername' => 'required|string|max:255',
                'secretKey' => 'required|string|max:255',
                'dateFrom' => 'required',
                'dateTo' => 'required',
                'isSuccessful' => 'required',
            ]);

            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('https://bbapi.ocstaging.net/integration/reconcile', [
                'json' => [
                    'resellerUsername' => $request->resellerUsername,
                    'password' => md5($request->resellerUsername.$request->dateFrom.$request->dateTo.$request->isSuccessful.$request->secretKey),
                    'dateFrom'=> $request->dateFrom,
                    'dateTo'=> $request->dateTo,
                    'isSuccessful'=> $request->isSuccessful,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $this->returnData("data", $data);

        } catch (\Exception $e) {
            return $this->returnError("s001", "something went wrong !");
        } catch (\Throwable $th){
            return $this->returnError("s001", "something went wrong!");
        }

        
    
    }

}
