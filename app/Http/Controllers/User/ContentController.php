<?php

namespace App\Http\Controllers\User;

use App\Models\Content;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\NewContentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index(Request $request)
    {

$user_id=Auth::user()->id;
       $contents  =  User::find($user_id)->contents()->when($request->search, function ($query, $value) {
            $query->where('short_description', 'LIKE', "%{$value}%");
        })
            ->when($request->category, function ($query, $value) {
                $query->where('category_id', 'LIKE', $value);
            })
            ->with('category')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
           
           
             $total_category = Category::get()->count();
             $total_new = User::find($user_id)->contents()->get()->count();
             $categories = Category::all()->count();
     
             $total_visit = 0;
     
            
             foreach ($contents as $content) {
                 $total_visit = $total_visit + ($content->visitor);
             }

        return view('user.content.index', [
            'contents' => $contents,
            'categories' => Category::all(),
            'total_category' => $categories,
            'total_new' => $total_new,            
            'total_visit' => $total_visit,       
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.content.create', [
            'content' => new Content(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validatin_Rule($request);


        $slug = Str::slug($request->short_description);




        //  dd($data);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $file->store('/images', [
                'disk' => 'public'
            ]);
        }

        $content = Content::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->post('category'),
            'slug' => $slug,
            'short_description' => $request->post('short_description'),
            'new_content' => $request->post('new_content'),
            'image' => $image,
            'important'=>$request->post('important')
        ]);

        if ($request->hasFile('images')){
        foreach ($request->file('images') as $file) {
            $image_path = $file->store('/images', [
                'disk' => 'public'
            ]);
            $content->images()->create([
                'image_path' => $image_path
            ]);
        }}



$admin=User::where('type','admin')->first();
$admin->notify(new NewContentNotification($content));
        return redirect()->route('user.content.index')->with(
            "success",
            "content " . $content->short_description . " craeted!"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   $content=Content::findOrFail($id);
   return view('user.content.show',[
    'content'=>$content ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('user.content.edit', [
            "content" => $content,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validatin_Rule($request);

        $slug = Str::slug($request->title);
        $content = Content::findOrFail($id);
$image=$content->image;
$previous=null;
        if ($request->hasFile('image')) {
            $previous=$content->image;
            $file = $request->file('image');
            $image = $file->store('/images', [
                'disk' => 'public'
            ]);

        }

    //   dd($image);

        $content->update([
            'user_id' => Auth::user()->id,
            'category_id' => $request->post('category'),
            'slug' => $slug,
            'short_description' => $request->post('short_description'),
            'new_content' => $request->post('new_content'),
            'image' => $image,
            'important'=>$request->post('important')
        ]);

if($previous!=null){
    Storage::disk('public')->delete($previous);
}

        if ($request->hasFile('images')){
            foreach($content->images as $image){
                $content->images()->delete();
      
                 Storage::disk('public')->delete($image);
             }
        foreach ($request->file('images') as $file) {
            $image_path = $file->store('/images', [
                'disk' => 'public'
            ]);
            $content->images()->create([
                'image_path' => $image_path
            ]);

             }
             
    }
        return redirect()->route('user.content.index')->with(
            "success",
            "content " . $content->title . " updated!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        if($content->image){
            Storage::disk('public')->delete($content->image);
        }
        if($content->images){
  foreach($content->images as $image){
    Storage::disk('public')->delete($image);
  }}

        return redirect()->route('user.content.index')->with(
            "success",
            "content " . $content->title . " deleted!"
        );
    }

    public function validatin_Rule(Request $request)
    {
        return $request->validate(
            [
                'short_description' => 'required|min:8|max:300',

                'new_content' => 'required|min:8',
                'slug' => 'unique',
                'image'=>'image|max:3000',

            ]
        );
    }
}
