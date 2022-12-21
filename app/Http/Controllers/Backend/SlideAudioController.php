<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SliderAudio;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\SliderAudioRepository;
use File;
use Carbon\Carbon;


class SlideAudioController extends Controller
{

   /**
     * @var tourCarrierRepository
     */
    protected $SliderAudioRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(SliderAudioRepository $sliderAudioRepository)
    {
        $this->SliderAudioRepository = $sliderAudioRepository;
    }

   
   public function index(Request $request)
    {
        $audiodata=SliderAudio::orderby('id','asc')->get();
        
         return view('backend.slider_audio.index')->with('audiodata', $this->SliderAudioRepository->getActivePaginated(10, 'id', 'DESC'));
           
    }

   public function create()
    {
        
        return view('backend.slider_audio.create');
    }

  public function store(Request $request)
    {
      //dd($request->all());
     
         $posts_music = new SliderAudio;
         

         $file = $request->slide_audio;
         $filename = time() . '.' . $file->getClientOriginalExtension();
            
         //echo public_path('audio/backend/'.$filename); die;

         $file->move(public_path('audio/backend/'), $filename);
         
         $posts_music->title = $request->title;
         $posts_music->slide_audio = $filename;
         $posts_music->save();

         return redirect()->route('admin.slider_audio')->withFlashSuccess(__('alerts.backend.slider_audio.created'));
      
     }

      public function edit($id)
      {
        $audiodata=SliderAudio::where('id',$id)->first();
        return view('backend.slider_audio.edit',compact('audiodata','id'));
      }


      public function update(Request $request, $id = null)
      { 
        $slideaudio = SliderAudio::where(['id' => $id])->first();
          
        if ($request->hasFile('slide_audio'))
           {
            $slide_row = $request->file('slide_audio');
            $filename = $slide_row->getClientOriginalName();
            $extension = $slide_row->getClientOriginalExtension();
            $fileName = time() . '.' .$extension;
            $slide_row->move(public_path('/audio/backend/'), $fileName);
             
             }else{
   
                 $fileName = $request->oldaudio;
           }
        $data = SliderAudio::find($id);
        $data->slide_audio = $fileName;
        $data->status = '1';
        $data->save();
        return redirect()->route('admin.slider_audio')->withFlashSuccess(__('alerts.backend.slider_audio.updated')); 
      }

      public function status($id = null){
        if(!empty($id)){
            $slider_audio = SliderAudio::where(['id' => $id])->first();
            if(!empty($slider_audio)){
                $status = ($slider_audio->status == '1') ? '0' : '1' ;
                
                if(SliderAudio::where(['id' => $id])->update(['status' => $status])){
                    return redirect()->route('admin.slider_audio')->withFlashSuccess('Status has been updated');
                }
                else{
                    return redirect()->back()->withFlashWarning(__('There is some problem in updating status'));  
                }
            } 
            else{
                return redirect()->back()->withFlashWarning(__('Selected audio does not exists with us. Please try again'));  
            }
        }
        else{
            return redirect()->back()->withFlashWarning(__('Selected audio does not exists with us. Please try again'));
        }
    }

    public function getDeactivated()
    {

        $slider_audio = SliderAudio::where('status','0')->orderBy('deleted_at','DESC')->paginate(10); 
        return view('backend.slider_audio.deactivated', compact('slider_audio'));
        
    }

     public function destroy(Request $request, SliderAudio $slider_audio, $id)
    {
        SliderAudio::where('id', $id)->delete();
        $this->SliderAudioRepository->forceDelete($slider_audio);

        return redirect()->route('admin.slider_audio.deleted')->withFlashSuccess(__('alerts.backend.slider_audio.deleted'));
    }

    public function getDeleted()
    {

        $slider_audio = SliderAudio::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.slider_audio.deleted', compact('slider_audio'));
    }

    public function restore($id){   
      
        $slider_audio= DB::table('slider_audio')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/slideaudio/deleted');
    }
      
}  
