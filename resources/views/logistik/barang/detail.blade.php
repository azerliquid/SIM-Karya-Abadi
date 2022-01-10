@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-5">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-plane icon-gradient bg-tempting-azure">
                    </i>
                </div>
                <div>
                    <h2>{{ $barang->name . " (" .$barang->unit. ")" }}</h2>
                    <div class="page-title-subheading"> Data Keluar Masuk Barang
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-actions">
                        <div class="main-card card">
                            <div class="no-gutters row">
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-primary">{{ $barang->stock_now}}</div>
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
                                                <div class="widget-numbers text-success">{{ $masukTotal[0]->masuk}}</div>
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
                                                <div class="widget-numbers text-warning">{{ $keluarTotal[0]->keluar}}</div>
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
        </div>            
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="position-relative form-group" id="request-stock_in">
                <label for="exampleText" class="">Custom Tanggal :</label>
                <input class="form-control" type="text" name="daterangeBarang" value="" />
            </div>
        </div>
        <div class="col-md-7" >
            <label>Tipe (Semua/Masuk/Keluar) : </label>
            <div class="row">
                <div class="col-md-8">
                    <select type="select" id="selectTipe" name="selectTipe" class="custom-select selectTipe">
                        <option value="All" style="">Semua</option>
                        <option value="Masuk" style="">Masuk</option>
                        <option value="Keluar" style="">Keluar</option>
                    </select>
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
            <div class="main-card mb-6 card">
                <div class="card-body">
                <h5 class="card-title">Detail Data Barang</h5>
                    <table  class="mb-0 table table-striped" style="width: 100%;" id="tableDetail">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal</td>
                                <td>Jenis</td>
                                <td>Qty</td>
                                <td>Tujuan</td>
                                <td>Lokasi</td>
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
  @include('logistik.barang.modals_detail')
@endsection