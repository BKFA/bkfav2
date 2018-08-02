$(document).ready(function() {

    // for search bar
    $('#searchIcon').on("click", function() {
        $(this).parents('.header_search').find("#shide").css('top', '0px')
        $(this).parents('.header_search').find("#shide").css('display', 'block')
    });
    $('.remove').on("click", function() {
        $(this).parents('#shide').fadeOut();
        $(this).parents('#shide').css('top', '-80px')
    });

    // Validation Image
    var message = document.getElementsByClassName("message")[0];
    var file_upload = document.getElementById('file');
    // hiển thị ảnh nếu validation thành công
    file_upload.addEventListener('change', function(e) {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) ||
                (imagefile == match[2]))) {
            // document.getElementById('file').value = null;
            message.innerHTML = "File phải có định dạng jpeg, jpg and png !!!";
            document.getElementById('previewing').style.display = "none";
            return false;
        } else {
            message.innerHTML = "Bạn đã chọn ảnh !!!";
            var reader = new FileReader();
            reader.onload = function imageIsLoaded(e) {
                var previewing = document.getElementById('previewing');
                previewing.style.display = "block";
                previewing.setAttribute('src', e.target.result);
                previewing.setAttribute('width', '285px');

            }
            reader.readAsDataURL(this.files[0]);
        }
    });

});

$(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
        $('#goTop').fadeIn();
    } else {
        $('#goTop').fadeOut();
    }
});
$('#goTop').click(function() {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});

// $(document).ready(function(){
//     $(window).scroll(function(){
//         if($(window).scrollTop()==$(document).height()-$(window).height()){
//             alert('binh');
//         }
//     });
// });

// scroll page home
$('ul.pagination').hide();

$(function() {
    $('.infinite-scroll').jscroll({
        autoTrigger: true,
        loadingHtml: " <div class='col-sm-12  row justify-content-center align-items-center'><i class='fa fa-circle-o-notch fa-spin' style='font-size: 30px; text-align: center; padding: 20px;'></i></div> ",
        padding: 0,
        nextSelector: '.pagination li.active + li a',
        contentSelector: 'div.infinite-scroll',
        callback: function() {
            // xóa thanh phân trang ra khỏi html mỗi khi load xong nội dung
            $('ul.pagination').remove();
        }
    });
});
// end

// get post by type at home
function readMore(id) {
    $('#read-more' + id).hide();
    $('#content' + id).show();
    $('#des' + id).hide();
}

function getList(type) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url: 'home/' + type,
        type: 'POST',
        dataType: 'json',
        data: {
            '_token': $('input[name=_token]').val(),
            'type': type
        },
        success: function(data) {

            console.log('ok');
            $('.infinite-scroll').html(data.html)
            console.log(data);
        },
        error: function(error) {
            console.log('error');
            console.log(error);
        }
    });
}
// end

// clap
function mouseDown(id, flag) {
    $('.clap' + id + ' .svgIcon-use:last-child').removeClass('hide');
    $('.clap' + id + ' .svgIcon-use:first-child').addClass('hide');
    rate(id);
}

function rate(post_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url: 'posts/rate/' + post_id,
        type: 'PUT',
        dataType: 'json',
        data: {
            '_token': $('input[name=_token]').val(),
            'post_id': post_id
        },
        success: function(data) {
            console.log('ok');
            $('#number-rate' + post_id).text(data);
            console.log(data);
        },
        error: function(error) {
            console.log('error');
            console.log(error);
        }
    });
}
// end clap

// next comment
var comment = (function() {

    var onReady = function() {
        $('body').on('click', 'a.nextcomments', nextComment)
    }

    // Set comment edition
    var nextComment = function(event) {
        event.preventDefault()
        var i = $(this).attr('id').substring(12);
        $('#morebutton' + i).hide()
        $('#moreicon' + i).show()
        $.get($('#comment-more' + i).attr('href'))
            .done(function(data) {
                $('div.commentlist' + i).append(data.html)
                if (data.href !== 'none') {
                    $('#comment-more' + i).attr('href', data.href)
                    $('#morebutton' + i).show()
                }
                $('#moreicon' + i).hide()
            })
    }

    return {
        onReady: onReady
    }

})()

$(document).ready(comment.onReady)
// end next comment

// scroll menu
$('.main-sidebar').mouseover(function(e) {
    e.preventDefault();
    $('.menu-right').addClass('sidebar');
});
$('.main-sidebar').mouseout(function(e) {
    e.preventDefault();
    $('.menu-right').removeClass('sidebar');
});
// end

// change form search
$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on("focus", '[data-action="grow"]', function() {
        $(window).width() > 1200 && $(this).animate({ width: 300 })
    });

    $(document).on("blur", '[data-action="grow"]', function() {
        if ($(window).width() > 1200) {
            $(this).animate({ width: 190 })
        }
    });

});
// end