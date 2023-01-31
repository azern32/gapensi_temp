<div class="d-flex justify-content-between my-3">
    <h5 class="mr-auto">LAPORAN LABA RUGI</h5>
    
    
    <button class="mx-2 btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
        <i class="fas fa-download"></i>
        Download
    </button>
</div>


<div class="table-responsive" style="position: relative;">
    <div id="penutup" style="position: absolute; z-index:200; "></div>
    <table class="text-center table table-sm table-hover table-bordered" id="tabel-labarugi-<?= $document_uuid?>">
        <thead>
            <tr class="table-primary">
                <th rowspan=2>
                    Account
                </th>
                <?php 
                    setlocale(LC_ALL,"ID");
                    for ($i=1; $i < 13; $i++) { 
                        $dateObj   = DateTime::createFromFormat('!m', $i);
                        $monthName = $dateObj->format('F');
                        echo '<th>'.$monthName.'</th>';
                    }
                ?>
                <th>
                    Years To Date <?=date("Y")?>
                </th>
            </tr>
            <tr class="table-primary">
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th>Rp. </th>';
                    }
                ?>
            </tr>
        </thead>

        <tbody>
            <tr class="table-secondary">
                <th>Revenue</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>
            <tr>
                <td>Service Revenue</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>Product Revenue</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>Revenue Return & Discount</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
        </tbody>

        <thead>
            <tr>
                <th>Total Revenue</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th>0</th>';
                    }
                ?>
            </tr>
        </thead>

        <tbody>
            <tr class="table-secondary">
                <th>Operating Expenses</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>
            <tr>
                <td>Salary</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>Honorerium & Insentif</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>Stationary</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>Allowance</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>Income Tax Art. 21</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>0</td>';
                    }
                ?>
            </tr>
            <tr>
                <td>...</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>...</td>';
                    }
                ?>
            </tr>
        </tbody>

        <thead>
            <tr>
                <th>Total Operating Expenses</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th>0</th>';
                    }
                ?>
            </tr>
        </thead>

        <tbody>
            <tr>
            <td>...</td>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<td>...</td>';
                    }
                ?>
            </tr>
        </tbody>


    </table>

</div>

<script >
    let datalabarugi, akun, bs;
    fetch('<?= base_url('neraca/labarugi')?>')
    .then(res=>{
        return res.json()
    }).then(res=>{
        datalabarugi = res.data
        akun = res.akun
        pl = res.pl

        // Enable lagi ketika datamu sudah benar
        // buatIsian()

        return
    })



    function gantinama(uuid) {
       
        for (let i = 0; i < akun.length; i++) {
            if (akun[i].uuid == uuid) {
                return akun[i].nama_akun;
            }            
        }

        for (let i = 0; i < pl.length; i++) {
            if (pl[i].uuid == uuid) {
                return pl[i].nama_pl;
            }
        }
    }

</script>

<script>
    function makeRowAkun(uuid, tipe) {
        let name = gantinama(uuid);
        let debit_kredit = datalabarugi[tipe][uuid]

        let isi = ''
        let totaldebet=0, totalkredit=0

        for (let i = 0; i < debit_kredit.length; i++) {
            isi += `<td>${Number(debit_kredit[i].debet) - Number(debit_kredit[i].kredit)}</td>`
            totaldebet += Number(debit_kredit[i].debet)
            totalkredit += Number(debit_kredit[i].kredit)
        }

        $('#tabel-labarugi-<?= $document_uuid?> tbody')
        .append( `<tr id="${uuid}" class="text-center"><td>${name}</td>
        ${isi}
        <td>${totaldebet - totalkredit}</td>
        </tr>`);

        updatetinggi();
        return
    }

    function makeRowTipe(uuid) {
        let name = gantinama(uuid);

        return $('#tabel-labarugi-<?= $document_uuid?> tbody').append( `<tr id="${uuid}"><th>${name}</th>
        <th colspan=13></th>
        </tr>`);
    }

    function buatIsian() {
        for (let key in datalabarugi) {
            makeRowTipe(key)

            for (let uuid in datalabarugi[key]) {
                makeRowAkun(uuid, key)
            }
        }
    }

</script>

<script>
    let boxwidth
    let boxheight
    function updatetinggi() {
        // buat object transparant di depan table
        boxwidth = $('[class=table-responsive]')[0].offsetWidth
        boxheight = $('[class=table-responsive]')[0].offsetHeight
    
        $('#penutup').css('width', boxwidth)
        $('#penutup').css('height', boxheight)
        $('#penutup').css('background-color', 'rgb(0 0 0 / 1%)')
    }
</script>