          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('User List') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-inline" role="form" id="form-searchuser">
                           <div class="form-group">
                               <label class="sr-only" for="kwtype">{{ __("Property") }}</label>
                               <select class="form-control" id="kwtype" name="kwtype">
                                   @foreach ( $userKwTypes as $value => $text)
                                       <option value="{{ $value }}" {{ $kwtype == $value ? 'selected':''}}>{{ __($text) }}</option>
                                   @endforeach
                               </select>
                           </div>
                            <div class="form-group">
                                <label class="sr-only" for="kwinput">{{ __('Keyword') }}</label>
                                <input class="form-control" name="kw" type="text" placeholder="{{ __('Keyword')}}" id="kwinput">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-theme" id="btn-search">{{ __('Search') }}</button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-theme"
                                    data-toggle="modal"
                                    id="btn-newuser"><i class="fa fa-plus"></i>{{ ' '.__('Create User') }}</button>
                            </div>
                        </form>
                    </div><!--/form-panel-->
	                <div class="form-panel">
                        <div id="userlist">

                            @include('admin.partial_sysuserlistpage')

                        </div>
                    </div><!--/form-panel-->
          		</div>
          	</div>
			<!--Confirm Modal -->
			<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Delete User')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div id="deluserinfopanel">
                        <form class="form-horizontal style-form" id="form-deluserinfo" action="">
                            @csrf
                            <input type="hidden" value="" name="userid" id="duid">
                        </form>
			            <p>{{ __('Are you sure to delete this user?')}}</p>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-danger" id="btn-deleteuser">{{ __('Delete') }}</button>
			      </div>
			    </div>
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
			            <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-primary" id="btn-saveuserinfo">{{ __('Save') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
			<!--Create User Modal -->
			<div class="modal fade" id="createuserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Create User')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div>
                        <div class="row centered">
						    <img src="assets/img/ui-zac.jpg" class="img-circle" width="50">
                            <p> </p>
                        </div>
						<div class="row">
                            <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                <form class="form-horizontal style-form" id="form-newuser" action="">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label toright" for="">{{ __("Email") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="email" placeholder="{{ __('Input Email Address')}}" type="text" requested>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="">{{ __("Name") }}</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" placeholder="{{ __('Input User Name')}}" type="text" requested>
                                        </div>
                                    </div>
                                </form>
                            </div>
					    </div>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-primary" id="btn-savenewuser">{{ __('Save') }}</button>
			      </div>
			    </div>
			  </div>
			</div>      				
		</section><!--/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box
    $('#btn-newuser').click(function (e) {
        e.preventDefault();
        $('#createuserModal').modal('show');    
    });

    $('#btn-deleteuser').click(function (e) {
        $data = $('#form-deluserinfo').serializeArray();
        $uid = $data[1].value;

        $.ajax({
            type:'POST',
            url :'/admin/delsysuser',
            data : $data,
        }).done(function (msg) {
            $tr = $('#user'+$uid);
            $tr.remove();
            $.gritter.add({
               title:"系统提示",
               text:"编号：" + msg + "<br />用户删除成功!",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        }).fail(function (data) {
            $.gritter.add({
               title:"系统提示",
               text:"删除用户失败",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });
    $('#btn-search').click(function (e) {
        e.preventDefault();
        $data = $('#form-searchuser').serializeArray();

        $.ajax({
            url :'/admin/sysuser',
            data : {
                cid:'userlist',
                kw:$('#kwinput')[0].value,
                kwtype:$('#kwtype')[0].value
            }
        }).done(function (data) {
            if (data.status == '000000') {
                window.location.href = window.location.origin + '/admin/login';    
            } else {
                $('#userlist').html(data);
            }
        }).fail(function () {
            $.gritter.add({
               title:"系统错误",
               text:"查找用户信息失败",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });

    $('#btn-saveuserinfo').click(function (e) {
        $data = $('#form-userinfo').serializeArray();
        $uid = $data[1].value;

        $.ajax({
            type:'POST',
            url :'/admin/savesysuserinfo',
            data : $data,
        }).done(function (msg) {
            $tds = $('#user'+$uid+'>td');
            $.each($data,function(){
                switch (this.name) {
                    case 'name':
                        $tds[1].textContent = this.value;
                        break;
                    case 'email':
                        $tds[2].textContent = this.value;
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

    $('#btn-savenewuser').click(function (e) {
        $data = $('#form-newuser').serializeArray();

        $.ajax({
            type:'POST',
            url :'/admin/addsysuser',
            data : $data,
        }).done(function (data) {
            $('#createuserModal').modal('hide');
            if (data.status == '000000') {
                window.location.href = window.location.origin + '/admin/login';    
            } else {
                $.gritter.add({
                   title:"系统提示",
                   text:"用户创建成功!<br>初始密码: " + data.msg,
                   image:'../assets/img/ui-danro.jpg',
                   sticky:true,
                   time:'' 
                });   
            }
        }).fail(function (data) {
            var data = JSON.parse(data.responseText);
            var detail = "";
            $.each(data.errors,function(k,v) {
               detail += v + '<br>'; 
            });
            $.gritter.add({
               title:"系统提示",
               text:"用户创建失败<br>" + '<br>' + detail,
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
