          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('User List') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
	                <div class="content-panel">
	                    <hr>
                        <div id="userlist">

                            @include('admin.partial_userlistpage')

                        </div>
	                </div><!--/content-panel -->
          		</div>
          	</div>
			<!-- Modal -->
			<div class="modal fade" id="userinfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('User Info')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div id="userinfopanel">
			            Hi there, Modal Content here.
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-primary">{{ __('Save') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
		</section><!--/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box


      $(function(){
          $('select.styled').customSelect();
      });

  </script>
