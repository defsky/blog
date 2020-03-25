          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('Order List') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-inline" action="" role="form" id="form-searchorder">
                           <div class="form-group">
                               <label class="sr-only" for="kwtype">{{ __("Property") }}</label>
                               <select class="form-control" id="kwtype" name="kwtype">
                                   @foreach ( $orderKwTypes as $value => $text)
                                       <option value="{{ $value }}" {{ $kwtype == $value ? 'selected':''}}>{{ __($text) }}</option>
                                   @endforeach
                               </select>
                           </div>
                            <div class="form-group" id="inputArea">
                                <label class="sr-only" for="kwinput">{{ __('Keyword') }}</label>
                                <input class="form-control" type="keyword" placeholder="{{ __('Keyword')}}" id="kwinput">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-theme" id="btn-search">{{ __('Search') }}</button>
                            </div>
                        </form>
                    </div><!--/form-panel-->
	                <div class="form-panel">
                        <div id="orderlist">

                            @include('admin.partial_orderlistpage')

                        </div>
	                </div><!--/form-panel -->
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
			            <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
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
    $('#kwtype').change(function(e) {
        if (this.value == '2') {
            $('#inputArea').html('<label class="sr-only" for="kwinput">{{ __('Keyword') }}</label>' + 
            '<select class="form-control" id="kwinput" name="kwtype">' +
                @foreach ( $orderStatus as $value => $text)
                    '<option value="{{ $value }}">{{ __($text) }}</option>' +
                @endforeach
            '</select>');
        } else {
            $('#inputArea').html('<label class="sr-only" for="kwinput">{{ __('Keyword') }}</label>' + 
                '<input class="form-control" type="keyword" placeholder="{{ __('Keyword')}}" id="kwinput">'); 
        }
    });
    $('#btn-search').click(function (e) {
        e.preventDefault();

        $.ajax({
            url :'/admin/orderlist',
            data : {
                cid:'orderlist',
                kw:$('#kwinput')[0].value,
                kwtype:$('#kwtype')[0].value
            }
        }).done(function (data) {
            if (data.status == '000000') {
                window.location.href = window.location.origin + '/admin/login';    
            } else {
                $('#orderlist').html(data);
            }
        }).fail(function () {
            $.gritter.add({
               title:"系统错误",
               text:"查找订单信息失败",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });

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
               text:"订单：" + msg + "<br />保存成功!",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        }).fail(function () {
            $.gritter.add({
               title:"系统提示",
               text:"订单信息保存失败",
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
