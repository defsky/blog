$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//$('.partial_link').click ( function () {
//    //$(this).parent().addClass('active');
//
//    path=$(this).data('path');
//    $.post('/admin/' + path, function (content) {
//        $('#main-content').html(content);
//    }); 
//});
