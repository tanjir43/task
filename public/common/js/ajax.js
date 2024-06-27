function getPaginatedListData(form_route, placement_area, extra_data={},showInnerLoader=true) {
    let _token = $("meta[name=csrf-token]").attr('content');
    let req_data = extra_data;
    /*{
        _token : _token
    };*/
    req_data._token = _token;

     
    $.ajax({
        type: 'POST',
        url: form_route,
        data: req_data,
        beforeSend: function () {
            //let loader_html = "<div class='inner-div-loader'></div>";
            let loader_html = ` <div class="text-center ">
                                <div class="spinner"></div>
                                <div class="spinner"></div>
                                <div class="spinner"></div>
                                <div class="spinner"></div>
                                <div class="spinner"></div>
                                </div>`;
           
            //$(placement_area).html(loader_html);
        },
        success: function (data) {
            if (data.status == 200) {
                $(placement_area).html(data.view);
            }else {
                showErrorAlert('Error!',data.msg);
            }
        },
        error: function (xhr, status, error) {
            showErrorAlert('Error!',xhr.responseText.message);
        },
        complete: function () {

        }
    });
}