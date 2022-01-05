@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-refresh-2 icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Keluar/Masuk Barang
                    <div class="page-title-subheading">Riwayat Data Laporan Keluar/Masuk Barang
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <!-- <button type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Example Tooltip">
                    <i class="fa fa-star"></i>
                </button> -->
                <div class="d-inline-block">
                    <button class="btn-shadow btn btn-primary" id="btn-tambah-barang" data-toggle="modal" data-target="#tambahBarangModal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-square fa-w-20"></i>
                        </span>
                        Tambah Barang Masuk
                    </button>
                </div>
                <div class="d-inline-block">
                    <button class="btn-shadow btn btn-warning" id="btn-keluar-barang" data-toggle="modal" data-target="#keluarBarangModal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-square fa-w-20"></i>
                        </span>
                        Tambah Barang Keluar
                    </button>
                </div>
            </div>    
        </div>
    </div>            
    <!-- <div class="main-card mb-2 card">
        <div class="card-body"> -->
            <!-- <div class="row">
                <div class="col-md-12">
                    <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                        <li class="nav-item">
                            <a onclick="generateDatatable('All')" role="tab" style="font-size:14; font-weight:bold;" class="nav-link active show" id="tabs-all" data-toggle="tab" href="" aria-selected="true">
                                <span class="nav-text">Semua <label style="font-weight:bold;" id="badge-semua"></label></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a onclick="generateDatatable('Masuk')" role="tab" style="font-size:14; font-weight:bold;" class="nav-link show" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1" aria-selected="false">
                                <span class="nav-text">Masuk<label style="font-weight:bold;" id="badge-menunggu"></label></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a onclick="generateDatatable('Keluar')" role="tab" style="font-size:14; font-weight:bold;" class="nav-link show" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1" aria-selected="false">
                                <span class="nav-text">Keluar<label style="font-weight:bold;" id="badge-diproses"></label></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->  
            <div class="row">
                <div class="col-md-5">
                    <div class="position-relative form-group" id="request-stock_in">
                        <label for="exampleText" class="">Custom Tanggal :</label>
                        <input class="form-control" type="text" name="daterangeBarangInOut" value="" />
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
        <!-- </div>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-2 card">
                <div class="card-body">
                <!-- <h5 class="card-title">Tabel Data Barang</h5> -->
                    <table class="mb-0 table table-striped datatable" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jenis</th>
                            <th>Stok Awal</th>
                            <th>Qty</th>
                            <th>Stok Akhir</th>
                            <th>Tujuan</th>
                            <th>Lokasi</th>
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
  @include('logistik.baranginout.modals')
@endsection