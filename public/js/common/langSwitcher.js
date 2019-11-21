let langSelector = document.getElementById('lang');
let currentLang = document.getElementById('currentLang')
langSelector.value = currentLang.value

langSelector.onchange = function (event) {
    event.preventDefault()
    ajaxAction('/user/language/' + this.value, 'POST', null).
        then(() => {
            document.location.reload(true);
        })
}