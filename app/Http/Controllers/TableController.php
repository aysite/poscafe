<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use Exception;

class TableController extends Controller
{
    public $title = "Table";
    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title" => $this->title,
            "dtTable" => Table::all()
        ];

        return view('table.data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function save(Request $request)
    {
        // Validation
        $request->validate(
            [
                "no_table" => "required|max:15|unique:tables,no_table,".$request->input('id_table'),
                "capacity_table" => "required",
            ],
            [
                "no_table.required" => "Must be filled !",
                "no_table.max" => "Max 15 Characters !",
                "no_table.unique" => "Already Used !",
                "capacity_table.required" => "Must be filled !",
            ]
    );

    try {
        Table::updateOrCreate(
            [
                "id" => $request->input('id_table')
            ],
            [
                "no_table" => $request->input('no_table'),
                "capacity_table" => $request->input('capacity_table'),
                "status_table" => $request->input('status_table'),
            ]
        );

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

        return back()->with("notif",$notif);
    }

    public function destroy(Table $table)
    {
        try {
            Table::find($table->id)->delete();

            // Notif Jika Berhasil Disimpan
            $notif = [
                'type' => "success",
                "text" => "Data berhasil dihapus !"
            ];
        } catch(Exception $err){
            // Notif Jika gagal dihapus
            $notif = [
                'type' => "danger",
                "text" => "Data gagal dihapus !"
            ];
        }

        return back()->with("notif",$notif);
    }
}
