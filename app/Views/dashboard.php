<div class="container">
    <div class="m-3">
        <h3>Dashboard</h3>
        <div class="row">

            <div class="card card-konas  m-3">
                <div class="card-header">
                    <h4>Laporan per akun</h4>
                </div>
    
                <div class="card-body">
                    <div class="p-3">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th >Kode Akun</th>
                                    <th >Nama Akun</th>
                                    <th >Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>111</td>
                                    <td>Kas Tunai</td>
                                    <td>Rp. ---</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-konas">Detail</a>
                    </div>
                </div>    
            </div>
    
            <div class="card card-konas m-3">
                <div class="card-header">
                    <h4> Laba rugi per bulan</h4>
                </div>
    
                <div class="card-body p-3">
                    <canvas id="perBulan"></canvas>

                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-konas">Detail</a>
                    </div>
                </div>
            </div>

            <div class="card card-konas  m-3">
                <div class="card-header">
                    <h4>Log terakhir</h4>
                </div>
    
                <div class="card-body">
                    <div class="p-3">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th >Timestamp</th>
                                    <th >Tanggal Kejadian</th>
                                    <th >Nominal</th>
                                    <th >Akun Sumber</th>
                                    <th >Akun Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Timestamp</td>
                                    <td>Suatu tanggal</td>
                                    <td>Rp. ---</td>
                                    <td>Kode Akun</td>
                                    <td>Kode Akun</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-konas">Catat Baru</a>
                    </div>
                </div>    
            </div>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

