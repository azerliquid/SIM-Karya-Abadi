<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangInOut;
use Illuminate\Http\Request;
use Response;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Barang::where('deleted', 0)->get();
        // return response()->json($data);
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row)
            {
                $btn = '<a class="mb-2 mr-2 btn btn-sm btn-info btnDetail" href="/showdetail/'.$row->id.'" data-id="'.$row->id.'"  data-toggle="tooltip" title="Detail" data-placement="bottom"><i class="pe-7s-info"></i></a>';
                $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-warning btnEdit" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="pe-7s-pen"></i></button>';
                $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-danger btnHapus" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Hapus" data-placement="bottom"><i class="pe-7s-trash"></button>';                
                return $btn ;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        if (Auth::user()->role == 'admin') {
            return view('admin.logistik.barang.index');
        }
        if (Auth::user()->role == 'logistic') {
            return view('logistik.barang.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:120',
            'unit' => 'required|max:10'
        ];

        $messages = [
            'name.required' => 'Nama Barang wajib di isi',
            'name.max' => 'Nama barang maksimal 120 karakter',
            'unit.required' => 'Nama unit wajib di isi',
            'unit.max' => 'Nama barang maksimal 10 karakter',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $barang = new Barang;
            
            $barang->name = $request->name;
            $barang->unit = $request->unit;
            $barang->stock_now = 0;
            $barang->deleted = 0;
            
            $barang->save();
            
            return Response::json(['succes' => 'Data berhasil di inputkan']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:120',
            'unit' => 'required|max:10'
        ];

        $messages = [
            'name.required' => 'Nama Barang wajib di isi',
            'name.max' => 'Nama barang maksimal 120 karakter',
            'unit.required' => 'Nama unit wajib di isi',
            'unit.max' => 'Nama barang maksimal 10 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $barang = Barang::find($id);
            $barang->name = $request->name;
            $barang->unit = $request->unit;
            $barang->save();

            return Response::json(['succes' => 'Data berhasil diubah']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->deleted = 1;
        $barang->save();
    
        return Response::json(["succes" => "Data berhasil di hapus"]);

        // return Response::json($request);;
    }

    public function showDetail($id)
    {
        $barang = Barang::find($id);
        $masukTotal = DB::table('logistic')
        ->select(DB::raw('sum(qty) as masuk'))
        ->where('type', 'Masuk')
        ->where('id_barang', $id)->get();
        $keluarTotal = DB::table('logistic')
        ->select(DB::raw('sum(qty) as keluar'))
        ->where('type', 'Keluar')
        ->where('id_barang', $id)->get();
        // dd($masukTotal);
        if (Auth::user()->role = 'admin') {

            return view('admin.logistik.barang.detail', compact(['barang','masukTotal', 'keluarTotal']));
        }
        if (Auth::user()->role = 'logistik') {

            return view('logistik.barang.detail', compact(['barang','masukTotal', 'keluarTotal']));
        }
    }

    public function detailBarang(Request $request, $id)
    {
        $barang = DB::table('logistic')
        ->leftjoin('barang', 'logistic.id_barang', '=', 'barang.id')
        ->leftjoin('project', 'logistic.id_destination', '=', 'project.id')
        ->select('logistic.*', 'barang.name', 'project.name_project')
        ->where('logistic.id_barang', $id)->orderBy('logistic.date', 'DESC')->get();
        // $dtbarang = $barang[0]->baranginout;
        // return response()->json($barang);

        if ($request->ajax()) {
            return Datatables::of($barang)
            ->addIndexColumn()
            ->addColumn('date', function($row)
            {
                $date = Carbon::parse($row->date)->isoFormat('ddd, D MMM Y');
                return $date;
            })
            ->addColumn('type', function($row)
            {
                $tp = '<div class="badge badge-'.($row->type == "Masuk" ? "success" : "warning").'">'.$row->type.'</div>';
                return $tp;
            })
            ->addColumn('location', function($row)
            {
                $loc = $row->name_project == null ? '-' : $row->name_project;
                return $loc;
            })
            ->rawColumns(['date', 'type', 'location'])
            ->make(true);
        }
    }
}
