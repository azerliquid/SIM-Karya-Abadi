<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\RequestOrder;
use App\Models\ListItem;
use Response;
use Carbon\Carbon;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('ketua_lapangan.request.index');
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
        // return Response::json($request->data['keterangan']);
        $now = Carbon::now();
        if ($request->ajax()) {
            $request_order = new RequestOrder;
            $request_order->no_reference = '';
            $request_order->date_procurement = $now;
            $request_order->id_project = 29;
            $request_order->id_head_project = 13;
            $request_order->status = "Menunggu Konfirmasi";
            $request_order->description = $request->data['keterangan'];

            $request_order->save();

            $item = $request->data['listItem'];
            $id_req = $request_order->id;

            for ($i=0; $i < count($item) ; $i++) { 
                $listitem = new ListItem;
                $listitem->id_logistic = $id_req;
                $listitem->type = $request->data['type'];
                $listitem->id_barang = $item[$i]['id_barang'];
                $listitem->qty = $item[$i]['qty'];
                $listitem->status = "Menunggu Konfirmasi";

                $listitem->save();

                return Response::json(['sukses' => 'data berhasil masuk']);
            }


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
}
