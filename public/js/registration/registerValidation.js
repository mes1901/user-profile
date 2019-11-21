let username = document.getElementById('username')
let email = document.getElementById('email')
let firstName = document.getElementById('firstName')
let lastName = document.getElementById('lastName')
let password = document.getElementById('password')
let confirmPassword = document.getElementById('confirmPassword')

username.addEventListener('input', function () {
    this.value.length < 3 ?
        (setStatus(this, 'min 3 characters', false),
            formData.username = null) :
        usernameReg.test(this.value) ?
            (setStatus(this, '', true),
                formData.username = this.value) :
            (setStatus(this, 'incorrect username', false),
                formData.username = null)
})

email.addEventListener('input', function () {
    emailReg.test(this.value) ?
        (setStatus(this, '', true),
            formData.email = this.value) :
        (setStatus(this, 'incorrect email', false),
            formData.email = null)
})

firstName.addEventListener('input', function () {
    this.value.length < 3 ?
        (setStatus(this, 'min 3 characters', false),
            formData.firstName = null) :
        firstNameReg.test(this.value) ?
            (setStatus(this, '', true),
                formData.firstName = this.value) :
            (setStatus(this, 'incorrect first name', false),
                formData.firstName = null)
})

lastName.addEventListener('input', function () {
    this.value.length < 3 ?
        (setStatus(this, 'min 3 characters', false),
            formData.lastName = null) :
        lastNameReg.test(this.value) ?
            (setStatus(this, '', true),
                formData.lastName = this.value) :
            (setStatus(this, 'incorrect last name', false),
                formData.lastName = null)
})

password.addEventListener('input', function () {
    this.value.length < 6 ?
        (setStatus(this, 'min 6 symbols', false),
            formData.password = null) :
        (setStatus(this, '', true),
            formData.password = this.value)
})

confirmPassword.addEventListener('input', function () {
    !password.value.length ?
        (setStatus(this, 'enter password field first', false),
            formData.confirmPassword = null) :
    this.value !== password.value ?
        (setStatus(this, 'passwords don\'t match', false),
            formData.confirmPassword = null) :
        (setStatus(this, '', true),
            formData.confirmPassword = this.value)
})
