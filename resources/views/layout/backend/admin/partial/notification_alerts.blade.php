<!-- <li>
    <a href="#" class="dropdown-toggle notification-icon btn-alert" data-toggle="dropdown" data-user="{{ $mails['user_id'] }}">
        <i class="fa fa-bell"></i>
        <span class="badge" id="badge-announcement">{{ ($mails['announcement_log'] != 0) ? $mails['announcement_log'] : '' }}</span>
    </a>

    <div class="dropdown-menu notification-menu">
        <div class="notification-title">
            <span class="pull-right label label-default">{{ $mails['amount_announcement'] }}</span>
            Announcements
        </div> 

        <div class="">
                @foreach ($mails['announcements'] as $row)
            <ul>
                @if($row->is_read != 0)
                    <li style="padding : 5px;" onclick="decreaseCounterAnnouncement('{{ $row->id }}','{{ $mails['user_id'] }}')">
                @else
                    <li style="background-color: #FFF;padding : 5px;" onclick="decreaseCounterAnnouncement('{{ $row->id }}','{{ $mails['user_id'] }}')">
                @endif
                    <a href="{{ route('hq-admin-message-center-announcements-details', ['id' => $row->id]) }}" class="clearfix">
                        <div class="image">
                            @if ($row->publish_status == 'info' || $row->publish_status == 'warning')
                                <i class="fa fa-{{ ($row->publish_status != null) ? $row->publish_status : 'info' }} bg-{{ ($row->publish_status != null) ? $row->publish_status : 'info' }}"></i>
                            @elseif ($row->publish_status == 'danger')
                                <i class="fa fa-times bg-danger"></i>
                            @elseif ($row->publish_status == 'success')
                                <i class="fa fa-check bg-success"></i>
                            @else
                                <i class="fa fa-info bg-info"></i>
                            @endif
                        </div>
                        <span class="title">{{ $row->title }}</span>
                        <span class="message">{{ $row->date_time }}</span>
                    </a>
                </li>
            </ul>
                @endforeach
        </div>
        <div style="padding : 5px;" class="text-right">
            <a href="{{ route('hq-admin-message-center-announcements') }}" class="view-more">View All</a>
        </div>
    </div>
</li>

<script>
    function decreaseCounterAnnouncement(id,idLog){            
        $.ajax({
            type: "POST",
            url: "{{ route('admin-message-center-post-counter-announcement')}}",
            data: {
                'id': id,
                'idLog' : idLog
            },
            dataType: 'json',
            success: function(response){
                
            }
        });
    }
</script> -->