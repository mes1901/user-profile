function ajaxAction(url, type, data) {
    return new Promise(resolve => {
        $.ajax({
            url: url,
            type: type,
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data) {
                resolve(data);
            }
        });
    });
}
