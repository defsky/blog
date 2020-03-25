	                    <table class="table table-hover">
	                        <thead>
	                        <tr>
	                            <th style="width:50px"><a class="btn btn-inverse btn-xs" id="selectall"><strong>{{ __('Select All') }}</strong></a></th>
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
                                    <td class="centered"><input class="rowselector" type="checkbox" value></td>
	                                <td>{{ $bag->code }}</td>
	                                <td>{{ $bag->name }}</td>
	                                <td>{{ __($bag->type) }}</td>
	                                <td>{{ number_format($bag->reward,4) }}</td>
	                                <td>{{ $bag->number }}</td>
	                                <td>{{ $bag->owner }}</td>
	                                <td>{{ __($bag->valid) }}</td>
	                                <td>{{ date('Y-m-d',strtotime($bag->beginDate)) }}</td>
	                                <td>{{ date('Y-m-d',strtotime($bag->endDate)) }}</td>
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

                        {{ $bags->onEachSide(5)->links() }}

  <script>
      //custom select box
    $.baglistIsAllSelected = false;
    $('#selectall').click(function (e) {
        $selectors = $('#giftbaglist table .rowselector');
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

    $('#giftbaglist .btn-deletebag').click(function (e) {
        $uid = $(this).data('id');
        
        $('#'+$uid+' input').attr('checked',true);
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
