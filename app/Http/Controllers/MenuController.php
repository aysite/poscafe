<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Menu;
use App\Models\Kitchen;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    
    public $title = "Menu";

    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "dtMenu" => Menu::with('category','kitchen')->get(),
        ];

        return view('menu.data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "dtCategory" => Category::all(),
            "dtKitchen" => Kitchen::all(),
            "edit" => false
        ];

        return view('menu.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        try {

            // Upload Foto
            if($request->file("file_foto")){
                $fileName = Str::random(6).time().'.'.$request->file("file_foto")->extension();
                // Proses Upload
                $result = $request->file("file_foto")->move(public_path('uploads/menu'), $fileName);
            } else {
                $fileName = null;
            }
            
            // Simpan Data Menu
            Menu::create([
            "kd_menu" => $request->input('kd_menu'),
            "nm_menu" => $request->input('nm_menu'),
            "id_cat_menu" => $request->input('id_cat_menu'),
            "harga_menu" => $request->input('harga_menu'),
            "id_kitchen_menu" => $request->input('id_kitchen_menu'),
            "satuan_menu" => $request->input('satuan_menu'),
            "stok_menu" => $request->input('stok_menu'),
            "desc_menu" => $request->input('desc_menu'),
            "foto_menu" => $fileName,
            
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

        return redirect(route('menu.index'))->with('notif',$notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "edit" => true,
            "rsCategory" => Category::where("id",$category->id)->first()
        ];

        return view('category.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        try {

            // Upload Foto
            if($request->file("file_foto")){
                $fileName = Str::random(6).time().'.'.$request->file("file_foto")->extension();
                // Proses Upload
                $result = $request->file("file_foto")->move(public_path('uploads/menu'), $fileName);
            } else {
                $fileName = $request->input('old_foto');
            }
            
            // Simpan Data Menu
            Menu::find($menu-id)->update([
            "kd_menu" => $request->input('kd_menu'),
            "nm_menu" => $request->input('nm_menu'),
            "id_cat_menu" => $request->input('id_cat_menu'),
            "harga_menu" => $request->input('harga_menu'),
            "id_kitchen_menu" => $request->input('id_kitchen_menu'),
            "satuan_menu" => $request->input('satuan_menu'),
            "stok_menu" => $request->input('stok_menu'),
            "desc_menu" => $request->input('desc_menu'),
            "foto_menu" => $fileName,
            
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

        return redirect(route('menu.index'))->with('notif',$notif);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        try {
            Menu::find($menu->id)->delete();

            // Notif Jika Berhasil Dihapus
            $notif = [
                'type' => "success",
                "text" => "Data berhasil dihapus !"
            ];
        } catch(Exception $err){
            // Notif Jika gagal Dihapus
            $notif = [
                'type' => "danger",
                "text" => "Data gagal dihapus !"
            ];
        }

        return back()->with('notif',$notif);
    }
}
