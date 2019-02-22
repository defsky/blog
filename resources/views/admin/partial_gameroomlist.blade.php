	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th style="width:50px"><a class="btn btn-inverse btn-xs" id="selectall"><strong>{{ __('Select All') }}</strong></a></th>
	                            <th>{{ __('Room ID') }}</th>
	                            <th>{{ __('Room Name') }}</th>
	                            <th>{{ __('Room Type') }}</th>
	                            <th>{{ __('Room Owner') }}</th>
	                            <th>{{ __('Fee Count') }}</th>
                                <th>{{ __('Sponsor Fee') }}</th>
	                            <th>{{ __('Valid Member Count') }}</th>
	                            <th>{{ __('Current Members') }}</th>
	                            <th>{{ __('Game Server') }}</th>
	                            <th>{{ __('Start Time') }}</th>
	                            <th>{{ __('Room Status') }}</th>
	                            <th>{{ __('Actions') }}</th>
	                        </tr>
	                        </thead>
	                        <tbody>

                            @if (0 == sizeof($rooms))
                                <tr><td colspan="11" class="centered">{{ __('No Data') }}</td></tr>
                            @else
                                @foreach ($rooms as $room)

	                            <tr id="{{ $room->roomid }}">
                                    <td class="centered"><input class="rowselector" type="checkbox" value></td>
	                                <td>{{ $room->roomid }}</td>
	                                <td>{{ $room->name }}</td>
	                                <td>{{ $room->appid }}</td>
	                                <td>{{ $room->owner }}</td>
	                                <td>{{ $room->fee == 0 ? __('No Fee') : $room->fee.' '.__($room->fee_type) }}</td>
                                    <td>{{ $room->zanzhu_fee }}</td>
	                                <td>{{ $room->min_number.' - '.$room->max_number }}</td>
	                                <td>{{ $room->cur_number }}</td>
	                                <td>{{ $room->gameserver }}区</td>
	                                <td>{{ $room->time }}</td>
	                                <td>{{ $room->status }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs btn-deleteroom"
                                            data-toggle="modal"
                                            data-id="{{ $room->roomid }}"><i class="fa fa-trash-o"></i></button>
                                    </td>
	                            </tr>

                                @endforeach
                            @endif
	                        </tbody>
	                    </table>

                        {{ $rooms->onEachSide(5)->links() }}

  <script>
      //custom select box
    $.baglistIsAllSelected = false;
    $('#selectall').click(function (e) {
        $selectors = $('#gameroomlist table .rowselector');
        if ($.baglistIsAllSelected) {
            $selectors.each(function(){
                $(this).attr('checked', false); 
            });
            $.baglistIsAllSelected = false;
            $(this).removeClass('btn-success');
        } else {
            $selectors.each(function () {
                 $(this).attr('checked', true);   
             });
            $.baglistIsAllSelected = true;
            $(this).addClass('btn-success');
        }
    });

    $('#gameroomlist .btn-deleteroom').click(function (e) {
        $uid = $(this).data('id');
        
        $('#'+$uid+' input').attr('checked',true);
        $('#roomidcontainer').val($uid);
        $('#delroomConfirmModal').modal('show');
    });
     
    $('#gameroomlist .pagination a').click(function (e) {
       e.preventDefault();
       var url=$(this).attr('href');

       $('#giftbaglist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

       $.ajax({
           url :url,
           data : {
               cid:'gameroomlist',
               @if ('' != $kw)
               kw:'{{ $kw }}',
               kwtype:'{{ $kwtype }}'
               @endif
           }
       }).done(function (data) {
           $('#gameroomlist').html(data);
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
