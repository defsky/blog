          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('Gift Bag Manage') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-inline" role="form" id="form-searchuser">
                            <div class="form-group">
                                <button class="btn btn-theme"
                                    data-toggle="modal"
                                    id="btn-createbag"><i class="fa fa-plus"></i>{{ ' '.__('Create Giftbag') }}</button>
                            </div>
                        </form>
                    </div><!--/form-panel-->
	                <div class="form-panel">
                        <div id="giftbaglist">

                            @include('admin.partial_giftbaglist')

                        </div>
                    </div><!--/form-panel-->
          		</div>
          	</div>
			
			<!--Create Bag Modal -->
			<div class="modal fade" id="createbagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Create Giftbag')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div>
                        <div class="row centered">
						    <img src="assets/img/giftbag.png" class="img-square" width="50">
                            <p> </p>
                        </div>
						<div class="row">
                            <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                <form class="form-horizontal style-form" id="form-newbaginfo" action="">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label toright" for="">{{ __("Bag Count") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="count" placeholder="{{ __('Input Count to Create')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag Owner") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="owner" value="G000000" placeholder="{{ __('Input Bag Owner UUID')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag Name") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" placeholder="{{ __('Input Bag Name')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag Type") }}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="orderstatusselector" name="type">
                                                @foreach ( $bagTypes as $value => $text)
                                                    <option value="{{ $value }}">{{ __($text) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag Reward") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="reward" placeholder="{{ __('Input Reward Count')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag Usable Times") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="number" value="1" placeholder="{{ __('Input Bag Usable Times')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag Begin Date") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="beginDate" value="{{ date('Y-m-d') }}"placeholder="{{ __('Input Begin Date')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Bag End Date") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="endDate" value="{{ date('Y-m-d',strtotime('+7 day')) }}"placeholder="{{ __('Input End Date')}}" type="text" requested>
                                        </div>
                                    </div>
                                </form>
                            </div>
					    </div>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-primary" id="btn-createnewbag">{{ __('Create') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
		</section><! --/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box

    $('#btn-createbag').click(function (e) {
        e.preventDefault();
        $('#createbagModal').modal('show');    
    });

    $('#btn-createnewbag').click(function (e) {
        $data = $('#form-newbaginfo').serializeArray();

        $.ajax({
            type:'POST',
            url :'/admin/creategiftbag',
            data : $data,
        }).done(function (data) {
            $('#createbagModal').modal('hide');
            if (data.status == "000000") {
                window.location.href = window.location.origin + '/admin/login';
            } else {
                if (data.ret == 0) {
                    $.gritter.add({
                       title:"系统提示",
                       text:"礼包创建成功!<br>"+data.msg ,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                } else {
                    $.gritter.add({
                       title:"系统提示",
                       text:"礼包创建失败!<br>" + data.msg,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                }
            }
        }).fail(function (data) {
            var data = JSON.parse(data.responseText);
            var detail = "";
            $.each(data.errors,function(k,v) {
               detail += v + '<br>'; 
            });
            $.gritter.add({
               title:"系统提示",
               text:"礼包创建失败<br>" + '<br>' + detail,
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
