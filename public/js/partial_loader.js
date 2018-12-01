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

$.ieDown = url => {
    window.open(url);    
};
$.isIE = () => {
    const explorer = window.navigator.userAgent;
    return explorer.indexOf('MSIE') >= 0 || explorer.indexOf('Trident/7.0') >= 0 || explorer.indexOf('Edge') >= 0;    
};
