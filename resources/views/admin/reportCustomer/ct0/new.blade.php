@extends('layouts.admin')

@section('content')
<style>
  .table, .tr, .th, .td {
    border: 3px solid black;
  }
  .card-table {
    margin-top: 2%;
  }
  .card-filter {
    margin-top: 1.5%;
    margin-left: 1%;
  }
  .col-card {
    margin-left:2%;
  }
  .card {
    display: flex;
  }
  .th4 {
    background-color: #6b1e40;
  }
</style>

<h5>KPI New CT0</h5>
<br>
<div class="row">
  <div class="col" style="width:45%;">
    <div class="card border-primary">
        <form class="row card-filter" action="" method="">
          <div class="col">
              <div class="form-group">
                  <select class="form-control select2" name="kategori" id="kategori">
                      <option value="SEMUA">Semua Kategori Pelanggan</option>
                      <option value="">Kategori 1</option>
                      <option value="">Kategori 2</option>
                  </select>
              </div>
          </div>
          <div class="col">
              <div class="form-group">
                  <select class="form-control select2" name="hvc" id="hvc">
                      <option value="">HVC</option>
                      <option value="">Non HVC</option>
                  </select>
              </div>
          </div>
          <div class="col">
              <div class="form-group col col-md" style="margin-top:5px;">
                  <button type="submit" class="btn btn-primary">Filter P2</button>
              </div>
          </div>
        </form>
    </div>
  </div>
  <div class="col col-card">
    <div class="card border-warning">
        <form class="row card-filter" action="" method="">
          <div class="col">
              <div class="form-group">
                  <select class="form-control select2" name="periode" id="periode">
                      <option value="SEMUA">Semua Periode</option>
                      <option value="">Periode 1</option>
                      <option value="">Periode 2</option>
                  </select>
              </div>
          </div>
          <div class="col">
              <div class="form-group">
                  <select class="form-control select2" name="plg" id="plg">
                      <option value="">Plg C3MR</option>
                      <option value="">Plg Pra NPC</option>
                  </select>
              </div>
          </div>
          <div class="col">
              <div class="form-group col col-md" style="margin-top:5px;">
                  <button type="submit" class="btn btn-warning">Filter P3</button>
              </div>
          </div>
        </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="card card-table">
    <div class="table-responsive">
      <table class="table datatable">
      <thead class="thead align-baseline text-center">
        <tr class="tr">
          <th class="th bg-danger text-white" rowspan="2"> <b class="text-white">Witel</b> </th>
          <th class="th bg-success" colspan="4"><b class="text-white">P1 - Infra</b></th>
          <th class="th bg-primary" colspan="5"><b class="text-white">P2 - Customer Care</b></th>
          <th class="th bg-warning" colspan="4"><b class="text-white">P3 - CM Pelanggan</b></th>
          <th class="th th4" colspan="3"><b class="text-white">P4 - Payroll</b></th>
        </tr>
        <tr class="tr">
          <!-- p1 infra -->
            <th class="th bg-success"><b class="text-white">Unspek</b></th>
            <th class="th bg-success"><b class="text-white">Q Jaringan</b></th>
            <th class="th bg-success"><b class="text-white">Modem Offline</b></th>
            <th class="th bg-success"><b class="text-white">QC2 Not Valid</b></th>
          <!-- p2 cc -->
            <th class="th bg-primary"><b class="text-white">Tiket CC</b></th>
            <th class="th bg-primary"><b class="text-white">Detractor CTL</b></th>
            <th class="th bg-primary"><b class="text-white">Over Quota</b></th>
            <th class="th bg-primary"><b class="text-white">Over Device</b></th>
            <th class="th bg-primary"><b class="text-white">No Usage</b></th>
            <!-- p3 cm -->
            <th class="th bg-warning"><b class="text-white">Channel PSB 1</b></th>
            <th class="th bg-warning"><b class="text-white">Channel PSB 2</b></th>
            <th class="th bg-warning"><b class="text-white">Channel PSB 3</b></th>
            <th class="th bg-warning"><b class="text-white">Channel PSB 4</b></th>
            <!-- p4 payroll -->
            <th class="th th4"><b class="text-white">Caring OK</b></th>
            <th class="th th4"><b class="text-white">Caring NOK</b></th>
            <th class="th th4"><b class="text-white">Sisa Caring</b></th>
        </tr>
      </thead>
      <tbody>
        <tr class="tr" colspan="17">
          <td class="td">BALIKPAPAN</td>
          <td class="td"><a class="nav-link" href="#" target="_blank" rel="noopener noreferrer">ddkflf</a></td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">jfkdk</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
        </tr>
        <tr class="tr" colspan="17">
          <td class="td">SAMARINDA</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">jfkdk</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
        </tr>
        <tr class="tr" colspan="17">
          <td class="td">KALTARA</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">jfkdk</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
        </tr>
        <tr class="tr" colspan="17">
          <td class="td">KALTENG</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">jfkdk</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
        </tr>
        <tr class="tr" colspan="17">
          <td class="td">KALSEL</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">jfkdk</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
        </tr>
        <tr class="tr" colspan="17">
          <td class="td">KALBAR</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">jfkdk</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
          <td class="td">xxxd</td>
          <td class="td">ddkflf</td>
          <td class="td">dlflf</td>
          <td class="td">ddddf</td>
        </tr>
        <tr class="tr" colspan="17">
          <td class="td bg-danger">TREG VI</td>
          <td class="td bg-success">ddkflf</td>
          <td class="td bg-success">dlflf</td>
          <td class="td bg-success">ddddf</td>
          <td class="td bg-success">xxxd</td>
          <td class="td bg-primary">jfkdk</td>
          <td class="td bg-primary">ddkflf</td>
          <td class="td bg-primary">dlflf</td>
          <td class="td bg-primary">ddddf</td>
          <td class="td bg-primary">xxxd</td>
          <td class="td bg-warning">ddkflf</td>
          <td class="td bg-warning">dlflf</td>
          <td class="td bg-warning">ddddf</td>
          <td class="td bg-warning">xxxd</td>
          <td class="td th4">ddkflf</td>
          <td class="td th4">dlflf</td>
          <td class="td th4">ddddf</td>
        </tr>
      </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
