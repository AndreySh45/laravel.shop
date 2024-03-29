$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '80%'
    });

});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    while (filePath.indexOf("\\") >= 0) { filePath = filePath.replace("\\", "/"); } //Замена слэша в пути картинки товара
    $('#' + requestingField).val(filePath).trigger('change');
    $('.img-uploaded').attr('src', 'http://laravel.shop/uploads/'+filePath).trigger('change');
}

// function processSelectedFile(filePath, requestingField) {
//     $('#' + requestingField).val('/'+filePath).trigger('change');
//     $('.img-uploaded').attr('src', '/'+filePath).trigger('change');
// }
