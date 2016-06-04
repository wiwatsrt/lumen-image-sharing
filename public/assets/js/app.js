$(function () {
    $("#btnSelectImg").click(function(){ $('#fileUpload').click()});
    $('#fileUpload').fileupload({
        dataType: 'json',
        sequentialUploads: true,
        progress:uploadHandler.uploadProgress,
        progressall:uploadHandler.uploadAllProgress,
        add:uploadHandler.uploadAdd,
        done: uploadHandler.uploadDone,
    });
});