@include('partial/header')

<div class="row">
@foreach($topics as $topic) 
<div class="col-md-3">
  <div class="card">
    <p>HHH</p>
    <img src="" class="card-img-top" alt="">
    <div class="card-body">
      <h5 class="card-title">{{ $topic->name }}</h5>
      <p class="card-title">{{ $topic->subject }}</p>
     {{-- <a href=" {{ route('topic.view' , $topic->id); }}" class="btn btn-primary">View</a> --}}
      <a href=" {{ route('topic.edit' , $topic->id); }}" class="btn btn-primary">Edit</a>
      <form method="post" action="{{ route('topic.delete', $topic->id ); }}">
        @csrf
        @method('delete')
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
</div>
@endforeach
</div>