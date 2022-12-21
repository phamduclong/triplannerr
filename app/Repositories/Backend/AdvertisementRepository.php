<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use Auth;
use App\Exceptions\GeneralException;
use Validator;




/**
 * Class TravelReportRepository.
 */
class AdvertisementRepository extends BaseRepository 
{
    /**
     * AdvertisementRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(Advertisement $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getActivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

  
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data 
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */

    public function create(array $data) : Advertisement
    {

        return DB::transaction(function () use ($data) {
         $embeddata='';
          if(isset($data['embedded_link']) && !empty($data['embedded_link']))
          {
            if (str_contains($data['embedded_link'], 'embed'))
            {
              $embeddata= isset($data['embedded_link'])?$data['embedded_link']:'';
            }
            else
            {
              $embed=explode('be', $data['embedded_link']);
              $url=isset($embed[1])?$embed[1]:'';
              $embeddata='https://www.youtube.com/embed'.$url;
            }
          }  
             
               if($data['type']=='Image'){
                      
                    if($data['type_file'])
                    {
                    
                      $imgName = time().'.'.$data['type_file']->getClientOriginalExtension();
                      $data['type_file']->move(public_path('img/backend/advertisement'), $imgName);
                     }else{
                     
                      $imgName = isset($data['type_file'])?$data['type_file']:'';
                     }

                    $data['type_file']= $imgName;
                }


                
                if($data['type']=='Video'){
                  
                
                     if(!empty($data['type_file']))
                     {
                    
                      $vdoName = time().'.'.$data['type_file']->getClientOriginalExtension();
                      $data['type_file']->move(public_path('img/backend/advertisement'), $vdoName);
                     }else{
                     
                      $vdoName = isset($data['type_file'])?$data['type_file']:'';
                     }
                      $data['type_file']= $vdoName;
                   
                 }

                $url = url('/');

                if(isset($data['travel_pro'])){
                    $travel_pro_id = $data['travel_pro'];
                    $travelPro = User::where('id', $data['travel_pro'])->first();
                    $first_name = $travelPro->first_name;
                    $last_name = $travelPro->last_name;
                    $role_type = $travelPro->role_type;
                    $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . $data['travel_pro'];
                }else{
                    $travel_pro_id = Auth::user()->id;
                    $first_name = Auth::user()->first_name;
                    $last_name = Auth::user()->last_name;
                    $role_type = Auth::user()->role_type;

                    $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . Auth::user()->id;
                }
                
                
                $advertisement = $this->model::create([
                    'type_file' =>isset($data['type_file'])?$data['type_file']:'',
                    'type' => $data['type'],
                    'ad_url' => $data['ad_url'],
                    'category_id' => $data['category_id'],
                    'country_departure' => $data['country'],
                    'age' => $data['age'],
                    'travel_type' => $data['travel_types'],
                    'vector_type' => $data['vector_type'],
                    'type_of_accomodation' => $data['travel_accommodations'],
                    'type_of_participant' => $data['travel_participates'],
                    'preffered_stay_formula' => $data['travel_formula'],
                    'type_of_fav_meal' => $data['travel_mealtype'],
                    'budget' => $data['travel_budget'],
                    'description' => strip_tags($data['description1']),
                    'title' => $data['title'],
                    'view' => $data['view'],
                    'embedded_link' => isset($embeddata)?$embeddata:'',
                    'location' => $data['location'],
                    // 'ads_type' => $data['ads_type'],
                    // 'status' =>$data['status'],
                    'status' => null,
                    'travel_pro_id' => $travel_pro_id,
                    'travel_pro_name' => strtolower($first_name.$last_name),
                    'travel_pro_link' => $url . '/' . $link
                ]);
            return $advertisement;
        });

    }

     public function update(Advertisement $advertisement, array $data) : Advertisement
    {
        return DB::transaction(function () use ($advertisement, $data) {
             
              if($data['type']=='image'){
                    
                    if(!empty($data['type_file']))
                    {
                    
                      $imgName = time().'.'.$data['type_file']->getClientOriginalExtension();
                      $data['type_file']->move(public_path('img/backend/advertisement'), $imgName);
                      
                        $data['type_file']= $imgName;
                        $data['embedded_link'] ='';
                     }else{
                        $data['embedded_link'] ='';
                        $data['type_file'] = $advertisement->type_file;
                     }

                   
                }
                
                if($data['type']=='video'){
                 
                     if(!empty($data['type_file']))
                     {
                       
                      $vdoName = time().'.'.$data['type_file']->getClientOriginalExtension();
                      $data['type_file']->move(public_path('img/backend/advertisement'), $vdoName);
                      $data['type_file'] = $vdoName; 
                      $data['embedded_link'] ='';
                     }else{
                        
                      
                       if(empty($data['embedded_link'])){
                              $data['embedded_link'] ='';
                              $vdoName = $advertisement->type_file;
                              $data['type_file']= $vdoName;
                          }
                          else{
                              $data['embedded_link'] = $data['embedded_link'];
                              $vdoName = '';
                              $data['type_file']= '';
                          }
                       }
                 }

            $travelPro = User::where('id', $data['travel_pro'])->first();
            $firstName = $travelPro->first_name;
            $lastName = $travelPro->last_name;
            $roleType = $travelPro->role_type;
            $url = url('/');
            $link = 'profile/'. $roleType . '/' . strtolower($firstName.$lastName) . '/' . $data['travel_pro'];

        
            if ($advertisement->update([
                    'type_file' => $data['type_file'],
                    'type' => $data['type'],
                    'ad_url' => $data['ad_url'],
                    'category_id' => $data['category_id'],
                    'country_departure' => $data['country'],
                    'age' => $data['age'],
                    'travel_type' => $data['travel_types'],
                    'vector_type' => $data['vector_type'],
                    'type_of_accomodation' => $data['travel_accommodations'],
                    'type_of_participant' => $data['travel_participates'],
                    'preffered_stay_formula' => $data['travel_formula'],
                    'type_of_fav_meal' => $data['travel_mealtype'],
                    'budget' => $data['travel_budget'],
                    'description' => strip_tags($data['description1']),
                    'title' => $data['title'],
                    'view' => $data['view'],
                    'embedded_link' => $data['embedded_link'],
                    'location' => $data['location'],
                    'ads_type' => $data['ads_type'],
                    'status' =>$data['status'],
                    'travel_pro_id' => $data['travel_pro'],
                    'travel_pro_name' => strtolower($firstName.$lastName),
                    'travel_pro_link' => $url . '/' . $link
            ]))

             {
              //dd($advertisement);
                return $advertisement;
            } 
 
        });
    }

    public function mark(Advertisement $advertisement, $id=null) : Advertisement
    {
        $thisuser=DB::table('advertisements')->where('id',$id)->first();
      if($thisuser->status=='1')
       {
        
        $dstatus=array('status'=>'0');
        
         DB::table('advertisements')->where('id',$id)->update($dstatus);
        
       }
        else
        {
            
        $dstatus=array('status'=>'1');
         DB::table('advertisements')->where('id',$id)->update($dstatus);
        }
        
        return $advertisement;
    }

     public function forceDelete(Advertisement $advertisement) : Advertisement
    {
        if ($advertisement->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.advertisements.deleted'));
        }

        return DB::transaction(function () use ($advertisement) {
            // Delete associated relationships
            $advertisement->passwordHistories()->delete();
            $advertisement->providers()->delete();

            if ($advertisement->forceDelete()) {
                event(new UserPermanentlyDeleted($advertisement));

                return $advertisement;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }
    
}
