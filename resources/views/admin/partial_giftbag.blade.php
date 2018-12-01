          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('Gift Bag Manage') }}</h3>
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
                                <a class="btn btn-theme" href="/admin/giftcodeexport">{{ __('Export List').' '}}<i class="fa fa-download"></i></a>
                                <!--<button class="btn btn-theme pull-right" id="btn-exportcodes">{{ __('Export List').' ' }}<i class="fa fa-download"></i></button>-->
                            </div>
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
			<!--Confirm Modal -->
			<div class="modal fade" id="delbagConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">{{ __('Delete Giftbag')}}</h4>
			      </div>
			      <div class="modal-body">
                    <div id="delbaginfopanel">
                        <form class="form-horizontal style-form" id="form-delbaginfo" action="">
                            @csrf
                            <input type="hidden" value="" name="codes" id="bagidcontainer">
                        </form>
			            <p>{{ __('Are you sure to delete selected giftbags?')}}</p>
                    </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
			        <button type="button" class="btn btn-danger" id="btn-dodeletebag">{{ __('Delete') }}</button>
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
        $('#bagidcontainer').val($values);
        $('#giftbaglist table .rowselector').each(function () {
            if ($(this).is(':checked')) {
           if ($values != "") {
                $values += ':';   
            }
            $values += $(this).parent().parent().attr('id');
            }
        });
        $('#bagidcontainer').val($values);

        if ($values != "") {
            $('#delbagConfirmModal').modal('show');
        }
    });

    $('#btn-exportcodes').click(function (e) {
        e.preventDefault();
        var url = '/admin/giftcodeexport';

        if ($.isIE()) {
            $.ieDown(window.location.origin + url);
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.responseType = "blob";
            xhr.onload = function () {
                if (this.status === 200) {
                    var blob = this.response;
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onload = function (e) {
                        var a = document.createElement('a');
                        a.download = '礼包码.xlsx';
                        a.href = e.target.result;
                        $('body').append(a);
                        a.click();
                        $(a).remove();    
                    }    
                }    
            }
            xhr.send();
        }
    });

    $('#btn-dodeletebag').click(function (e) {
        e.preventDefault();
        $('#delbagConfirmModal').modal('hide');    
        $data = $('#form-delbaginfo').serializeArray();

        $.ajax({
            type:'POST',
            url :'/admin/deletegiftbag',
            data : $data,
        }).done(function (data) {
            if (data.status == "000000") {
                window.location.href = window.location.origin + '/admin/login';
            } else {
                if (data.ret == 0) {
                    $rid = $('#bagidcontainer')[0].value;
                    $.each($rid.split(':'),function(k,v){
                       $('#'+v).remove(); 
                    });

                    $.gritter.add({
                       title:"系统提示",
                       text:"礼包删除成功!<br>"+data.msg ,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                } else {
                    $.gritter.add({
                       title:"系统提示",
                       text:"礼包删除失败!<br>" + data.msg,
                       image:'../assets/img/ui-danro.jpg',
                       sticky:false,
                       time:'' 
                    });   
                }
            }
        }).fail(function (data) {
            $.gritter.add({
               title:"系统提示",
               text:"礼包删除失败<br>" ,
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });

    $('#btn-createbag').click(function (e) {
        e.preventDefault();
        $('#createbagModal').modal('show');    
    });

    $('#btn-createnewbag').click(function (e) {
        $(this).attr('disabled',true);
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
        $(this).attr('disabled',false);
    });
      $(function(){
          $('select.styled').customSelect();
      });

  </script>
