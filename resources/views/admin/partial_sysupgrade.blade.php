          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> {{ __('System Upgrade') }}</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal style-form">
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 control-label">{{ __('Select Upgrade Package') }}</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patchfilename" type="file" placeholder="{{ __('Select File Tarball Upgrade')}}" id="patchfile">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 control-label">{{ __('Authentication Code') }}</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="xtoken" type="password" placeholder="{{ __('Input Authentication Code')}}" id="acode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 control-label"></label>
                                <button class="btn btn-danger" id="btn-upgrade" disabled>{{ __('Start Upgrade') }}</button>
                            </div>
	      				<div class="progress progress-striped active">
						  <div class="progress-bar" id="progressBar"  role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
						    <span class="sr-only">45% Complete</span>
						  </div>
						</div>
                        </form>
                        <div id="message"></div>
                    </div><!-- / form-panel -->
          		</div>
          	</div>
			
		</section><! --/wrapper -->

    <!--script for this page-->
    
  <script>
      //custom select box
      $('#patchfile').change(function(e){
        $('#progressBar')[0].style.width = '0%';    
        $('#message').html('');
            
        var isBtnDisabled = true;

        if ($('#patchfile')[0].files[0]) {
            if ($('#acode').val()) {
                isBtnDisabled = false;
            }
        }
        $('#btn-upgrade').attr('disabled', isBtnDisabled);
    });

      $('#acode').change(function(e){
          var isBtnDisabled = true;

          if ($(this).val()) {
              if ($('#patchfile')[0].files[0]) {  
                isBtnDisabled = false;
              }
          }
          $('#btn-upgrade').attr('disabled', isBtnDisabled);
      });

    $('#btn-upgrade').click(function(e) {
        e.preventDefault();
        
        if ($('#acode').val() == '') {
            alert("必须输入授权码");
            return;    
        }
        var fileObj = $('#patchfile')[0].files[0];
        if (!fileObj) {
            alert('请选择文件');    
            return;
        }

        var fileForm = new FormData();
        fileForm.append("patchfile",fileObj);            
        fileForm.append("_token",$('meta[name="csrf-token"]').attr('content'));            
        fileForm.append("xtoken",$('#acode').val());            

        var xhr = new XMLHttpRequest();
        xhr.open('post','/admin/dosysupgrade',true);
        xhr.onreadystatechange=function(){
            if(this.readyState==4) {
                if (this.status == 200) {
                    var data = JSON.parse(this.response);
                    if (data.ret == 0) {
                        $('#message').append('更新完成<br>');    
                        
                    } else {
                        $('#progressBar')[0].style.width = '0%';    
                        switch (data.ret) {
                            case -1:
                                alert('Error Message : ' + data.msg);
                                break;
                            case -2:
                                alert('Error Message : ' + data.msg);
                                break;
                            default:
                                alert(data.msg);
                        }
                    }
                }

            }    
        };
        xhr.upload.onprogress=function(e) {
            if(e.lengthComputable){
                var percent = 100 * e.loaded / e.total;
                console.log(percent);
                $('#progressBar')[0].style.width = percent+'%';    
                if(percent == 100) {
                    //$('#message').append('更新完成');    
                }
            }
        }
        xhr.send(fileForm);

        //$.ajax({
        //    type:'POST',
        //    url:'/admin/dosysupgrade',
        //    data:fileForm,
        //    processData:false,
        //    contentType:false,
        //}).done(function(data){
        //    alert("Upgrade success");
        //}).fail(function(data){
        //    
        //});
    });

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
