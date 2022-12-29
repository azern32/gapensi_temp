<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <?php 
        if (isset($dependencies)) {
            foreach ($dependencies['css'] as $key => $val) {
                echo "\n    <!--".$key."-->\n    <link rel='stylesheet' href='".$val."'>";
            }
        }

        if (isset($dependencies)) {
            foreach ($dependencies['js'] as $key => $val) {
                echo "\n    <!--".$key."-->\n    <script src='".$val."'></script>";
            }
        }
    ?>
</head>
<body style="background: url(<?php echo base_url();?>/image/wallpaperbetter_2.png);">
    <div class="container p-2 my-5 mx-auto" >
      <div class="card background mx-auto " style="background: linear-gradient(180deg, rgba(27, 101, 200, 0) 3.22%, #193463 41.67%), url(<?php echo base_url();?>/image/wallpaperbetter_1.png);">
        <img class="mx-auto m-5" src="<?php echo base_url();?>/image/logo.png" alt="" style="height: 150px;">
        <!-- <p class="header-utama">Gapensi</p> -->
        <p class="sub-header my-3">GKB Management App - Keuangan</p>
        
        <div class="m-5 p-3">
          <form class="" action="#" method="post">
            <div class="input-group my-3">
              <input id="userLogin" class="form-control" type="text" name="username" value="" placeholder="Username">
            </div>

            <div class="input-group my-3">
              <input id="passwordLogin" class="form-control" type="password" name="password" value="" placeholder="Password">
              <div class="input-group-append" style="cursor: pointer">
                <!-- <span>
                    <i class="fas fa-eye-slash input-group-text material-icons"></i>
                </span> -->
                <span id="visibilityIcon" class="input-group-text material-icons" onclick="changeVisibility()">visibility</span>
              </div>
            </div>

            <button class="btn btn-block mt-3 tombol-sign" type="button" onclick="login()" name="button">Sign In</button>

          </form>
        </div>
      </div>
    </div>


    <!-- Scripts -->
    <script>
        async function login() { //fungsi login ketika tombol sign in dipencet
            // data dari form dibentuk sebagai Formdata()
            let form = new FormData($('form')[0]);

            await fetch('<?php echo base_url()?>/login/post', {
                method:'post',
                body: form,
            }).then(res => {
                console.log(res.json());
            }).catch(err => {
                console.log(err);
            })
        }
    </script>
</body>
</html>