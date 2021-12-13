@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Data Keluar/Masuk Barang
                    <div class="page-title-subheading">Tables are the backbone of almost all web applications.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <!-- <button type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Example Tooltip">
                    <i class="fa fa-star"></i>
                </button> -->
                <div class="d-inline-block">
                    <button class="btn-shadow btn btn-info" id="btn-tambah-barang" data-toggle="modal" data-target="#tambahBarangModal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-square fa-w-20"></i>
                        </span>
                        Tambah Barang Masuk
                    </button>
                </div>
            </div>    
        </div>
    </div>            
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-6 card">
                <div class="card-body"><h5 class="card-title">Tabel Data Barang</h5>
                    <table class="mb-0 table table-striped datatable" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Tertuju</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
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