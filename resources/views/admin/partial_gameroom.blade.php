          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('Game Room Manage') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-inline" role="form" id="form-searchuser">
                            <div class="form-group">
                                <button class="btn btn-danger"
                                    data-toggle="modal"
                                    id="btn-delSelected"><i class="fa fa-trash-o"></i>{{ ' '.__('Delete Selected') }}</button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-theme"
                                    data-toggle="modal"
                                    id="btn-createroom"><i class="fa fa-plus"></i>{{ ' '.__('Create Gameroom') }}</button>
                            </div>
                        </form>
                    </div><!--/form-panel-->
	                <div class="form-panel">
                        <div id="gameroomlist">

                            @include('admin.partial_gameroomlist')

                        </div>
                    </div><!--/form-panel-->
          		</div>
          	</div>
			
			<!--Create Room Modal -->
			<div class="modal fade" id="createRoomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Create Gameroom')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div>
                        <div class="row centered">
						    <img src="assets/img/giftbag.png" class="img-square" width="50">
                            <p> </p>
                        </div>
						<div class="row">
                            <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                <form class="form-horizontal style-form" id="form-newroominfo" action="">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Room Name") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" placeholder="{{ __('Input Room Name')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Room Type") }}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="appidselector" name="appid">
                                                @foreach ( $apps as $app)
                                                    <option value="{{ $app->appid }}">{{ __($app->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Room Count") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="count" value="1" placeholder="{{ __('Input Room Count')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Fee Type") }}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="feetypeselector" name="fee_type">
                                                @foreach ( $feeTypes as $value => $text)
                                                    <option value="{{ $value }}">{{ __($text) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Fee Count") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="fee" placeholder="{{ __('Input Fee Count')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Max Members") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="maxNumber" placeholder="{{ __('Input Max Members')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Min Members") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="minNumber" value="2" placeholder="{{ __('Input Min Members')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Game Server") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="gameserver" placeholder="{{ __('Input Game Server')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Start Time") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="time" value="{{ date('H:i',strtotime('+11 hour')) }}"placeholder="{{ __('Input End Date')}}" type="text" requested>
                                        </div>
                                    </div>
                                </form>
                            </div>
					    </div>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-primary" id="btn-createnewroom">{{ __('Create') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
			<!--Confirm Modal -->
			<div class="modal fade" id="delroomConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Delete Gameroom')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div id="delroominfopanel">
                        <form class="form-horizontal style-form" id="form-delroominfo" action="">
                            @csrf
                            <input type="hidden" value="" name="roomids" id="roomidcontainer">
                        </form>
			            <p>{{ __('Are you sure to delete selected game rooms?')}}</p>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-danger" id="btn-dodeleteroom">{{ __('Delete') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
		</section><! --/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box
    $('#btn-delSelected').click(function (e) {
        e.preventDefault();
        $values = "";
        $('#roomidcontainer').val($values);
        $('#gameroomlist table .rowselector').each(function () {
            if ($(this).is(':checked')) {
           if ($values != "") {
                $values += ':';   
            }
            $values += $(this).parent().parent().attr('id');
            }
        });
        $('#roomidcontainer').val($values);

        if ($values != "") {
            $('#delroomConfirmModal').modal('show');
        }
    });

    $('#btn-dodeleteroom').click(function (e) {
        e.preventDefault();
        $('#delroomConfirmModal').modal('hide');    
        $data = $('#form-delroominfo').serializeArray();

        $.ajax({
            type:'POST',
            url :'/admin/deletegameroom',
            data : $data,
        }).done(function (data) {
            if (data.status == "000000") {
                window.location.href = window.location.origin + '/admin/login';
            } else {
                if (data.ret == 0) {
                    $rid = $('#roomidcontainer')[0].value;
                    $.each($rid.split(':'),function(k,v){
                       $('#'+v).remove(); 
                    });

                    $.gritter.add({
                       title:"系统提示",
                       text:"房间删除成功!<br>"+data.msg ,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                } else {
                    $.gritter.add({
                       title:"系统提示",
                       text:"房间删除失败!<br>" + data.msg,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                }
            }
        }).fail(function (data) {
            $.gritter.add({
               title:"系统提示",
               text:"房间删除失败<br>" ,
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });

    $('#btn-createroom').click(function (e) {
        e.preventDefault();
        $('#createRoomModal').modal('show');    
    });

    $('#btn-createnewroom').click(function (e) {
        $(this).attr('disabled',true);
        $data = $('#form-newroominfo').serializeArray();

        $.ajax({
            type:'POST',
            url :'/admin/creategameroom',
            data : $data,
        }).done(function (data) {
            $('#createRoomModal').modal('hide');
            if (data.status == "000000") {
                window.location.href = window.location.origin + '/admin/login';
            } else {
                if (data.ret == 0) {
                    $.gritter.add({
                       title:"系统提示",
                       text:"房间创建成功!<br>"+data.msg ,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                } else {
                    $.gritter.add({
                       title:"系统提示",
                       text:"房间创建失败!<br>" + data.msg,
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
               text:"房间创建失败<br>" + '<br>' + detail,
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
        $(this).attr('disabled',false);
    });
      $(function(){
          $('select.styled').customSelect();
      });

  </script>
