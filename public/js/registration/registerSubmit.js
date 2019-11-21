let errorsBlock = document.getElementById('errorsBlock')
let registerSubmit = document.getElementById('registerSubmit')
let registerForm = document.getElementById('registerForm')
let fileInput = document.getElementById('uploadImage')
let inputName = document.getElementById('fileName')
let errorMessages = []
let formData = {
    username: null,
    email: null,
    firstName: null,
    lastName: null,
    password: null,
    confirmPassword: null,
    gender: null,
    avatar: null,
}

fileInput.onchange = function (event) {
    event.preventDefault()
    inputName.innerText = (this.value).split('\\').pop()
    formData.avatar = this.files[0]
}

registerSubmit.onclick = function (event) {
    event.preventDefault()
    let data = new FormData(registerForm)
    setErrorMessages().length > 0
        ?
        errorsBlock.innerText = 'Incorrect fields: ' + errorMessages.join(', ')
        :
        ajaxAction('/user/registration', 'POST', data).
            then(response => {
                console.log(response)
                refreshErrorsBlock()
                if (response.length > 0) {
                    let ul = document.createElement('ul')
                    response.forEach(error => {
                        let li = document.createElement('li')
                        li.innerText = error
                        ul.appendChild(li)
                    })
                    errorsBlock.appendChild(ul)
                    return false
                }
                window.location.href = '/user/loginForm'
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
            case 'email':
                if (formData[field] === null) {
                    errorMessages.push('Email')
                }
                break
            case 'firstName':
                if (formData[field] === null) {
                    errorMessages.push('First Name')
                }
                break
            case 'lastName':
                if (formData[field] === null) {
                    errorMessages.push('Last Name')
                }
                break
            case 'password':
                if (formData[field] === null) {
                    errorMessages.push('Password')
                }
                break
            case 'confirmPassword':
                if (formData[field] === null) {
                    errorMessages.push('Confirm Password')
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