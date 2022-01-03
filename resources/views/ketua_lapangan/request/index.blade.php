@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-upload text-success">
                    </i>
                </div>
                <div>Form Permintaan Bahan Bangunan
                    <!-- <div class="page-title-subheading">Build whatever layout you need with our Architect framework.
                    </div> -->
                </div>
            </div>
            <div class="page-title-actions">
            </div>    
        </div>
    </div>
    <div class="tab-content">
        <div class="main-card mb-2 p-3 card">
            <div class="card-body">
                <h2 class="card-title mb-3" style="font-size:1.4em; text-align:center;">Masukan Data Permintaan Barang</h2>
                <form action="" id="tambahForm">
                    <div class="inputItem">
                        <div class="form-row mb-2">
                            <div class="col-md-12">
                                <h5>No Referensi : <b>{{$no_ref}}</b></h5>
                                <input type="hidden" name="noref" id="noref" value="{{$no_ref}}">
                            </div>
                        </div>
                        <div class="form-row mb-2" >
                            <div class="col-md-6">
                                <label>Tujuan Proyek : </label>
                                <select type="select" id="selectProyek" name="proyek" class="custom-select selectProyek">
                                    <option style='font-weight: bolder;' value=''>-- Pilih Tujuan Proyek --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <!-- <label>Tanggal Permintaan : </label> -->
                                <label for="exampleText" class="">Custom Tanggal :</label>
                                <div>
                                    <!-- <input type="datetime-local" name="date_masuk" id="date_masuk"> -->
                                    
                                    <input class="form-control" type="text" name="daterangeBarangInOut" value="" />
                                    <!-- <input class="form-control" type="text" name="daterangeBarangInOut" value="" /> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-md-7">
                                <div class="position-relative form-group" id="request-barang">
                                    <label for="name-barang" class="">Nama Barang</label>
                                    <select type="select" id="selectBarang-1" name="barang-1" onchange="getStock(1)" class="custom-select selectBarang">
                                        <option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group" id="request-stock-available">
                                    <label for="exampleText" class="">Stok Tersedia</label>
                                    <input name="stock-1" id="exampleText" class="form-control" type="number" disabled></input>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group" id="request-stock_in">
                                    <label for="exampleText" class="">Permintaan</label>
                                    <input name="qty-1" id="exampleText" class="form-control" type="number"></input>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group" id="request-stock_in">
                                    <label for="exampleText" class="">Satuan</label>
                                    <br>
                                    <label id="satuan-1" class="" style="font-weight: bold"></label>
                                </div>
                            </div>    
                        </div>
                    </div>
                </form>
                <div class="form-row">
                    <div class="mx-auto">
                        <input type="text" name="total_item" id="totalItem" value="1" style="display:none;">
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-primary" onclick="addItem()">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-square fa-w-20"></i>
                            </span>
                            Tambah Item
                        </button>
                    </div>
                </div>
                
                <div class="position-relative form-group" id="tambah-address">
                    <label for="exampleText" class="">Keterangan <small>(Opsional)</small></label>
                    <textarea name="keterangan" rows="3" name="description" id="exampleText" class="form-control" placeholder="Masukan Keterangan"></textarea>
                </div>
                <div class="form-row justify-content-center">
                    <input type="reset" class="btn mr-2 btn-secondary">
                    <button type="button" class="btn btn-primary" id="btnTambah">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
  @include('ketua_lapangan.request.modals')
@endsection