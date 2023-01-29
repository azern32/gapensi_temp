<li class="nav-item my-2">
    <a href="<?= base_url()?>/index.php/dashboard" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Dashboard
        </p>
    </a>
</li>

<script>
    $(document).ready( function(){
        $(`[href='${window.location.href}']`).addClass('active')
    })
</script>