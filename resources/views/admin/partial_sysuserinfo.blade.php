                                    <div class="row centered">
							    	    <img src="assets/img/ui-zac.jpg" class="img-circle" width="50">
							    	    <p><b>ID : {{ __($user->id) }}</b></p>
                                    </div>
							    	<div class="row">
                                        <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                            <form class="form-horizontal style-form" id="form-userinfo" action="">
                                                @csrf
                                                <input type="hidden" name="userid" value="{{ $user->id}}">
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label toright" for="">{{ __("Email") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="email" value="{{ __($user->email)}}" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Name") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="name" value="{{ __($user->name)}}" type="text">
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
