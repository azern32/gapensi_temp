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
            for ($i=1; $i < 13; $i++) { 
                $dateObj   = DateTime::createFromFormat('!m', $i);
                $monthName = $dateObj->format('F');
            ?>

            <option value="<?= $i;?>"><?= $monthName?></option>
        <?php }?>
    </select>
    <button class="mx-2 btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
        <i class="fas fa-download"></i>
        Download
    </button>
</div>

<div class="table-responsive">
    <div id="penutup" style="position: absolute; z-index:200; "></div>
    <table class="table table-hover table-sm table-bordered tocover">
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
            <tr class="table-primary">
                <th>Current Assets</th>
                <th></th>
                <th>Passiva</th>
                <th></th>
            </tr>
            <tr>
                <td>Petty Cash</td>
                <td>0</td>
                <td>Trade Payables</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Cash on Hand</td>
                <td>0</td>
                <td>Non-Trade Payables</td>
                <td>0</td>
            </tr>
            <tr>
                <td>RCC</td>
                <td>0</td>
                <td>Bank Loan</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Cash In Bank - IDR</td>
                <td>0</td>
                <td>Other Payables</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Cash In Bank - USD</td>
                <td>0</td>
                <td>Tax Payables</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Trade Receivable</td>
                <td>0</td>
                <td>Accrued Expenses</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Non-Trade Receivable</td>
                <td>0</td>
                <td></td>
                <td></td>            
            </tr>
            <tr> 
                <td>Employee Receivable</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Other Receivable</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Cash Advance</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Supplies</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Prepaid Exp</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Prepaid Tax</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    
        <thead>
            <tr>
                <th>Total Current Assets</th>
                <th class="table-info">0</th>
                <th>Total Liabilities</th>
                <th class="table-info">0</th>
            </tr>
        </thead>
    
        <tbody>
            <tr class="table-primary">
                <th >Fixed Assets</th>
                <th></th>
                <th>Long-Term Liabilities</th>
                <th></th>
            </tr>

            <tr>
                <td>Building & Land</td>
                <td>0</td>
                <td>Equity</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Equipment</td>
                <td>0</td>
                <td>Equities</td>
                <td>0</td>
            </tr>
            <tr>
                <td>Vehicles</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Furnitures & Fixtures</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>


            <tr >
                <th class="table-primary">Accumulated Depreciation</th>
                <th></th>
                <th class="table-primary">Balance of Profit (Loss)</th>
                <th></th>
            </tr>

            <tr>
                <td>Accumulated Depreciation - Building & Land</td>
                <td>0</td>
                <td>Retained Earning</td>
                <td>0</td>
            </tr>
            
            <tr>
                <td>Accumulated Depreciation - Equipment</td>
                <td>0</td>
                <td>Net Profit (Loss)</td>
                <td>0</td>
            </tr>
            
            <tr>
                <td>Accumulated Depreciation - Vehicles</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Accumulated Depreciation - Furnitures & Fixtures</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>


        </tbody>

        <thead>
            <tr>
                <th>Total Fixed Assets</th>
                <th class="table-info">0</th>
                <th>Total Balance of Profit (Loss)</th>
                <th class="table-info">0</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Other Assets</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Deposits</td>
                <td>0</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>

        <tfoot>
            <tr class="table-success">
                <th>Total Assets</th>
                <th>0</th>
                <th>Total Passiva</th>
                <th>0</th>
            </tr>
        </tfoot>
    </table>
</div>




<script>
        // buat object transparant di depan table
    let boxwidth = $('.tocover')[0].offsetWidth
    let boxheight = $('.tocover')[0].offsetHeight

    $('#penutup').css('width', boxwidth)
    $('#penutup').css('height', boxheight)
    $('#penutup').css('background-color', 'rgb(0 0 0 / 1%)')
</script>