$(document).ready(function () {
    $('.del-contact-person-button').click(function () {
        let token = $(this).data('token');
        let url = $(this).data('url');
        let contactPersonId = $(this).data('id');

        Swal.fire({
            title: 'Biztosan törölni akarja?',
            icon: 'error',
            showCancelButton: true,
            cancelButtonText: 'Mégse',
            confirmButtonText: 'Törlés',
        }).then((result) => {
            if (result.isConfirmed) {
                sendDeleteRequest(url, token, contactPersonId)
            }
        });
    });

    function sendDeleteRequest(url, token, contactPersonId) {
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {'_token': token},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.message) {
                    $('#contact-person-' + contactPersonId).remove();
                }
            },
            onError: function (err) {
                console.log(err);
            }
        });
    }

});

/*
//without alert
$('.del-contact-person-button').click(function () {
        let token = $(this).data('token');
        let url = $(this).data('url');
        let contactPersonId = $(this).data('id');

        if (url !== undefined) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {'_token': token},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.message) {
                        $('#contact-person-' + contactPersonId).remove();
                    }
                },
                onError: function (err) {
                    console.log(err);
                }
            });
        }
    });
 */

