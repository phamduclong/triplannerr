<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>@lang('labels.backend.access.book_information.table.id')</th>
        <th>@lang('labels.backend.access.book_information.table.title')</th>
        <th>@lang('labels.backend.access.book_information.table.report_user')</th>
        <th>@lang('labels.backend.access.book_information.table.report_user_email')</th>
        <th>@lang('labels.backend.access.book_information.table.request_user')</th>
        <th>@lang('labels.backend.access.book_information.table.request_user_email')</th>
        <th>@lang('labels.backend.access.book_information.table.date')</th>
        <th>@lang('labels.backend.access.book_information.table.status')</th>
     </tr>
    </thead>
    <tbody>
    
       @foreach($bookdata as $key => $book)
          <tr>
            <td>{{ $key+1}}</td>
            <td>{{ isset( $book ) ? @getreport_data($book->report_id)->title  : '' }}</td>
            <td>{{ isset( $book ) ? @getuser_data(getreport_data($book->report_id)->user_id)->user_name : '' }}</td>
            <td>{{ isset( $book ) ? @getuser_data(getreport_data($book->report_id)->user_id)->email : '' }}</td>
            <td>{{ isset( $book ) ? @getuser_data($book->user_id)->user_name  : '' }}</td>
            <td>{{ isset( $book ) ? @getuser_data($book->user_id)->email  : '' }}</td>
            <td>{{ date('m-d-Y', strtotime(isset( $book ) ? $book->created_at  : '')) }}</td>
            <td><?php if($book->status==0){ ?>
                    <a href="{{ route('admin.book_information.status_book', $book) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                    <?php } 
                    else{ ?>
                    <a href="{{ route('admin.book_information.status_book', $book) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                <?php } ?></td>
           </tr>
         
        @endforeach
    </tbody> 
</table>