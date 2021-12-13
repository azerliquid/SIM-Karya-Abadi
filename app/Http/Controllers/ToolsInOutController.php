<?php

namespace App\Http\Controllers;

use App\Models\ToolsInOut;
use App\Models\Barang;
use App\Models\Project;
use Illuminate\Http\Request;
// use App\Models\ToolsInOut;
use Response;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ToolsInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ToolsInOut::with('barang', 'project')->get();
        // $date = Carbon::createFromDate('d/m/Y', $data[0]->date_in);
                // return $date;
        
        // $date = new Carbon;
        // return Response::json($date);
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('date_in', function($row)
            {
                $date = Carbon::parse($row->date_in)->isoFormat('ddd, D MMM Y');
                return $date;
            })
            ->addColumn('barang', function($row)
            {
                $brg = $row->barang->name;
                return $brg;
            })
            ->addColumn('proyek', function($row)
            {
                $prj = $row->project->name_project;
                return $prj;
            })
            ->addColumn('stock_out', function($row)
            {
                $out = $row->stock_out == 0 ? "-" : $row->stock_out;
                return $out;
            })
            ->addColumn('aksi', function($row)
            {
                $btn = '<button class="mb-2 mr-2 btn btn-sm btn-warning btnEdit" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="pe-7s-pen"></i></button>';
                $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-danger btnHapus" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Hapus" data-placement="bottom"><i class="pe-7s-trash"></button>';                
                return $btn ;
            })
            ->rawColumns(['date_in','barang', 'proyek', 'aksi', 'stock_out'])
            ->make(true);
        }
        
        return view('logistik.baranginout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $barang = Barang::where('deleted', 0)->get();
        $proyek = Project::select( 'id', 'name_project')->where('status', 'Aktif')->where('deleted', 0)->get();
        return Response::json(['barang' => $barang, 'proyek' => $proyek] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToolsInOut  $toolsInOut
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $data)
    {
        return Response::json($data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToolsInOut  $toolsInOut
     * @return \Illuminate\Http\Response
     */
    public function edit(ToolsInOut $toolsInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ToolsInOut  $toolsInOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToolsInOut $toolsInOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToolsInOut  $toolsInOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToolsInOut $toolsInOut)
    {
        //
    }
}
