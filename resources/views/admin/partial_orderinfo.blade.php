                                    <!--<div class="row centered">
                                        <p><b>{{ __('Order Number') }}</b></p>
							    	    <p><b>{{ __($order->trade_number) }}</b></p>
                                    </div>-->
							    	<div class="row">
                                        <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10">
                                            <form class="form-horizontal style-form" id="form-orderinfo" action="">
                                                @csrf
                                                <input type="hidden" name="orderid" value="{{ $order->trade_number}}">
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label toright" for="">{{ __("Order Number") }}</label>
                                                    <div class="col-sm-9">
                                                        <p class="form-control-static">{{ __($order->trade_number) }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label toright" for="">{{ __("Seller ID") }}</label>
                                                    <div class="col-sm-9">
                                                        <p class="form-control-static">{{ __($order->pay_phone_sell) }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Appeal Date") }}</label>
                                                    <div class="col-sm-9">
                                                        <p class="form-control-static">{{ date('Y-m-d H:i:s', strtotime($order->date)) }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Buyer ID") }}</label>
                                                    <div class="col-sm-9">
                                                        <p class="form-control-static">{{ __($order->pay_phone_buy) }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Order Count") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="ordercount" value="{{ __($order->coins)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Order Money") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="ordermoney" value="{{ __($order->money)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Appeal Content") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="appealcontent" value="{{ __($order->appeal_content)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Ali Order ID") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="aliorderid" value="{{ __($order->certificate)}}" type="text" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Order Status") }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="orderstatusselector" name="orderstatus">
                                                            @foreach ( $orderStatus as $value => $text)
                                                                <option value="{{ $value }}" {{ $order->appeal_status == $value ? 'selected':''}}>{{ $text }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="">{{ __("Deal Memo") }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" name="dealcomment" value="" placeholder="some memo ..." type="text" >
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
