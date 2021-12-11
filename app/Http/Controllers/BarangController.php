<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Response;
use Yajra\DataTables\DataTables;
use Validator;

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
                $btn = '<button class="mb-2 mr-2 btn btn-sm btn-warning btnEdit" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="pe-7s-pen"></i></button>';
                $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-danger btnHapus" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Hapus" data-placement="bottom"><i class="pe-7s-trash"></button>';                
                return $btn ;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('logistik.barang.index');
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
}
