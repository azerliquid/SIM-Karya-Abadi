@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-6">
            <div class="page-title-heading">
                <div>
                    <h2>{{ $project->name_project}}</h2>
                    <div class="page-title-subheading">Ketua Lapangan : <b>{{ $project->headProject->name}}</b>
                    <p>Alamat : {{ $project->location}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-4">
                            <div class="widget-heading">Dana dibelanjakan</div>
                            <div class="widget-subheading" ></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success" id="sumPemakaian"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-7">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-actions">
                        <div class="main-card card">
                            <div class="no-gutters row">
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-success"></div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Stok Tersedia</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-warning"></div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Masuk</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-danger"></div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Keluar</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>             -->
    </div>
    <div class="row justify-content-right">
        <div class="col-md-7" >
        <label  for="exampleText" class="">Custom Tanggal :</label>
            <div class="row">
                <div class="col-md-8" >
                    <div class="position-relative form-group" id="request-stock_in">
                        <input class="form-control" type="text" name="daterangeBarangInOut" value="" />
                    </div>
                </div>
                <div class="col-md-4">
                    <button  class="btn-shadow btn btn-info" onclick="generateDatatables()" id="btnGenerateData">
                        <span class="btn-icon-wrapper opacity-7">
                            <i class="fa fa-search fa-w-20"></i>
                        </span>
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-2 card">
                <div class="card-body">
                <h5 class="card-title">Riwayat Data Masuk Barang Material</h5>
                    <table  class="mb-0 table table-striped" style="width: 100%;" id="tableDetail">
                        <thead>
                            <tr>
                                <td style="float: left">No</td>
                                <td>Tanggal</td>
                                <td>Nama Barang</td>
                                <td>Qty</td>
                                <td>Harga <small>(@)</small></td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="main-card mb-2 card">
                <div class="card-body">
                <h5 class="card-title">Data Penggunaan Barang Material</h5>
                    <table  class="mb-0 table table-striped" style="width: 100%;" id="tableSumBarang">
                        <thead>
                            <tr>
                                <td >No</td>
                                <td>Nama Barang</td>
                                <td>Qty</td>
                                <td>Dana Pembelanjaan</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
  @include('admin.hr.proyek.modal_detail')
@endsection