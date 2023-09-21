@include('partial.header')
@include('partial/classroomHeader')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Notifications {{ $count }}
    </a>

    <ul>
        @foreach($notifications as $notification)
        <li><a class="dropdown-item" href="{{$notification->data['link']}}?nid={{$notification->id}}">
        @if($notification->unread())
        <b class="text-danger">*</b> 
        @endif      
        {{ $notification->data['body'] }}
                <br>
                <small class="text-muted"> {{ $notification->created_at->diffForHumans() }}</small>
            </a></li>
        @endforeach
    </ul>

</li>