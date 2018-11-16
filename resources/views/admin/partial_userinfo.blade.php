                                    <div class="row centered">
							    	    <img src="assets/img/ui-zac.jpg" class="img-circle" width="50">
							    	    <p><b>{{ __($user->uuid) }}</b></p>
                                    </div>
							    	<div class="row">
                                        <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                            <form class="form-horizontal style-form" id="form-userinfo" action="">
                                                @csrf
                                                <input type="hidden" name="userid" value="{{ $user->number}}">
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label toright" for="">{{ __("Nickname") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="nickname" value="{{ __($user->nick_name)}}" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Name") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="name" value="{{ __($user->name)}}" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("ID Card Number") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="idcardnumber" value="{{ __($user->identity)}}" type="text" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Phone Number") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="phonenumber" value="{{ __($user->phone)}}" type="text" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Alipay ID") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="alipayid" value="{{ __($user->pay_email ? $user->pay_email : $user->pay_phone)}}" type="text" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Credit Level") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="creditlevel" value="{{ __($user->data->credit)}}" type="text" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Activity Coin") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="activitycoin" value="{{ __($user->data->activity_coin)}}" type="text" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Original Coin") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="originalcoin" value="{{ __($user->data->original_coin)}}" type="text" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Transaction Record") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" value="no data" type="text" disabled>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
							    	</div>
							    </div>

  <script>
      //custom select box
     
     $(function(){
         $('select.styled').customSelect();
     });

  </script>
