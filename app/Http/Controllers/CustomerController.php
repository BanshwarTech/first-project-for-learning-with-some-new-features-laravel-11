<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $result['data'] = DB::table('customers')->get();
        // $result['data'] = DB::table('customers')->get();
        $result['data'] = DB::table('customers')->pluck('email', 'name');
        $result['age'] = DB::table('customers')->whereNotBetween('age', [18, 43])->get();
        $result['id'] = DB::table('customers')->whereIn('id', [1, 5, 2])->get();


        return $result;
        // return view('welcome', $result);
        // dump($result);
        // // echo "<pre>";
        // // print_r($result);
        // // echo "</pre>";
        // $json_data = json_encode($result);
        // // Return the JSON response
        // return response()->json($result);
        // foreach ($result as $res) {
        //     echo $res->name . "<br/>";
        // }

        // return view('welcome', $result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
