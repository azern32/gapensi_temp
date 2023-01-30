function toIDCurrency(number) {
    return new Intl.NumberFormat('id-ID').format(number)
}

function tanggal(milisec){
    let d = new Date(milisec)
    let opt = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    return d.toLocaleDateString(undefined, opt)
}

var akunRekening;
fetch('http://localhost/gapensi_keuangan/public/akun/list/akun')
.then((x)=>{return x.json()})
.then((x)=>{akunRekening = x})

function namaAkun(uuid) {
    for (let i = 0; i < akunRekening.length; i++) {
        if (uuid == akunRekening[i].uuid) {
            return akunRekening[i].nama_akun
        }
        
    }
}





function changeVisibility() {
    if ($('#visibilityIcon').text() == 'visibility') {
        $('#visibilityIcon').text('visibility_off')
        $('#passwordLogin').attr('type','text')
    } else {
        $('#visibilityIcon').text('visibility')
        $('#passwordLogin').attr('type','password')
    }
}


