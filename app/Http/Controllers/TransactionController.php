<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\Menu;
use App\Models\Table;
use App\Models\Detail;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;


class TransactionController extends Controller
{
    public $title = "Transactions";

    public function index()
    {
        $data = [
            "title" => $this->title,
            "page_title"  => $this->title,
            "dtTrans" => DB::table('transactions')
            ->join("users","transactions.id_cashier","=","users.id")
            ->leftJoin("tables","transactions.id_table","=","tables.id")
            ->select("transactions.*","users.name","tables.no_table")
            ->get()
        ];

        return view('transaction.data',$data);
    }


    public function create()
    {
        $data = [
            "title" => $this->title,
            "dtMenu" => Menu::all(),
            "dtCustomer" => Customer::where("status_cus",1)->get(),
            "dtMeja" => Table::all(),
            "dtCategory" => Category::all()
        ];

        return view('transaction.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        
        $notrans = "P".date("Ymdhis").Str::upper(Str::random(5));
        
        try {
            // Simpan Data Transaksi
            
            Transaction::create([
                "no_trans" => $notrans,
                "tgl_trans" => date("Y-m-d"),
                "layanan_trans" => $request->input('layanan'),
                "id_table" => $request->input('id_meja'),
                "id_cashier" => 1,
                "kd_customer" => $request->input('kd_cus'),
                "nm_customer" => $request->input('nm_cus'),
                "gtotal_trans" => $request->input('gtotal'),
                "diskon_trans" => $request->input('diskon'),
                "by_layanan_trans" => $request->input('blayanan'),
                "tax_trans" => $request->input('tax'),
                "pay_trans" => $request->input('gtotal'),
                "type_payment_trans" => 'Cash',
                "payment_with_trans" => '',
                "number_card_trans" => '',
                "status_trans" => 1,
        ]);

         // Simpan Detail Menu yang di Pesan
         $detail = $request->input('detail');
         
         foreach($detail as $rsDetail){
            Detail::create([
                "no_trans" => $notrans,
                "id_menu_detail" => $rsDetail["id_menu"], 
                "nm_menu_detail" => $rsDetail["nm_menu"],
                "harga_menu_detail" => $rsDetail["harga_menu"], 
                "qty_menu_detail" => $rsDetail["jumlah_menu"],
            ]);
        }

        $notif = [
            "type" => "success",
            "text" => "Data berhasil disimpan !",
            "status" => 200
        ];
    
    } catch(Exception $err){
        $notif = [
            "type" => "danger",
            "text" => "Data gagal disimpan !".$er->getMessage(),
            "status" => 500,
            "url_nota" => route('trans.cetak',$notrans)
        ];

    }

        return response()->json($notif);
    } 
    
    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            Transaction::where("id",$request->id_trans)->update([
                "status_trans" => $request->status
            ]);

            $notif = [
                'type' => "success",
                "text" => "Data berhasil disimpan !"
            ];

        } catch(Exception $err){
            $notif = [
                'type' => "danger",
                "text" => "Data gagal disimpan !"
            ];
        }

        return redirect()->back()->with('notif',$notif);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cetak(Request $request)
    {
        $data = [
            "rsTrans" => DB::table('transactions')
            ->join("users","transactions.id_cashier","=","users.id")
            ->leftJoin("tables","transactions.id_table","=","tables.id")
            ->select("transactions.*","users.name","tables.no_table")
            ->where("transactions.no_trans","=",$request->no_trans)
            ->first(),
            "details" => Detail::where('no_trans',$request->no_trans)->get()
        ];

        return view('transaction.nota',$data);
        
    }
}
