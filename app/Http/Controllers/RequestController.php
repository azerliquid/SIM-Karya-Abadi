<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\RequestLogistic;
use App\Models\DetailLogistic;
use Response;
use Carbon\Carbon;
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

        // dd($type);
        // if ($request->ajax()) {

        //     $data = RequestLogistic::with('head_project','project')->where('status', 'Menunggu Konfirmasi')->get();

        //     return Response::json($data);
        // }

        return view('ketua_lapangan.historyrequest.index');
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
            $request_order->no_reference = '';
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

        return view('ketua_lapangan.request.index');
    }

    public function getListItem($id)
    {
        $data = DetailLogistic::with('barang')->where('id_logistic', $id)->get();
        return Response::json(['id' => $id,'data' => $data]);
    }

    public function showData($type)
    {
        if ($type == 'all') {
            $data = RequestLogistic::with('head_project','project')->get();

            return $data;
        }
        if ($type == 'waiting') {
            $data = RequestLogistic::with('head_project','project')->where('status', 'Menunggu Konfirmasi')->get();

            return $data;
        }
        if ($type == 'procces') {
            $data = RequestLogistic::with('head_project','project')->where('status', 'Diproses')->get();

            return $data;
        }
        if ($type == 'done') {
            $data = RequestLogistic::with('head_project','project')->where('status', 'Selesai')->get();

            return $data;
        }
        // return Response::json($type);
    }
}
