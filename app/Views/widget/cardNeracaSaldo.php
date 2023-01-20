<div class="d-flex justify-content-between my-3">
    
    <!-- Check level pengguna -->
    <?php switch ($session['level']) {
    case 1:
        // Jika level pengguna pegawai, tampilkan sidebar_pegawai
        echo '<h5 class="mr-auto">LAPORAN KEUANGAN</h5>';
        break;
        
        case 2:
        echo '<h5 class="mr-auto">NERACA SALDO</h5>';
        // Jika level pengguna direktur, tampilkan sidebar_direktur
        break;

    default:
        // Untuk keperluan debugging 
        // Jika levelnya tidak ditemukan, otomatis jadi root
        echo '<h5 class="mr-auto">LAPORAN KEUANGAN atau NERACA SALDO</h5>';
        break;
    }?>


    <select class="mx-2" name="select_neraca" id="select_neraca">
        <option value="0">Tahun ini, hingga hari ini</option>
        <?php 
            setlocale(LC_ALL,"ID");
            for ($i=1; $i < 13; $i++) { ?>

            <option value="<?= $i;?>"><?= strftime('%B', mktime(0, 0, 0, $i));?></option>
        <?php }?>
    </select>
    <button class="mx-2 btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
        <i class="fas fa-download"></i>
        Download
    </button>
</div>

<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th>Description</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>        
        <tr>
            <th>Assets</th>
            <th></th>
            <th>Liabilities</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    </tbody>

    <thead>
        <tr>
            <th>Total Current Assets</th>
            <th></th>
            <th>Total Liabilities</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>


