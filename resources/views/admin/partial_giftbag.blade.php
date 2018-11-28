          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('Gift Bag Manage') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-6">
	                <div class="form-panel">
                        <div id="giftbaglist">

                            @include('admin.partial_giftbaglist')

                        </div>
                    </div><!--/form-panel-->
          		</div>
          	</div>
			
		</section><! --/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
