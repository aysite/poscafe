<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public $title = "Category";

    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "dtCategory" => Category::all()
        ];

        return view('category.data',$data);
    }


    public function create()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "edit" => false
        ];

        return view('category.form',$data);
    }


    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create([
                "nm_category" => $request->input('nm_category'),
                "icon_category" => $request->input('icon_category'),
            ]);

            // Notif Jika Berhasil Disimpan
            $notif = [
                'type' => "success",
                "text" => "Data berhasil disimpan !"
            ];
        } catch(Exception $err){
            // Notif Jika gagal menyimpan
            $notif = [
                'type' => "danger",
                "text" => "Data gagal disimpan !"
            ];
        }

        return redirect(route('category.index'))->with('notif',$notif);
    }

    
    public function show(Category $category)
    {
        
    }


    public function edit(Category $category)
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "edit" => true,
            "rsCategory" => Category::where("id",$category->id)->first()
        ];

        return view('category.form',$data);
    }

    
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            Category::find($category->id)->update([
                "nm_category" => $request->input('nm_category'),
                "icon_category" => $request->input('icon_category'),
            ]);

            // Notif Jika Berhasil Disimpan
            $notif = [
                'type' => "success",
                "text" => "Data berhasil diubah !"
            ];
        } catch(Exception $err){
            // Notif Jika gagal menyimpan
            $notif = [
                'type' => "danger",
                "text" => "Data gagal diubah !"
            ];
        }

        return redirect(route('category.index'))->with('notif',$notif);
    }

    
    public function destroy(Category $category)
    {
        try {
            Category::find($category->id)->delete();

            // Notif Jika Berhasil Disimpan
            $notif = [
                'type' => "success",
                "text" => "Data berhasil dihapus !"
            ];
        } catch(Exception $err){
            // Notif Jika gagal menyimpan
            $notif = [
                'type' => "danger",
                "text" => "Data gagal dihapus !"
            ];
        }

        return back()->with('notif',$notif);
    }
}
