<?php

namespace App\Http\Controllers;

use App\Models\AdminsModel;
use App\Models\CmsPage;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Session::put('page','cms_pages');
        
        $cmspage=CmsPage::get()->toArray();

        // acess
        $cmspagescount=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->count();
        $pagesmodule=array();
        if(Auth::guard('admin')->user()->type=='admin'){
            $pagesmodule['view_acess']=1;
            $pagesmodule['edit_acess']=1;
            $pagesmodule['full_acess']=1;
        }else if($cmspagescount==0){
            $message="this feature restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $pagesmodule=AdminsModel::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->first()->toArray();
        }
        return view('admin.pages.cms_pages')->with(compact('cmspage','pagesmodule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Request $request, $id = null)
        {
            // Session::put('page','cms_pages');

            if (empty($id)) {
                $title = "Add Cms Page";
                $cmsPage = new CmsPage();
                $message = "CMS page added successfully";
            } else {
                $title = "Edit Cms Page";
                $cmsPage = CmsPage::find($id);
                $message = "CMS page updated successfully";
            }
        
            if ($request->isMethod('post')) {
                $data = $request->all();
        
                $rules = [
                    'Title' => 'required',
                    'URL' => 'required',
                    'Description' => 'required',
                    'Meta_Title' => 'required',
                    'Meta_Description' => 'required',
                    'Meta_Keywords' => 'required',
                ];
                
                $customMessage = [
                    'Title.required' => 'Title is required',
                    'URL.required' => 'URL is required',
                    'Description.required' => 'Description is required',
                    'Meta_Title.required' => 'Meta Title is required',
                    'Meta_Description.required' => 'Meta Description is required',
                    'Meta_Keywords.required' => 'Meta Keywords is required',
                ];
        
                $this->validate($request, $rules, $customMessage);
        
                $cmsPage->title = $data['Title'];
                $cmsPage->url = $data['URL'];
                $cmsPage->description = $data['Description'];
                $cmsPage->meta_title = $data['Meta_Title'];
                $cmsPage->meta_descriptions = $data['Meta_Description'];
                $cmsPage->meta_keywords = $data['Meta_Keywords'];
                $cmsPage->status = 1;
                $cmsPage->save();
                
                return redirect('admin/cms-page')->with('success_message', $message);

            }
        
            return view('admin.pages.add-edit-cms-page')->with(compact('title', 'cmsPage'));
        }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        //
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            CmsPage::where('id',$data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success_message','deleted successfully');
    }
    
}
