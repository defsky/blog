	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th>{{ __('UUID') }}</th>
	                            <th>{{ __('Phone Number') }}</th>
	                            <th>{{ __('Invite Code') }}</th>
	                            <th>{{ __('Nickname') }}</th>
	                            <th>{{ __('User Type') }}</th>
	                            <th>{{ __('Credit Level') }}</th>
	                            <th>{{ __('Activity Coin') }}</th>
	                            <th>{{ __('Original Coin') }}</th>
	                            <th>{{ __('Activity Value') }}</th>
	                            <th>{{ __('Yesterday Activity') }}</th>
	                            <th>{{ __('Actions') }}</th>
	                        </tr>
	                        </thead>
	                        <tbody>

                            @foreach ($users as $user)

	                        <tr>
	                            <td>{{ $user->uuid }}</td>
	                            <td>{{ $user->phone }}</td>
	                            <td>{{ $user->invate_code }}</td>
	                            <td>{{ $user->nick_name }}</td>
	                            <td>{{ $user->user_type }}</td>
	                            <td>{{ $user->data->credit }}</td>
	                            <td>{{ $user->data->activity_coin }}</td>
	                            <td>{{ $user->data->original_coin }}</td>
	                            <td>{{ $user->data->activity }}</td>
	                            <td>{{ $user->data->yesterday_activity }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs btn-useredt"
                                        data-toggle="modal"
                                        data-target="#userinfoModal"
                                        data-id="{{ $user->number }}"><i class="fa fa-pencil"></i></button>
                                </td>
	                        </tr>

                            @endforeach

	                        </tbody>
	                    </table>

                        {{ $users->onEachSide(5)->links() }}

  <script>
      //custom select box

    $('#userlist .btn-useredt').click(function (e) {
        $uid = $(this).data('id');

        $.ajax({
            url :'/admin/userinfo',
            data : {uid:$uid}
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
     
    $('#userlist .pagination a').click(function (e) {
       e.preventDefault();
       var url=$(this).attr('href');

       $('#userlist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

       $.ajax({
           url :url,
           data : {cid:'userlist'}
       }).done(function (data) {
           $('#userlist').html(data);
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
