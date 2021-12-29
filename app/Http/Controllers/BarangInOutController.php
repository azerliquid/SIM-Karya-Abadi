<?php

namespace App\Http\Controllers;

use App\Models\BarangInOut;
use App\Models\Barang;
use App\Models\Project;
use Illuminate\Http\Request;
// use App\Models\ToolsInOut;
use Response;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class BarangInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $end = Carbon::now()->isoFormat('MM/DD/YYYY');
        $start = Carbon::now()->subDays(3)->isoFormat('MM/DD/YYYY');
        // $date = array('start' => $start, 'end' => $end );
        return view('logistik.baranginout.index', compact(['end', 'start']));
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
        // return Response::json('sini');
        $data = $request->data;
        // return Response::json($data['listItem']);

        $totalItem = count($data['listItem']);
        $dataItem = $data['listItem'];
        $datenow = Carbon::now();

        // return Response::json($dataItem[0]);

        // update barang masuk/keluar
        for ($i=0; $i < $totalItem; $i++) { 
            $logistic = new BarangInOut;
            $logistic->date = $datenow;
            $logistic->type = $data['type'];
            $logistic->destination = 'Kantor';
            $logistic->id_destination = 0 ;
            $logistic->id_barang = $dataItem[$i]['id_barang'];
            $logistic->qty = $dataItem[$i]['qty'];
            
            $logistic->save();

            // update stok barang
            if ($data['tertuju'] == "Kantor") {
                $barang = Barang::find($dataItem[$i]['id_barang']);
                $barang->stock_now = $barang->stock_now + $dataItem[$i]['qty'];
                $barang->save();
            }
            
            if ($data['tertuju'] == "Proyek") {
                for ($i=0; $i < $totalItem; $i++) { 
                    $logisticout = new BarangInOut;
                    $logisticout->date = $datenow;
                    $logisticout->type = "Keluar";
                    $logisticout->destination = $data['tertuju'];
                    $logisticout->id_destination = $data['lokasi'];
                    $logisticout->id_barang = $dataItem[$i]['id_barang'];
                    $logisticout->qty = $dataItem[$i]['qty'];
                    // $logisticout->description = $data['keterangan'] == NULL ? NULL : $data['keterangan'];
        
                    $logisticout->save();
                }
            }
        }

        return Response::json("sukses");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangInOut  $BarangInOut
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $data)
    {
        return Response::json($data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangInOut  $BarangInOut
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangInOut $BarangInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangInOut  $BarangInOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangInOut $BarangInOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangInOut  $BarangInOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangInOut $BarangInOut)
    {
        //
    }

    public function showData(Request $request, $type, $start, $end)
    {
        
        // $date = Carbon::createFromDate('d/m/Y', $data[0]->date_in);
        // return $date;
        
        // $end = Carbon::createFromFormat('YYYY-MM-DD', $end);
        // $start = Carbon::createFromFormat('YYYY-MM-DD', $start);
        // $end = Carbon::createFromFormat('MM/DD/YYYY', $end)->format('YYYY-MM-DD');
        $newEnd = Carbon::parse($end);
        $newStart = Carbon::parse($start);

        // return Response::json($endO);
        
        $data = $this->setDataByType($type, $newStart, $newEnd);
        
        if ($request->ajax()) {
            // $date = new Carbon;
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function($row)
            {
                $date = Carbon::parse($row->date)->isoFormat('ddd, D MMM Y');
                return $date;
            })
            ->addColumn('barang', function($row)
            {
                $brg = $row->barang->name;
                return $brg;
            })
            ->addColumn('proyek', function($row)
            {
                $prj = $row->project ? $row->project->name_project : "-" ;
                return $prj;
            })
            ->rawColumns(['date','barang', 'proyek'])
            ->make(true);
        }
        
    }

    public function setDataByType($tp, $start, $end)
    {   
        // $end = Carbon::createFromFormat('YYYY-MM-DD', $end)->format('YYYY-MM-DD');
        // $start = Carbon::createFromFormat('YYYY-MM-DD', $start);
        // return $end;
            $data = BarangInOut::with('barang', 'project')
            ->whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end);
            if ($tp != 'All') {
                $data = $data->where('type', $tp);
            }
            $data->orderBy('created_at', 'DESC')->get();

            return $data;
    }
}
