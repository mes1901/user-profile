function setStatus (input, message, isValid) {
    let error = input.nextElementSibling
    if (isValid) {
        error.classList.remove('invalid-feedback')
        error.classList.add('valid-feedback')
        error.innerHTML = message
        input.classList.remove('is-invalid')
        input.classList.add('is-valid')
        return true
    }
    if (!error.classList.contains('invalid-feedback') &&
        !input.classList.contains('is-invalid')) {
        error.classList.add('invalid-feedback')
        error.innerHTML = message
        input.classList.add('is-invalid')
        return true
    }
    error.innerHTML = message
}