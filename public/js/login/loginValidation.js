let username = document.getElementById('usernameLogin')
let password = document.getElementById('passwordLogin')
let errorsBlock = document.getElementById('errorsBlock')
let submitForm = document.getElementById('loginSubmit')
let loginForm = document.getElementById('loginForm')
let errorMessages = []
let formData = {
    username: null,
    password: null,
}

username.addEventListener('input', function () {
    this.value.length < 3 ?
        (setStatus(this, 'min 3 characters', false),
            formData.username = null) :
        (setStatus(this, '', true),
            formData.username = this.value)
})

password.addEventListener('input', function () {
    this.value.length < 6 ?
        (setStatus(this, 'min 6 symbols', false),
            formData.password = null) :
        (setStatus(this, '', true),
            formData.password = this.value)
})

submitForm.onclick = function (event) {
    event.preventDefault()
    let data = new FormData(loginForm)
    setErrorMessages().length > 0
        ?
        errorsBlock.innerText = 'Incorrect fields: ' + errorMessages.join(', ')
        :
        ajaxAction('/user/login', 'POST', data).
            then(response => {
                refreshErrorsBlock()
                if (response.length > 0) {
                    errorsBlock.innerText = response[0]
                    return false
                }
                window.location.href = '/user/profile'
            })
}

function setErrorMessages () {
    errorMessages = []
    for (let field in formData) {
        switch (field) {
            case 'username':
                if (formData[field] === null) {
                    errorMessages.push('Username')
                }
                break
            case 'password':
                if (formData[field] === null) {
                    errorMessages.push('Password')
                }
                break
        }
    }
    return errorMessages
}

function refreshErrorsBlock () {
    while (errorsBlock.firstChild) {
        errorsBlock.removeChild(errorsBlock.firstChild)
    }
}
