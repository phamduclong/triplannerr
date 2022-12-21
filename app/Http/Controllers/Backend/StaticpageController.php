<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\StaticpageModel;
use App\Http\Requests\Backend\Staticpage\StoreStaticpageRequest;
use App\Http\Controllers\Controller;
use Log;

class StaticpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $static_page = StaticpageModel::orderby('id','DESC')->paginate(10);
       return view('backend.staticpage.index', compact('static_page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.staticpage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new StaticpageModel;
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

      return redirect()->route('admin.staticpage')->withFlashSuccess(__('alerts.backend.static_page.created'));
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
        $static_page_edit = StaticpageModel::where('id', $id)->first();

        //handle long description
        $long_description = null;
        if(strlen($static_page_edit->description) > 3500){
            $long_description = [];
            $numberOfRepetitions = floor(strlen($static_page_edit->description) / 3500);
            $redundantCharacters = strlen($static_page_edit->description) - 3500 * $numberOfRepetitions;

            $start = 0;
            $len = 3500;
            for($i = 0 ; $i < $numberOfRepetitions; ++$i){
                $sub_string = substr($static_page_edit->description, $start, $len);
                array_push($long_description, $sub_string);
                $start = $start + $len;
            }
            $redundantString = substr($static_page_edit->description, $start, $redundantCharacters);
            array_push($long_description, $redundantString);
            // Log::info($long_description);
            // dd();
        }
        //end handle long description
        return view('backend.staticpage.edit', compact('static_page_edit', 'long_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStaticpageRequest $request, $id)
    {
        //
        $data = StaticpageModel::find($id) ;
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
        return redirect()->route('admin.staticpage')->withFlashSuccess(__('alerts.backend.static_page.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      StaticpageModel::where('id', $id)->delete();
        return redirect()->route('admin.staticpage')->withFlashDanger(__('alerts.backend.static_page.deleted'));
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

    public function getDeleted()
    { 
        $staticpage = StaticpageModel::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.staticpage.deleted', compact('staticpage'));
    }

    public function restore($id)
    {   
        $staticpage= DB::table('static_pages')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/staticpage/deleted');
    }

}

