          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('Order List') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
	                <div class="content-panel">
	                    <hr>
                        <div id="orderlist">

                            @include('admin.partial_orderlistpage')

                        </div>
	                </div><!--/content-panel -->
          		</div>
          	</div>
			<!-- Modal -->
			<div class="modal fade" id="orderinfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Order Info')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div id="orderinfopanel">
			            Hi there, Modal Content here.
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-primary" id="btn-saveorderinfo">{{ __('Save') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
		</section><!--/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box

    $('#btn-saveorderinfo').click(function (e) {
        $data = $('#form-orderinfo').serializeArray();
        $uid = $data[1].value;

        $.ajax({
            type:'POST',
            url :'/admin/saveorderinfo',
            data : $data,
        }).done(function (msg) {
            $tds = $('#'+$uid+'>td');
            $.each($data,function(){
                switch (this.name) {
                    case 'orderstatus':
                        $tds[9].textContent = $('#orderstatusselector')[0].options[this.value].text;
                        break;
                }    
            });

            $.gritter.add({
               title:"系统提示",
               text:"UUID：" + msg + "<br />用户信息保存成功!",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        }).fail(function () {
            $.gritter.add({
               title:"系统提示",
               text:"用户信息保存失败",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
