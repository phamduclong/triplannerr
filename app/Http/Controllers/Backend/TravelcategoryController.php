<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TravelcategoryModel;
use App\Http\Requests\Backend\Travelcategory\StoreTravelcategoryRequest;
use App\Http\Requests\Backend\Travelcategory\UpdateTravelcategoryRequest;
use App\Repositories\Backend\TravelCategory\TravelCategoryRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\PermissionRepository;

class TravelcategoryController extends Controller
{

    protected $travecategory;

    public function __construct(TravelCategoryRepository $travecategory)
    {
        $this->travecategory = $travecategory;
    }


    public function index()
    {
        return view('backend.travelcateg.index')
            ->with('travel_categ', $this->travecategory->getActivePaginated(20, 'id', 'DESC'));
    }


    public function create(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        return view('backend.travelcateg.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    public function store(StoreTravelcategoryRequest $request)
    {
        if($request->graphic_type == 'icon'){
            $graphic_content=$request->graphic_content;
        }
        
        if($request->graphic_type== 'image'){
            if ($request->hasFile('graphic_content')) {
               $image = $request->file('graphic_content'); //get the file
               $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
               $destinationPath = public_path('/img/backend/travelcateg/image');//public path
               $image->move($destinationPath, $img_name);//mve to destination you mentioned
            }
            $graphic_content= isset($img_name)?$img_name:'';
        }
        $this->travecategory->create($request->only(
            'name',
            'graphic_type',
            'graphic_content',
            'description',
            'meta_title',
            'meta_description',
            'meta_keyword',
            'status'
        ),$graphic_content);
        return redirect()->route('admin.travelcateg')->withFlashSuccess(__('alerts.backend.travelcategory.created'));
    }

    public function edit($id)
    {
        $travel_categ_edit = TravelcategoryModel::where('id', $id)->first();
        return view('backend.travelcateg.edit', compact('travel_categ_edit'));
    }

    public function update(UpdateTravelcategoryRequest $request, TravelcategoryModel $travelcateg, $id='null')
    {
        //dd($request->all());
       if($request->graphic_type == 'icon'){
        $graphic_content= $request->graphic_content;
        }
        
        if($request->graphic_type== 'image'){
            if ($request->hasFile('graphic_content')) {
               $image = $request->file('graphic_content'); //get the file
               $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
               $destinationPath = public_path('/img/backend/travelcateg/image');//public path
               $image->move($destinationPath, $img_name);//mve to destination you mentioned
            }
            $graphic_content= isset($img_name)?$img_name:'';
        }

       $this->travecategory->update($request->only(
            'name',
            'graphic_type',
            'graphic_content',
            'description',
            'meta_title',
            'meta_description',
            'meta_keyword',
            'status'
        ),$graphic_content,$id);

        return redirect()->route('admin.travelcateg')->withFlashSuccess(__('alerts.backend.travelcategory.updated'));
    }

     public function getDeleted()
    { 
        $travelcategory = TravelcategoryModel::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.travelcateg.deleted', compact('travelcategory'));
    }


    public function destroy($id)
    {
        TravelcategoryModel::where('id', $id)->delete();
        return redirect()->route('admin.travelcateg')->withFlashDanger(__('alerts.backend.travelcategory.deleted'));
    }

    public function restore($id){   
      
        $travelcategory= DB::table('categories')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/travelcateg/deleted');
    }
 
}
