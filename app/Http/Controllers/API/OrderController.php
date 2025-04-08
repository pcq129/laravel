<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Table;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        if ($orders) {
            return response()->json([
                "code" => "200",
                "status" => "true",
                "data" => $orders,
                "message" => "Orders fetched successfully"
            ]);
        } else {
            return response()->json([
                "code" => "200",
                "status" => "false",
                "message" => "Error fetching orders"
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->order_data);

        $validator = Validator::make($request->all(), [
            'customer_id' => ['numeric', 'required'],
            'order_data'=>['json', 'required'],
            'amount'=> ['numeric', 'required']
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'status' => 'false', 'message' => $validator->messages(),], 200);
        }

        // {
        //     "customer_id": 2,
        //     "order_data": {
        //       "items": [
        //         {
        //           "item_id": 3,
        //           "item_name": "Veg Sandwich",
        //           "item_rate": 184.5,
        //           "modifiers": []
        //         },
        //         {
        //           "item_id": 2,
        //           "item_name": "Thin Crust",
        //           "item_rate": 560.88,
        //           "modifiers": []
        //         }
        //       ],
        //       "taxes": {
        //         "GST": 134.1,
        //         "SGST": 134.1,
        //         "CGST": 0,
        //         "Service charges": 230
        //       },
        //       "subTotal": 745,
        //       "total": 1243.2
        //     },
        //     "amount": 1243.2
        //   }

        $newOrder = new Order();
        $newOrder->customer_id = $request->customer_id;
        $newOrder->status = "Ordered";
        $newOrder->isServed = false;
        $newOrder->order_data = $request->order_data;
        $newOrder->amount = $request->amount;
        $newOrder->save();



        $table_ids = json_decode($request->order_data)->tables;
        Table::whereIn('id', $table_ids)->update(['status' => 'Running']);
            

        return response()->json([
            "code" => "200",
            "status" => "true",
            "data"=> $newOrder->id,
            "message" => "Order placed successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order) {}
}
