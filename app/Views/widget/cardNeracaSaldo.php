<div class="d-flex justify-content-between my-3">
    <h5 class="mr-auto">NERACA SALDO</h5>

    <!-- <button class="mx-2 btn btn-main1" data-toggle="modal" data-target="#modal_input_kegiatan">
        <i class="fas fa-download"></i>
        Download
    </button> -->
</div>

<div class="table-responsive" style="position:relative;">
    <div id="penutup" style="position: absolute; z-index:200; "></div>
    <table class="table table-sm table-hover table-bordered" id="tabel-neraca-<?= $document_uuid?>">
    <thead>
            <tr class="table-primary">
                <th rowspan=2 >
                    Akun
                </th>
                <?php 
                    setlocale(LC_ALL,"ID");
                    for ($i=1; $i < 13; $i++) {
                        $dateObj   = DateTime::createFromFormat('!m', $i);
                        $monthName = $dateObj->format('F');
                        echo '<th>'.$monthName.'-21</th>';
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
                <th>Assets</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>

            <tr>
                <th>Current Assets</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>

            <tr>
                <td>Petty Cash</td>
                <td>0</td>
                <td>20000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>40000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>500000</td>
                <td>0</td>
                <td>0</td>
                <td>560000</td>
                <?php 
                    // $petty_cash = 0;
                    
                    // for ($i=0; $i < 12; $i++) { 
                    //     $toadd = rand(0,1000000);
                    //     echo '<td>'.$toadd.'</td>';
                    //     $petty_cash += $toadd;
                    // }
                    // echo '<td>'.$petty_cash.'</td>';
                ?>
            </tr>

            <tr>
                <td>Cash On Hand</td>
                <td>10000</td>
                <td>0</td>
                <td>0</td>
                <td>30000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>20000</td>
                <td>0</td>
                <td>0</td>
                <td>60000</td>
                <?php 
                    // $coh = 0;
                    
                    // for ($i=0; $i < 12; $i++) { 
                    //     $toadd = rand(0,1000000);
                    //     echo '<td>'.$toadd.'</td>';
                    //     $coh += $toadd;
                    // }
                    // echo '<td>'.$coh.'</td>';
                ?>
            </tr>


            <tr class="table-success">
                <th>Total Current Assets</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>


            <tr class="table-secondary">
                <th>Fixed Assets</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>

            <tr>
                <td>Building and Land</td>
                <td>0</td>
                <td>20000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>40000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>500000</td>
                <td>0</td>
                <td>0</td>
                <td>560000</td>
                <?php 
                    // $petty_cash = 0;
                    
                    // for ($i=0; $i < 12; $i++) { 
                    //     $toadd = rand(0,1000000);
                    //     echo '<td>'.$toadd.'</td>';
                    //     $petty_cash += $toadd;
                    // }
                    // echo '<td>'.$petty_cash.'</td>';
                ?>
            </tr>

            <tr>
                <td>Vehicle</td>
                <td>10000</td>
                <td>0</td>
                <td>0</td>
                <td>30000</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>20000</td>
                <td>0</td>
                <td>0</td>
                <td>60000</td>
                <?php 
                    // $coh = 0;
                    
                    // for ($i=0; $i < 12; $i++) { 
                    //     $toadd = rand(0,1000000);
                    //     echo '<td>'.$toadd.'</td>';
                    //     $coh += $toadd;
                    // }
                    // echo '<td>'.$coh.'</td>';
                ?>
            </tr>

            <tr class="table-secondary">
                <th>Accumulated Depreciation</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>

            <tr class="table-success">
                <th>Total Fixed Assets</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>




            <tr class="table-success">
                <th>Total Liabilities</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>



            <tr class="table-success">
                <th>Total Long Term Liabilities</th>
                <?php 
                    for ($i=0; $i < 13; $i++) { 
                        echo '<th></th>';
                    }
                ?>
            </tr>

        </tbody>
    </table>
</div>


<script>
    // buat object transparant di depan table
    let boxwidth = $('#tabel-neraca-<?= $document_uuid?>')[0].offsetWidth
    let boxheight = $('#tabel-neraca-<?= $document_uuid?>')[0].offsetHeight

    $('#penutup').css('width', boxwidth)
    $('#penutup').css('height', boxheight)
    $('#penutup').css('background-color', 'rgb(0 0 0 / 1%)')
</script>