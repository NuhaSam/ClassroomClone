@include('partial/header')

<div class="row">
@foreach($topics as $topic) 
<div class="col-md-3">
  <div class="card">
    <img src="" class="card-img-top" alt="">
    <div class="card-body">
      <h5 class="card-title">{{ $topic->name }}</h5>
      <p class="card-title">{{ $topic->subject }}</p>
     {{-- <a href=" {{ route('topic.view' , $topic->id); }}" class="btn btn-primary">View</a> --}}
      <a href=" {{ route('topic.restoreTopic' , $topic->id); }}" class="btn btn-primary">Restore Topic</a>
      <form method="post" action="{{ route('topic.forceDeleteTopic', $topic->id ); }}">
        @csrf
        @method('delete')
        <button type="submit" name="delete" class="btn btn-danger">Delete Topic Forever! </button>
      </form>
    </div>
  </div>
</div>
@endforeach
</div>