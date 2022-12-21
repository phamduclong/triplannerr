<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SocialSetting;
use App\Http\Requests\Backend\SocialSetting\SocialSettingRequest;
use App\Http\Controllers\Controller;

class SocialSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $social_setting = SocialSetting::orderby('id','DESC')->get();
       return view('backend.social_setting.index', compact('social_setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $social_setting = SocialSetting::orderby('id','DESC')->first();
        return view('backend.social_setting.create', compact('social_setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $update=SocialSetting::where('id','1')->first();
        if(!empty($update)){
            $update->fb_url = isset($request->fb_url)?$request->fb_url:'';
            $update->twitter_url = isset($request->twitter_url)?$request->twitter_url:'';
            $update->instagram_url = isset($request->instagram_url)?$request->instagram_url:'';
            $update->tiktok_url = isset($request->tiktok_url)?$request->tiktok_url:'';
            
            $update->save();

        }else{
            $data=new SocialSetting;
            $data->fb_url = $request->fb_url;
            $data->twitter_url = $request->twitter_url;
            $data->instagram_url = $request->instagram_url;
            $data->tiktok_url = $request->tiktok_url;
            $data->save();
        }
        
        

      return redirect()->route('admin.social_settings.add')->withFlashSuccess(__('alerts.backend.social_setting.updated'));
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
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       // echo $id;
        $static_page_edit = SocialSetting::where('id', $id)->first();
        return view('backend.social_setting.edit', compact('social_setting_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialSettingRequest $request, $id)
    {
        //
        $data = SocialSetting::find($id) ;

        $data->name = $request->name;
        $data->url = $request->page_url;
        $data->description = $request->page_description;

        $slug = $this->slugify($request->name);

        $data->slug = $slug;
        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;
        $data->meta_keywords = $request->meta_keyword;
        $data->status = 1;

        $data->save();

        return redirect()->route('admin.social_setting')->withFlashSuccess(__('alerts.backend.social_setting.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      SocialSetting::where('id', $id)->delete();
        return redirect()->route('admin.social_setting')->withFlashDanger(__('alerts.backend.social_setting.deleted'));
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

