<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use DB;

class FeeAmountController extends Controller
{
       public function view()
    {
    	$data['allData']=FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        //$data['allData']=FeeCategoryAmount::all();
	    return view('backend.setup.fee_amount.view-fee-amount',$data);
    	//dd('ok');
    }

    public function add()
    {
    	$data['fee_categories']=FeeCategory::all();
    	$data['departments']=Department::all();
    	return view('backend.setup.fee_amount.add-fee-amount',$data);
    }

    public function store(Request $request)
    {
    	$countDept = count($request->department_id);
    	if($countDept !=NULL){
    		for ($i=0; $i <$countDept ; $i++) {
    			$fee_amount = new FeeCategoryAmount();
    			$fee_amount->fee_category_id = $request->fee_category_id;
    			$fee_amount->department_id = $request->department_id[$i];
    			$fee_amount->amount = $request->amount[$i];
    			$fee_amount-> save();
    		 
    		}
    	}
    	
    	return redirect()->route('setups.fee.amount.view')->with('success','Data inserted successfully!');
    }

    public function edit($fee_category_id)
    {
    	$data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('department_id','asc')->get();
        $data['fee_categories']=FeeCategory::all();
        $data['departments']=Department::all();
    	return view('backend.setup.fee_amount.edit-fee-amount',$data);
    }

   public function update(Request $request,$fee_category_id)
   {	
        if($request->department_id==NULL){
            return redirect()->back()->with('error','Sorry! yoy did not select any item');
        }
        else{
          FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();  
          $countDept = count($request->department_id);
            for ($i=0; $i <$countDept ; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->department_id = $request->department_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount-> save();
             
            } 
        }
   		
    	return redirect()->route('setups.fee.amount.view')->with('success','Data updated successfully!');
    }

    public function details($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('department_id','asc')->get();
        return view('backend.setup.fee_amount.details-fee-amount',$data);
    }


     public function delete(Request $request)
    {
    	//dd('ok');
        $data  = FeeCategoryAmount::find($request->id);

        $data->delete();
        return redirect()->route('setups.fee.category.view')->with('success','Data deleted successfully!');

    }


}
