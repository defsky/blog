	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th>{{ __('Order Number') }}</th>
	                            <th>{{ __('Order Date') }}</th>
	                            <th>{{ __('Order Type') }}</th>
	                            <th>{{ __('Order Count') }}</th>
	                            <th>{{ __('Order Money') }}</th>
	                            <th>{{ __('Seller UUID') }}</th>
	                            <th>{{ __('Seller Nickname') }}</th>
	                            <th>{{ __('Buyer UUID') }}</th>
	                            <th>{{ __('Buyer Nickname') }}</th>
	                            <th>{{ __('Order Status') }}</th>
	                            <th>{{ __('Actions') }}</th>
	                        </tr>
	                        </thead>
	                        <tbody>

                            @if (0 == sizeof($orders))
                                <tr><td colspan="11" class="centered">{{ __('No Data') }}</td></tr>
                            @else
                                @foreach ($orders as $order)

	                            <tr id="{{ $order->trade_number }}">
	                                <td>{{ $order->trade_number }}</td>
	                                <td>{{ date('Y-m-d H:i:s',strtotime($order->date)) }}</td>
	                                <td>{{ $order->type }}</td>
	                                <td>{{ $order->coins }}</td>
	                                <td>{{ $order->money }}</td>
	                                <td>{{ $order->uuid_sell }}</td>
	                                <td>{{ $order->nick_name_sell }}</td>
	                                <td>{{ $order->uuid_buy }}</td>
	                                <td>{{ $order->nick_name_buy }}</td>
	                                <td>{{ $order->appeal_status }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-xs btn-orderedt"
                                            data-toggle="modal"
                                            data-target="#orderinfoModal"
                                            data-id="{{ $order->trade_number }}"><i class="fa fa-pencil"></i></button>
                                    </td>
	                            </tr>

                                @endforeach
                            @endif
	                        </tbody>
	                    </table>

                        {{ $orders->onEachSide(5)->links() }}

  <script>
      //custom select box

    $('#orderlist .btn-orderedt').click(function (e) {
        $uid = $(this).data('id');

        $.ajax({
            url :'/admin/orderinfo',
            data : {uid:$uid}
        }).done(function (data) {
            $('#orderinfopanel').html(data);
        }).fail(function () {
            $.gritter.add({
               title:"系统提示",
               text:"加载订单信息失败",
               image:'../assets/img/ui-danro.jpg',
               sticky:false,
               time:'' 
            });    
        });
    });
     
    $('#orderlist .pagination a').click(function (e) {
       e.preventDefault();
       var url=$(this).attr('href');

       $('#orderlist').append('\<div class="overlay"\> \<i class="fa fa-refresh fa-spin"\>\<\/i\> \<\/div\>');

       $.ajax({
           url :url,
           data : {
               cid:'orderlist',
           @if ('' != $kw)
               kw:'{{$kw }}',
               kwtype:'{{$kwtype }}'
           @endif
           }
       }).done(function (data) {
           $('#orderlist').html(data);
       }).fail(function () {
           $.gritter.add({
              title:'系统提示',
              text:'加载订单信息失败',
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
