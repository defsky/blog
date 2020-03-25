	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th>{{ __('ID') }}</th>
	                            <th>{{ __('Name') }}</th>
	                            <th>{{ __('Email') }}</th>
	                            <th>{{ __('Created At') }}</th>
	                            <th>{{ __('Updated At') }}</th>
	                            <th>{{ __('Actions') }}</th>
	                        </tr>
	                        </thead>
	                        <tbody>

                            @if (0 == sizeof($users))
                                <tr><td colspan="11" class="centered">{{ __('No Data') }}</td></tr>
                            @else
                                @foreach ($users as $user)

	                            <tr id="user{{ $user->id }}">
	                                <td>{{ $user->id }}</td>
	                                <td>{{ $user->name }}</td>
	                                <td>{{ $user->email }}</td>
	                                <td>{{ $user->created_at }}</td>
	                                <td>{{ $user->updated_at }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-xs btn-useredt"
                                            data-toggle="modal"
                                            data-target="#userinfoModal"
                                            data-id="{{ $user->id }}"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs btn-deluser"
                                            data-toggle="modal"
                                            data-target="#confirmModal"
                                            data-id="{{ $user->id }}"><i class="fa fa-trash-o"></i></button>
                                    </td>
	                            </tr>

                                @endforeach
                            @endif
	                        </tbody>
	                    </table>

                        {{ $users->onEachSide(5)->links() }}

  <script>
      //custom select box
    $('#userlist .btn-deluser').click(function (e) {
        $uid = $(this).data('id');
        $('#duid').val($uid);
    });

    $('#userlist .btn-useredt').click(function (e) {
        $uid = $(this).data('id');

        $.ajax({
            url :'/admin/sysuserinfo',
            data : {uid:$uid}
        }).done(function (data) {
            if (data.status == '000000') {
                window.location.href = window.location.origin + '/admin/login';    
            } else {
                $('#userinfopanel').html(data);
            }
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
     
    $('#userlist .pagination a').click(function (e) {
       e.preventDefault();
       var url=$(this).attr('href');

       $('#userlist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

       $.ajax({
           url :url,
           data : {
               cid:'userlist',
               @if ('' != $kw)
               kw:'{{ $kw }}',
               kwtype:'{{ $kwtype }}'
               @endif
           }
       }).done(function (data) {
            if (data.status == '000000') {
                window.location.href = window.location.origin + '/admin/login';    
            } else {
                $('#userlist').html(data);
            }
       }).fail(function () {
           $.gritter.add({
              title:'Server Error',
              text:'load table data failed',
              image:'../assets/img/ui-sam.jpg',
              sticky:false, 
              time:''
           });
       });
       
       //window.history.pushState("", "",url);
    });

     $(function(){
         $('select.styled').customSelect();
     });

  </script>
