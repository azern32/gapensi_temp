<?php ?>
<div class="container">
    <div class="m-3">

        <form class="" id="input-log">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="tanggal_kejadian">Tanggal Kejadian</label>
                        <input class="form-control" type="date" name="tanggal_kejadian" id="tanggal_kejadian" required>
                    </div>
                    
                    <div class="form-group ">
                        <label for="nominal">Nominal</label>
                        <input class="form-control" type="number" name="nominal" id="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                    </div>
                </div>
        
                
                <div class="col-md-6">
        
                    <div class="form-group">
                        <label for="akun_sumber">Akun Sumber</label>
                        <select class="form-control" name="akun_sumber" id="akun_sumber" required>
                            <option value="-">Pilih Akun ------------------</option>                            
                            <?php foreach ($rekening as $key => $value) {?>
                                <option value="<?php echo $value['kode_akun']?>"><?php echo $value['kode_akun']." - ".$value['nama_akun']?></option>
                            <?php }?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="akun_tujuan">Akun Tujuan</label>
                        <select class="form-control" name="akun_tujuan" id="akun_tujuan" required>
                            <option value="-">Pilih Akun ------------------</option>
                            <?php foreach ($rekening as $key => $value) {?>
                                <option value="<?php echo $value['kode_akun']?>"><?php echo $value['kode_akun']." - ".$value['nama_akun']?></option>
                            <?php }?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="akun_hutang">Akun Hutang <small class="text-muted text-red">optional</small></label>
                        <select class="form-control" name="akun_hutang" id="akun_hutang">
                            <option value="-">Pilih Akun ------------------</option>
                            <?php foreach ($hutang as $key => $value) {?>
                                <option value="<?php echo $value['kode_akun']?>"><?php echo $value['kode_akun']." - ".$value['nama_akun']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-secondary mx-2">Reset</button>
                <button type="button" onclick="submitLog()" class="btn btn-success">Simpan</button>
            </div>

        </form>

        <hr> <!-- ----------------------------------------------------------- -->

        <table id="tabel-log">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Tanggal Kejadian</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Akun Sumber</th>
                    <th>Akun Tujuan</th>
                    <th>Akun Hutang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $key => $value) {?>
                    <tr>
                        <td><?php echo $value->timestamp?></td>
                        <td><?php echo $value->tanggal_kejadian?></td>
                        <td><?php echo $value->keterangan?></td>
                        <td><?php echo $value->nominal?></td>
                        <td><?php echo $value->akun_sumber?></td>
                        <td><?php echo $value->akun_tujuan?></td>
                        <td><?php echo $value->akun_hutang?></td>
                        <td class="d-flex">
                            <button class="btn btn-sm btn-outline-info m-2"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger m-2"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>

    </div>
</div>

<?php 
    foreach ($dependencies as $key => $value) {
        echo "<!--". $key ."-->"."\n"."    <script src='".$value."'></script>";
    }
?>

<script>
    $(document).ready( function () {
        $('#tabel-log').DataTable({
            responsive: true,
            autoWidth: true,
            // order : [[0, 'dsc']]
        });
    });
</script>

<script>
    async function submitLog() {
        let d = new Date();
        let form = new FormData();
        form.append('timestamp', d.getTime());
        form.append('tanggal_kejadian', $('#tanggal_kejadian').val());
        form.append('nominal', $('#nominal').val());
        form.append('keterangan', $('#keterangan').val());

        form.append('akun_sumber', $('#akun_sumber').val());
        form.append('akun_tujuan', $('#akun_tujuan').val());
        form.append('akun_hutang', $('#akun_hutang').val());

        await fetch('<?= base_url().'/logs/catat';?>', {
            method:'post',
            body: form,
        }).then(res => {
            return res.json();
        }).then(x => {
            console.log(x.body.timestamp)
            newIn(x.body.timestamp);
        })
        .catch(err => {
            console.log(err);
        })
    }

    async function newIn(timestamp) {        
        await fetch(`<?= base_url().'/logs/listlates/';?>${timestamp}`)
        .then(res =>{
            return res.json();
        })
        .then((data) => {
            console.log(data);
            $('#tabel-log').DataTable().row
            .add([
                [data.timestamp],
                [data.tanggal_kejadian],
                [data.keterangan],
                [data.nominal],
                [data.akun_sumber],
                [data.akun_tujuan],
                [data.akun_hutang],
                [],]
            ).draw().node();
        });
    }
</script>