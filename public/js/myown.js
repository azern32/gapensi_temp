function toIDCurrency(number) {
    return new Intl.NumberFormat('id-ID').format(number)
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