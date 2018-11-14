                                    <div class="row centered">
							    	    <img src="assets/img/ui-zac.jpg" class="img-circle" width="50">
							    	    <p><b>{{ __($user->uuid) }}</b></p>
                                    </div>
							    	<div class="row">
                                        <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                            <form class="form-horizontal style-form" action="">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Nickname") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->nick_name)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Name") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->name)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("ID Card Number") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->identity)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Phone Number") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->phone)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Ali ID") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->pay_email)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Credit Level") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->data->credit)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Activity Coin") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->data->activity_coin)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Original Coin") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="{{ __($user->data->original_coin)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="">{{ __("Transaction Record") }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" placeholder="no data" type="text" disabled>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
							    	</div>
							    </div>

  <script>
      //custom select box

    $('#btn-saveuserinfo').click(function (e) {
        $uid = $(this).data('id');

        $.ajax({
            type:'POST'
            url :'/admin/saveuserinfo',
            data : {uid:$uid},
        }).done(function (data) {
            $('#userinfopanel').html(data);
        }).fail(function () {
            $.gritter.add({
               title:"系统错误",
               text:"加载用户信息失败",
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
