<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServicesModel;
use App\Http\Requests\Backend\Services\StoreServicesRequest;
use App\Repositories\Backend\Services\ServiceRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\PermissionRepository;

class ServicesController extends Controller
{
    protected $model;

    public function __construct(ServiceRepository $service)
     {
       $this->service = $service;
     }

    //display list of services
    public function index()
    {
      return view('backend.services.index')
            ->with('service', $this->service->getActivePaginated(5, 'id', 'DESC'));
    }

    // create the view of service
    public function create(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
      return view('backend.services.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    //insert the data in services
    public function store(StoreServicesRequest $request)
    {
        if($request->graphic_type == 'icon'){
            $request->graphic_content;
        }
        if($request->graphic_type== 'image'){
            if ($request->hasFile('graphic_content')) {
               $image = $request->file('graphic_content'); //get the file
               $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
               $destinationPath = public_path('/img/backend/Services/image');//public path
               $image->move($destinationPath, $img_name);//mve to destination you mentioned
            }
             isset($img_name)?$img_name:'';
        }
        $this->service->create($request->only(
            'title',
            'graphic_type',
            'graphic_content',
            'page_description',
            'status'
        ));
       return redirect()->route('admin.services')->withFlashSuccess(__('alerts.backend.services.created'));
    }




    public function edit($id)
    {
      $service = ServicesModel::where('id', $id)->first();
      return view('backend.services.edit',compact('service'));
    }


    public function update(StoreServicesRequest $request, ServicesModel $service, $id='null')
    {
      if($request->graphic_type == 'icon'){
            $request->graphic_content;
        }
        if($request->graphic_type== 'image'){
            if ($request->hasFile('graphic_content')) {
               $image = $request->file('graphic_content'); //get the file
               $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
               $destinationPath = public_path('/img/backend/Services/image');//public path
               $image->move($destinationPath, $img_name);//mve to destination you mentioned
            }
             isset($img_name)?$img_name:'';
        }
       $this->service->update($service, $request->only(
            'title',
            'graphic_type',
            'graphic_content',
            'page_description',
            'status'
        ));

    }

    public function destroy($id)
    {
       $this->service->delete($id);
       return redirect()->route('admin.services')->withFlashDanger(__('alerts.backend.services.deleted'));
    }

    //custom function for create the page slug
    public static function slugify($text)
    {
       // replace non letter or digits by -
       $text = preg_replace('~[^\pL\d]+~u', '_', $text);

       // transliterate
       $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
       $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '_', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
       return 'n-a';
      }
       return $text;
    }
}
