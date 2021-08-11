<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories =  Category::when($request->search, function ($query, $value) {
            $query->where('Title', 'LIKE', "%{$value}%");
        })
            ->paginate();

        $this->readers();
        $this->total_news();
        $user = Auth::user();
        $notifications = $user->notifications;

        return view('admin.category.index', [
            'categories' => $categories,
            'notifications' => $notifications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        return view('admin.category.create', [
            'category' => new Category(),
            'notifications' => $notifications
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
        // dd($request->all());
        $slug = Str::slug($request->title);

        $request->merge([
            'slug' => $slug
        ]);

        $category = Category::create($request->all());
        return redirect()->route('admin.category.index')->with(
            "success",
            "category " . $category->title . " craeted!"
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $user = Auth::user();
        $notifications = $user->notifications;
        return view('admin.category.edit', [
            "category" => $category,
            'notifications' => $notifications
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
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.category.index')->with(
            "success",
            "category " . $category->title . " updated!"
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
        $category = Category::findOrFail($id);
        Category::destroy($id);
        return redirect()->route('admin.category.index')->with(
            "success",
            "category " . $category->title . " deleted!"
        );
    }

    public function validatin_Rule(Request $request)
    {
        return $request->validate(
            [
                'title' => 'required|min:4|max:10',
                'status' => 'required',
                'description' => 'min:10|max:300',
                'slug' => 'unique'

            ]
        );
    }
    public function readers()
    {


        foreach (Category::all() as $category) {
            $contents = $category->contents;
            $count = 0;
            foreach ($contents as $content) {

                $count = $content->visitor + $count;
            }

            if ($category->visitor != $count) {
                $category->visitor = $count;
                $category->save();
            }
        }
    }
    public function total_news()
    {

        $count = 0;
        foreach (Category::all() as $category) {

            $count = $category->contents->count();
            if ($category->total_news != $count) {
                $category->total_news = $count;
                $category->save();
            }
        }
    }
}
