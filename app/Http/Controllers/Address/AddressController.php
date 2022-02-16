<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerId = Auth()->user()->id;
        $address = Address::where("user_id", "=", $customerId)->get();
        return view("address.index", ['address' => $address]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("address.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'postcode.regex' => 'Please provide an Indian Postcode',
        ];

        $request->validate([
            'firstname' => 'required',
            'full_address' => 'required',
            'postcode' => 'required|regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/',
            'user_id' => 'required'

        ]);
        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'full_address' => $request->full_address,
            'postcode' => $request->postcode,
            'user_id' => $request->user_id
        ];
        Address::create($data);
        return redirect()->route("address.index")->with('success', 'Address Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::where("id", $id)->get();
        return view("address.edit", ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'firstname' => 'required',
            'full_address' => 'required',
            'postcode' => 'required|regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/',
            'user_id' => 'required'

        ]);
        $data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'full_address' => $request->full_address,
            'postcode' => $request->postcode,
            'user_id' => $request->user_id
        ];
        Address::find($id)->update($data);
        return redirect()->route("address.index")->with('success', 'Address Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Address::destroy($id);
        return redirect()->route("address.index")->with("success", "Address Deleted");
    }
    public function setAsBilling(Request $request)
    {
        $addressId = $request->address_id;
        $this->setBillingForCustomer($addressId);
        return redirect()->back();
    }
    private function setBillingForCustomer($addressId)
    {
        $customerId = Auth::user()->id;
        $getAllAddress = Address::where("user_id", '=', $customerId)->get();
        foreach ($getAllAddress as $address) {
            $address->is_billing = false;
            $address->save();
        }

        $getSelectedAddress = Address::find($addressId);
        $getSelectedAddress->is_billing = true;
        $getSelectedAddress->save();
    }
}
