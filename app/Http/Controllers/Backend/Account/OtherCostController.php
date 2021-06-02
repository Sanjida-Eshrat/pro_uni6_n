<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountOtherCost;

class OtherCostController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountOtherCost::orderBy('id','desc')->get();
        return view('backend.account.cost.other-cost-view',$data);
    }

    public function add()
    {
        return view('backend.account.cost.other-cost-add');
    }

    public function store(Request $request)
    {
    	$cost = new AccountOtherCost();
    	$cost->date = date('Y-m-d',strtotime($request->date));
    	$cost->amount = $request->amount;
    	if ($request->file('image')){
    		$file = $request->file('image');
    	    $filename = date('YmdHi').$file->getClientOriginalName();
    	    $file->move(public_path('upload/cost_images'),$filename);
    	    $cost['image'] = $filename;
    	}
    	$cost->description = $request->description;
    	$cost->save();

    	return redirect()->route('accounts.cost.view')->with('success','Data saved successfully.');
    }

    public function edit($id)
    {
        $data['editData'] = AccountOtherCost::find();
        return view('backend.account.cost.other-cost-add',$data);
    }

    public function update(Request $request, $id)
    {
        $cost = AccountOtherCost::find();
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        if ($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image'] = $filename;
        }
        $cost->description = $equest->description;
        $cost->save();

        return redirect()->route('accounts.cost.view')->with('success','Data updated successfully.');
    }
}