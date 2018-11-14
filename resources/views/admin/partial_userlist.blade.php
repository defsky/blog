          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('User List') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
	                <div class="content-panel">

	                <hr>
                    <div id="userlist">

                        @include('admin.partial_userlistpage');

                    </div>
	                 </div><!--/content-panel -->
          		</div>
          	</div>
			
		</section><!--/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box

     $('#userlist .pagination a').click(function (e) {
        e.preventDefault();
        var url=$(this).attr('href');

        $('#userlist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

        $.ajax({
            url :url,
            data : {}
        }).done(function (data) {
            $('#userlist').html(data);
        }).fail(function () {
            $.gritter.add({
               title:'Server Error',
               text:'load table data failed',
               image:'../assets/img/ui-sam.jpg',
               sticky:false, 
               time:''
            });
        });
        
        //window.history.pushState("", "",url);
     });

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
