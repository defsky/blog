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
                        </form>
                    </div><!--/form-panel-->
	                <div class="form-panel">
                        <div id="userlist">

                            @include('admin.partial_userlistpage')

                        </div>
                    </div><!--/form-panel-->
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
		</section><!--/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box
    $('#btn-search').click(function (e) {
        e.preventDefault();
        $data = $('#form-searchuser').serializeArray();

        $.ajax({
            url :'/admin/userlist',
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
            url :'/admin/saveuserinfo',
            data : $data,
        }).done(function (msg) {
            $tds = $('#user'+$uid+'>td');
            $.each($data,function(){
                switch (this.name) {
                    case 'phonenumber':
                        $tds[1].textContent = this.value;
                        break;
                    case 'nickname':
                        $tds[3].textContent = this.value;
                        break;
                    case 'creditlevel':
                        $tds[5].textContent = this.value;
                        break;
                    case 'activitycoin':
                        $tds[6].textContent = this.value;
                        break;
                    case 'originalcoin':
                        $tds[7].textContent = this.value;
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
