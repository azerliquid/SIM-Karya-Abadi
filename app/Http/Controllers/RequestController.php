<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\RequestLogistic;
use App\Models\DetailLogistic;
use Response;
use Carbon\Carbon;
use DB;
// use Auth;
use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Response::json(Auth::user()->id);
        if (Auth::user()->role == 'mandor') {
            return view('ketua_lapangan.historyrequest.index');
        }
        if (Auth::user()->role == 'logistic') {
            return view('logistik.listrequest.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::where('deleted', 0)->get();
        // $proyek = Project::select( 'id', 'name_project')->where('status', 'Aktif')->where('deleted', 0)->get();
        return Response::json($barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $now = Carbon::now();
        if ($request->ajax()) {
            $request_order = new RequestLogistic;
            $request_order->no_reference = $request->data['noref'];
            $request_order->date_procurement = $now;
            $request_order->id_project = 24;
            $request_order->id_head_project = Auth::user()->id;
            $request_order->status = "Menunggu Konfirmasi";
            $request_order->description = $request->data['keterangan'];

            $request_order->save();

            $id_req = $request_order->id;
            $item = $request->data['listItem'];

            for ($i=0; $i < count($item); $i++) { 
                $listitem = new DetailLogistic;
                $listitem->id_logistic = $id_req;
                $listitem->type = $request->data['type'];
                $listitem->id_barang = $item[$i]['id_barang'];
                $listitem->qty = $item[$i]['qty'];
                $listitem->status = "Menunggu Konfirmasi";

                $listitem->save();

            }
            return Response::json(['sukses' => 'data berhasil masuk']);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showForm()
    {
        // return Response::json(Auth::user());
        $today = Carbon::today()->toDateString();
        // $last_id = RequestLogistic::latest()->first()->id;
        $last_id = RequestLogistic::whereDate('created_at', $today)->where('id_head_project', Auth::user()->id)->get();
        $total = count($last_id);
        // return Response::json($total);
        $id = $total == 0 ? 1 : $total + 1 ;
        $noref = Carbon::now()->format('ymd') . Auth::user()->id. $id;
        // $no_ref = ; 


        return view('ketua_lapangan.request.index', ['no_ref'=>$noref]);
    }

    public function getListItem($id)
    {
        // return Response::json('oke'+$id);
        if (Auth::user()->role == 'mandor') {
            $data = DetailLogistic::with('barang')->where('id_logistic', $id)->get();
            return Response::json(['id' => $id,'data' => $data]);
        }
        if (Auth::user()->role == 'logistic') {
            // return Response::json('nyampe sini');
            $data = DetailLogistic::with('barang')->where('id_logistic', $id)->get();
            return Response::json(['id' => $id,'data' => $data]);
        }
    }

    public function showData($type)
    {
        if ($type == 'all') {
            // $total = DB::table('request_logistic')
            // ->select('status', DB::raw('count(*) as total'))
            // ->groupBy('status')
            // ->get();
            $data = RequestLogistic::with('head_project','project');
            if (Auth::user()->role == 'mandor') {
                $data = $data->where('id_head_project', Auth::user()->id);
            }
            $data = $data->orderBy('created_at', 'DESC')
            ->orderBy('created_at', 'DESC')->get();

            return Response::json($data);
        }
        if ($type == 'waiting') {
            $data = RequestLogistic::with('head_project','project');
            if (Auth::user()->role == 'mandor') {
                $data = $data->where('id_head_project', Auth::user()->id);
            }
            $data = $data->where('status', 'Menunggu Konfirmasi')->orderBy('created_at', 'DESC')->get();

            return $data;
        }
        if ($type == 'procces') {
            $data = RequestLogistic::with('head_project','project');
            if (Auth::user()->role == 'mandor') {
                $data = $data->where('id_head_project', Auth::user()->id);
            }
            $data = $data->where('status', 'Diproses')->orderBy('created_at', 'DESC')->get();

            return $data;
        }
        if ($type == 'done') {
            $data = RequestLogistic::with('head_project','project');
            if (Auth::user()->role == 'mandor') {
                $data = $data->where('id_head_project', Auth::user()->id);
            }
            $data = $data->where('status', 'Selesai')->orderBy('created_at', 'DESC')->get();

            return $data;
        }
        // return Response::json($type);
    }

    public function saverequest(Request $request)
    {
        $request_order = RequestLogistic::find($request->idRequest);

        $request_order->status = "Diproses";
        $request_order->save();

        $id_request = $request_order->id;
        $listitem = $request->item;
        // return Response::json($request->qty_alocated);


        for ($i=0; $i < $request->totalItem ; $i++) { 
            $detailRequest = DetailLogistic::find($listitem[$i]['idBarang']);

            $detailRequest->qty_alocated = $listitem[$i]['qtyAlocated'];
            $detailRequest->status = 'Diproses';
            $detailRequest->save();

            $updateStock = Barang::find($detailRequest->id_barang);
            // return Response::json($updateStock);
            $updateStock->stock_now = $updateStock->stock_now - $listitem[$i]['qtyAlocated'];
            $updateStock->save();
        }

        return Response::json(['sukses' => 'Data berhasil diinput']);
    }

    public function setselesai($id)
    {
        $request_logistic = RequestLogistic::find($id);
        $request_logistic->status = 'Selesai';
        $request_logistic->save();

        $detail_request = DetailLogistic::where('id_logistic', $id)->update(['status' => 'Selesai']);
        return Response::json('sukses');

    }
}
