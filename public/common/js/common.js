function update_data(table,column,id,data, reload = true){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $.ajax({
        url: "/update-data",
        method: 'POST',
        data: {
            id:id,
            table:table,
            column:column,
            data:data
        },
        dataType: 'JSON',
        success:function(response)
        {
            if(response.status=='success'){
                showSuccessAlert('Updated',response.message,'toastr') 

                if(reload){
                    setTimeout(function(){ location.reload(); }, 100);
                }  
            }
        }
    });
}



