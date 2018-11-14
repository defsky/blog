$(function() {

    console.log('table-loader');

    $('#userlist .pagination a').click(function(e) {
        e.preventDefault();
        var url=$(this).attr('href');
        getData(url);
    });

    function getData(url) {
        $('#userlist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

        $.ajax({
            url :url,
            data : {}
        }).done(function (data) {
            $('#userlist').html(data);
        }).fail(function () {
            alert('table data load failed');
        });
        
        window.history.pushState("", "",url);
    }
});
