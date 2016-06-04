var uploadHandler = uploadHandler || {}
var file_index = 0;
var link_idx = 0;

uploadHandler.uploadAdd = function (e, data) {
    // console.dir(data);
    var file = data.files[0];
    file["id"] = file_index;
    file_index++;
    try {
        $("#result").loadTemplate($("#panel-template"),
            {
                panel_id: "panel_" + file.id,
                head_status: file.name + " <span class='label label-default'><i class='fa fa-cloud-upload'></i> กำลังรอ...</span>"
            }, {prepend: true});
        try {
            $("#welcome").remove();
        } catch (ex) {
            //
        }
    } catch (ex) {
        console.log(ex);
    }
    data.process().done(function () {
        data.submit();
    });
}

uploadHandler.uploadProgress = function (e, data) {
    // console.dir(data.files);
    var file = data.files[0];
    try {
        var percent = parseInt(data.loaded / data.total * 100, 10);
        $("#" + "panel_" + file.id).html('<div class="panel-heading"><h3 class="panel-title" >' + file.name + ' <span class="label label-default"><i class="fa fa-spinner"></i> ' + percent + '%</span></h3></div>');
    } catch (ex) {
        //
    }
}

uploadHandler.uploadAllProgress = function (e, data) {
    // console.dir(data.files);
    try {
        var percent = parseInt(data.loaded / data.total * 100, 10);
        $('#all_progress').attr(
            'aria-valuenow', percent
        ).css(
            'width',
            percent + '%'
        ).html(
            percent + '%'
        );
    } catch (ex) {
    }
}

uploadHandler.uploadDone = function (e, data) {
    // console.dir(data);
    var fileUpload = data.result;
    try {
        if (fileUpload['success']) {
            var duplicateState;
            if (fileUpload['isDuplicate'] !== 1)
                duplicateState = " <span class='label label-success hidden-xs'>อัพโหลดสำเร็จ</span>";
            else
                duplicateState = " <span class='label label-warning hidden-xs'>ภาพนี้ถูกอัพโหลดซ้ำ</span>";
            link_idx++;
            $("#" + "panel_" + data.files[0].id).loadTemplate($("#img-template"),
                {
                    file_name: fileUpload['filename'] + duplicateState,
                    thumbImg: fileUpload['thumbnailUrl'],
                    directUrl: fileUpload['directUrl'],
                    bbFullUrl: fileUpload['bbFullUrl'],
                });
            var bbAllFull = $("#bbAllFull").val();
            $("#bbAllFull").val(bbAllFull + " " + fileUpload['bbFullUrl']);
        } else {
            $("#" + "panel_" + data.files[0].id).html('<div class="panel-heading"><h3 class="panel-title" >' + fileUpload['filename'] + ' <span class="label label-danger"><i class="fa fa-exclamation-circle"></i> Error: ' + fileUpload['errorMessage'] + '</span></h3></div>').fadeOut(5000);
        }
    } catch (ex) {
        //
    }
}
