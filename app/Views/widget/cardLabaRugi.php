<div class="d-flex justify-content-between my-3">
    <h5 class="mr-auto">LAPORAN LABA RUGI</h5>
    
    
    <button class="mx-2 btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
        <i class="fas fa-download"></i>
        Download
    </button>
</div>


<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered" id="tabel-labarugi-<?= $document_uuid?>">
        <thead>
            <tr class="table-primary">
                <th rowspan=2>
                    Account
                </th>
                <?php 
                    setlocale(LC_ALL,"ID");
                    for ($i=1; $i < 13; $i++) { 
                        echo '<th>'.strftime('%B', mktime(0, 0, 0, $i)).'</th>';
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

        </tbody>
    </table>

</div>

<script >
    // let dataLabaRugi = fetch('<?= base_url('neraca/labarugi')?>')
    //     .then(res=>{
    //         return res.json()
    //     })

    let datalabarugi, akun, tipe;
    fetch('<?= base_url('neraca/labarugi')?>')
    .then(res=>{
        return res.json()
    }).then(res=>{
        datalabarugi = res.data
        akun = res.akun
        tipe = res.tipe

        buatIsian()

        return
    })



    function gantinama(uuid) {
       
        for (let i = 0; i < akun.length; i++) {
            if (akun[i].uuid == uuid) {
                return akun[i].nama_akun;
            }            
        }

        for (let i = 0; i < tipe.length; i++) {
            if (tipe[i].uuid == uuid) {
                return tipe[i].nama_tipe;
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

        return $('#tabel-labarugi-<?= $document_uuid?> tbody')
        .append( `<tr id="${uuid}" class="text-center"><td>${name}</td>
        ${isi}
        <td>${totaldebet - totalkredit}</td>
        </tr>`);

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