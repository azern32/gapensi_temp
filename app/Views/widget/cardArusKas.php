<table id="tabel_arus_kas" class="table table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Akun Debet</th>
            <th>Akun Kredit</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php //foreach ($list as $key => $value) {?>
            <tr>
                <td class="text-center">tanggal</td>
                <td class="text-center">ket</td>
                <td class="text-center">debet</td>
                <td class="text-center">kredit</td>
                <td class="text-center">jumlah</td>
                <td class="d-flex justify-content-center">
                    <button class="btn btn-sm btn-outline-info m-2"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-outline-danger m-2"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php //}?>
    </tbody>
</table>

