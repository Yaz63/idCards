function smartPrint(html, filename = '', orientation = 'portrait') {
    if (filename) {
        filename = filename + ".pdf"
    } else {
        filename = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15) + ".pdf";
    }
    var opt = {
        margin: 1,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: orientation }
    };
    html2pdf().set(opt).from(html).save();

}

function ajaxHtmlPrint(ajax_url, data = {}, filename = '', orientation = 'portrait') {
    if (filename) {
        filename = filename + ".pdf"
    } else {
        filename = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15) + ".pdf";
    }
    var opt = {
        margin: 1, //top, left, buttom, right
        filename: filename,
        image: { type: 'jpeg', quality: 0.75 },
        html2canvas: { scale: 1.3 },
        jsPDF: { unit: 'in', format: 'a4', orientation: orientation }
    };
    $.post(ajax_url, data, function(result) {

        html2pdf().set(opt).from(result).save();
    }, 'html');
}

function sendPdf(ajax_url, upload_url, data = {}, filename = '', orientation = 'portrait') {
    var send_data = data;
    if (filename) {
        filename = filename + ".pdf"
    } else {
        filename = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15) + ".pdf";
    }
    var opt = {
        margin: 1,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: orientation }
    };
    $.post(ajax_url, data, function(result) {

        html2pdf().from(result).outputPdf().then(function(pdf) {

            uploadPdf(upload_url, btoa(pdf), send_data);

        });
    }, 'html');
}

function uploadPdf(upload_url, file, data) {
    var file_data = { file: file, id: data.id };
    $.post(upload_url, file_data, function(result) {
        if (result.sucecess == true) {
            HRSuccessMsg(result.message, result.msg_title);
        } else {
            HRErrorMsg(result.message, result.msg_title);

        }
    });
}