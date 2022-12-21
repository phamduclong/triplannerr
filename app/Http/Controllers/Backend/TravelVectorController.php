<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TravelVector;
use App\Http\Controllers\Controller;
use File;
use Auth;

/**
 * Class TourCarrierRepository.
 */
class TravelVectorController  extends Controller
{
    
    public function index(Request $request)
    {
        $travel_vectors = TravelVector::with('parent')->orderBy('id','desc')->paginate(10);
        return view('backend.travel_vectors.index', compact('travel_vectors'));
    }
 
    
    public function create(Request $request)
    {
        $travel_vectors = TravelVector::where(['parent_id' => 0])->select('id', 'name')->pluck('name', 'id')->toArray();

        return view('backend.travel_vectors.create',compact('travel_vectors'));
    }

    public function store(Request $request){
        $form_data = $request->all();

        $travel_vector = [
            'name'      => $form_data['name'],
            'parent_id' => isset($form_data['parent_id']) ? $form_data['parent_id'] : 0,
            'vector_type'   => $form_data['vector_type'] 
        ];

        if(TravelVector::create($travel_vector)){
            return redirect()->route('admin.travel_vectors')->withFlashSuccess(__('Travel vector has been created successfully'));
        }
        else{
            return redirect()->back()->withFlashWarning(__('There is some problem in creating vector. please try again'));
        }
    }


    public function edit($id = null){
        $travel_vectors = TravelVector::where(['parent_id' => 0])->select('id', 'name')->pluck('name', 'id')->toArray();
        $travel_vector = TravelVector::where(['id' => $id])->first();
        if(!empty($travel_vector)){
            return view('backend.travel_vectors.edit', compact('travel_vector', 'travel_vectors'));
        }
        else{
            return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));
        }
    }

    public function update(Request $request, $id = null){
        $form_data = $request->all();
        if(!empty($id) && $id >= 1){
            $travel_vector = TravelVector::where(['id' => $id])->first();
            if(!empty($travel_vector)){
                if(TravelVector::where(['id' => $id])->update(['name'      => $form_data['name'],
            'parent_id' => isset($form_data['parent_id']) ? $form_data['parent_id'] : 0,
            'vector_type'   => $form_data['vector_type']]) ){
                    return redirect()->route('admin.travel_vectors')->withFlashSuccess(__('Travel vector has been updated successfully'));
                }
                else{
                    return redirect()->back()->withFlashWarning(__('There is some problem in creating vector. please try again'));
                }
            }
            else{
                return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));
            }
        }else{
            return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));
        }
    }


    public function status($id = null){
        if(!empty($id)){
            $travel_vector = TravelVector::where(['id' => $id])->first();
            if(!empty($travel_vector)){
                $status = ($travel_vector->status == '1') ? '0' : '1' ;
                
                if(TravelVector::where(['id' => $id])->update(['status' => $status])){
                    return redirect()->route('admin.travel_vectors')->withFlashSuccess('Status has been updated');
                }
                else{
                    return redirect()->back()->withFlashWarning(__('There is some problem in updating status'));  
                }
            }
            else{
                return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));  
            }
        }
        else{
            return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));
        }
    }


    public function destroy($id = null){
        if(!empty($id)){
            $travel_vector = TravelVector::where(['id' => $id])->first();
            if(TravelVector::where(['id' => $id])->delete()){
                return redirect()->route('admin.travel_vectors')->withFlashSuccess('Travel vector has been added');
            }
            else{
                return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));  
            }
        }
        else{
            return redirect()->back()->withFlashWarning(__('Selected vector does not exists with us. Please try again'));
        }
    }

}
