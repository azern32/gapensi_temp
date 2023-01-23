<div class="d-flex justify-content-between my-3">
    <h5 class="mr-auto">LAPORAN LABA RUGI</h5>
    
    
    <button class="mx-2 btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
        <i class="fas fa-download"></i>
        Download
    </button>
</div>


<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
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