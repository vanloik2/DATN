$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// UploadFile
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',

        success: function (results) {
            if (results.error == false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a> ');

                $('#thumb').val(results.url);
            } else {
                alert("Upload file lỗi");
            }
        }
    })
})

function deleteAjax(parameter, id) {
    var token = $(this).data("token");
<<<<<<< HEAD
    if (confirm('Bạn có chắc chắn muốn xóa?')) {
        $.ajax({
            url: parameter + "/" + id,
            type: 'POST',
=======

    if (confirm('Bạn có chắc chắn muốn xóa?')) {
        $.ajax({
            url: `${parameter}` + "/" + `${id}`,
            type: 'DELETE',
>>>>>>> hoang
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
<<<<<<< HEAD
            success: function(data) {
                console.log(data.model);
=======
            success: function (data) {
>>>>>>> hoang
                Swal.fire(
                    'Successful!',
                    'Student delete successfully!',
                    'success'
                )
<<<<<<< HEAD
=======
                console.log(data.model.id);
>>>>>>> hoang
                $('#id' + data.model.id).remove();
            }
        });
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> hoang
