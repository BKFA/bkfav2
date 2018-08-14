$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

    function updateActive(idPost, active) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'admin/posts/active/' + idPost + '/' + active,
            type: 'PUT',
            dataType: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'idPost': idPost,
                'isActive': active
            },
            success: function (data) {
                console.log('ok');
                console.log(data);
            },
            error: function (error) {
                console.log('error');
                console.log(error); 
            }
        });
    }

    $(document).on('change', ':checkbox[name="status"]', function (event) {
        event.preventDefault();
        let idPost = $(this).closest('.pannel').attr("data-boardid");
        let isActive = $(this).is(":checked");
        updateActive(idPost,  isActive ? 1 : 0);
    })
});
