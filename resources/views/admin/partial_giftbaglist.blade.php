	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th>{{ __('Bag Code') }}</th>
	                            <th>{{ __('Bag Name') }}</th>
	                            <th>{{ __('Bag Type') }}</th>
	                            <th>{{ __('Bag Reward') }}</th>
	                            <th>{{ __('Bag Usable Times') }}</th>
	                            <th>{{ __('Bag Owner') }}</th>
	                            <th>{{ __('Is Valid') }}</th>
	                            <th>{{ __('Bag Begin Date') }}</th>
	                            <th>{{ __('Bag End Date') }}</th>
	                            <th>{{ __('Actions') }}</th>
	                        </tr>
	                        </thead>
	                        <tbody>

                            @if (0 == sizeof($bags))
                                <tr><td colspan="11" class="centered">{{ __('No Data') }}</td></tr>
                            @else
                                @foreach ($bags as $bag)

	                            <tr id="{{ $bag->code }}">
	                                <td>{{ $bag->code }}</td>
	                                <td>{{ $bag->name }}</td>
	                                <td>{{ __($bag->type) }}</td>
	                                <td>{{ number_format($bag->reward,4) }}</td>
	                                <td>{{ $bag->number }}</td>
	                                <td>{{ $bag->owner }}</td>
	                                <td>{{ __($bag->valid) }}</td>
	                                <td>{{ $bag->beginDate }}</td>
	                                <td>{{ $bag->endDate }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-xs btn-deletebag"
                                            data-toggle="modal"
                                            data-id="{{ $bag->code }}"><i class="fa fa-trash-o"></i></button>
                                    </td>
	                            </tr>

                                @endforeach
                            @endif
	                        </tbody>
	                    </table>


  <script>
      //custom select box

    $('#giftbaglist .btn-deletebag').click(function (e) {
        $uid = $(this).data('id');

        $('#bagidcontainer').val($uid);
        $('#delbagConfirmModal').modal('show');
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
