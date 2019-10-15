<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = App\User::count();
        $customers = App\Customer::count();
        $purchases = App\Purchase::count();
        $items = App\Item::count();
        $purchase = new App\Purchase;

        $chartValuePurchase = App\Purchase::select('deliveryOption', DB::raw('count(*) as total'))->groupBy('deliveryOption')->get();

        return $purchase->deliveries;

        return view('home', [
          'cards' => [
            'items' => [
              'color' => 'bg-aqua',
              'icon' => 'ion-ios-box-outline',
              'title' => 'Barang',
              'value' => $items,
            ],
            'customers' => [
              'color' => 'bg-yellow',
              'icon' => 'ion-ios-people-outline',
              'title' => 'Customer',
              'value' => $customers,
            ],
            'purchases' => [
              'color' => 'bg-green',
              'icon' => 'ion-ios-cart-outline',
              'title' => 'Pembelian',
              'value' => $purchases,
            ],
            'users' => [
              'color' => 'bg-red',
              'icon' => 'ion-ios-person-outline',
              'title' => 'Admin',
              'value' => $users,
            ],
          ],
          'purchases' => [
            'label' => $purchase->deliveries,
            'value' => $chartValuePurchase,
          ],
        ]);
    }
}
