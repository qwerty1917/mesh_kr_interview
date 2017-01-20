<?php

namespace App\Http\Controllers;

use Log;
use Request;
use Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    private function compare_created($a, $b)
    {
        return strcmp($a['created_at'], $b['created_at']);
    }

    public function dashboard() {
        // view load
        $view = view('dashboard');

        // logic
        $request = Request::create('/holding_items', 'GET');
        $response = json_decode(Route::dispatch($request)->content(), true);

        $holding_items_sell = [];
        $holding_items_buy  = [];

        foreach ($response as $item){
            if ($item['type'] == 's'){
                array_push($holding_items_sell, $item);
            } elseif ($item['type'] == 'b'){
                array_push($holding_items_buy, $item);
            }
        }

        // payload
        $view->holding_items_sell = $holding_items_sell;
        $view->holding_items_buy  = $holding_items_buy;

        // return
        return $view;
    }

    public function deal_post() {
        // validation
        $rule = [
            'price' => ['required', 'integer'],
            'share' => ['required', 'integer']
        ];;

        $validator = Validator::make(Input::all(), $rule);

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }

        // logic
        $my_type  = Input::get('_type');
        $price = Input::get('price');
        $share = Input::get('share');
        $op_type = '';
        if ($my_type == 's'){
            $op_type = 'b';
        }elseif($my_type == 'b'){
            $op_type = 's';
        }

        $originalInput = Request::input();
        $request = Request::create('/holding_items', 'GET');
        Request::replace($request->input());
        $response = json_decode(Route::dispatch($request)->content(), true);
        Request::replace($originalInput);

        $holding_items_to_deal = [];

        foreach ($response as $item){
            if ($item['type'] == $op_type && $item['price'] == $price){
                array_push($holding_items_to_deal, $item);
            }
        }

        usort($holding_items_to_deal, array($this, "compare_created"));

        foreach ($holding_items_to_deal as $item_to_deal){
            if ($item_to_deal['share'] > $share){
                $item_to_deal['share'] = $item_to_deal['share'] - $share;
                $share = 0;

                // $item_to_deal id 기준으로 찾아서 share 수정
                $originalInput = Request::input();
                $request = Request::create('/holding_items/'.$item_to_deal['id'], 'PUT', array(
                    '_token'=>csrf_token(),
                    'ip'=>$item_to_deal['ip'],
                    'type'=>$item_to_deal['type'],
                    'price'=>$item_to_deal['price'],
                    'share'=>$item_to_deal['share']
                ));
                Request::replace($request->input());
                $response = json_decode(Route::dispatch($request)->content(), true);
                Request::replace($originalInput);

            } elseif ($item_to_deal['share'] < $share){
                $share = $share - $item_to_deal['share'];

                // $item_to_deal id 기준으로 찾아서 삭제
                $originalInput = Request::input();
                $request = Request::create('/holding_items/'.$item_to_deal['id'], 'DELETE', array(
                    '_token'=>csrf_token(),
                ));
                Request::replace($request->input());
                $response = json_decode(Route::dispatch($request)->content(), true);
                Request::replace($originalInput);

            } else {
                $share = 0;
                // $item_to_deal id 기준으로 찾아서 삭제
                $originalInput = Request::input();
                $request = Request::create('/holding_items/'.$item_to_deal['id'], 'DELETE', array(
                    '_token'=>csrf_token(),
                ));
                Request::replace($request->input());
                $response = json_decode(Route::dispatch($request)->content(), true);
                Request::replace($originalInput);
            }
        }
        if ($share != 0){
            $originalInput = Request::input();
            $request = Request::create('/holding_items', 'POST', array(
                '_token'=>csrf_token(),
                'ip'=>Request::ip(),
                'type'=>$my_type,
                'price'=>$price,
                'share'=>$share
            ));
            Request::replace($request->input());
            $response = json_decode(Route::dispatch($request)->content(), true);
            Request::replace($originalInput);
            Log::info('This is some useful.'.$my_type);
        }

        // return
        return redirect()->route('main');
    }
}
