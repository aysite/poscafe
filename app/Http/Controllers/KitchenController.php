<?php

namespace App\Http\Controllers;

use App\Models\Kitchen;
use App\Http\Requests\StoreKitchenRequest;
use App\Http\Requests\UpdateKitchenRequest;
use Exception;

class KitchenController extends Controller
{
    
    public $title = "Kitchen";

    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "dtKitchen" => Kitchen::all(),
            "edit" => false
        ];

        return view('kitchen.data',$data);
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
    public function store(StoreKitchenRequest $request)
    {
        try {
            Kitchen::create([
                "nm_kitchen" => $request->input('nm_kitchen'),
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

        return back()->with('notif',$notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kitchen $kitchen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kitchen $kitchen)
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "edit" => true,
            "rsKitchen" => Kitchen::where("id",$kitchen->id)->first(),
            "dtKitchen" => Kitchen::all(),
        ];

        return view('kitchen.data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKitchenRequest $request, Kitchen $kitchen)
    {
        try {
            Kitchen::find($kitchen->id)->update([
                "nm_kitchen" => $request->input('nm_kitchen'),
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

        return back()->with('notif',$notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kitchen $kitchen)
    {
        try {
            Kitchen::find($kitchen->id)->delete();

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
