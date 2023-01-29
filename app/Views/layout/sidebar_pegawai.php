<li class="nav-item my-2">
    <a href="<?= base_url()?>/index.php/input" class="nav-link">
        <i class="nav-icon fas fa-plus"></i>
        <p>
        Input Keuangan
        </p>
    </a>
</li>

<li class="nav-item my-2">
    <a href="<?= base_url()?>/index.php/jurnal" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
        Jurnal Keuangan
        </p>
    </a>
</li>

<li class="nav-item my-2">
    <a href="<?= base_url()?>/index.php/neraca" class="nav-link">
        <i class=" nav-icon fas fa-balance-scale"></i>
        <p>
        Neraca Keuangan
        </p>
    </a>
</li>

<li class="nav-item my-2">
    <a href="<?= base_url()?>/index.php/akun" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>
        Daftar Akun
        </p>
    </a>
</li>

<script>
    $(document).ready( function(){
        $(`[href='${window.location.href}']`).addClass('active')
    })
</script>