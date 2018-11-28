	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th>{{ __('Bag ID') }}</th>
	                            <th>{{ __('Bag Name') }}</th>
	                            <th>{{ __('Bag Duration') }}</th>
	                            <th>{{ __('Usable Times') }}</th>
	                            <th>{{ __('Actions') }}</th>
	                        </tr>
	                        </thead>
	                        <tbody>

                            @if (0 == sizeof($bags))
                                <tr><td colspan="11" class="centered">{{ __('No Data') }}</td></tr>
                            @else
                                @foreach ($bags as $bag)

	                            <tr id="user{{ $user->number }}">
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
                            @endif
	                        </tbody>
	                    </table>


  <script>
      //custom select box

    $('#giftbaglist .btn-bagedt').click(function (e) {
        $uid = $(this).data('id');

        $.ajax({
            url :'/admin/giftbaginfo',
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
     
    $('#giftbaglist .pagination a').click(function (e) {
       e.preventDefault();
       var url=$(this).attr('href');

       $('#giftbaglist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

       $.ajax({
           url :url,
           data : {
               cid:'giftbaglist',
               @if ('' != $kw)
               kw:'{{ $kw }}',
               kwtype:'{{ $kwtype }}'
               @endif
           }
       }).done(function (data) {
           $('#giftbaglist').html(data);
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
