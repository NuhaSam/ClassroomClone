@include('partial/header');
<div class="row">
@foreach($classrooms as $class) 
<div class="col-md-3" >
  <div class="card">
  <img src="" class="card-img-top" alt="">
  <div class="card-body">
     <h5 class="card-title">{{  $class->name }}</h5> 
     <p class="card-title">{{  $class->subject }}</p> 
    <a href=" {{ route('classrooms.view' , $class->id); }}" class="btn btn-primary">View</a>
    <a href=" {{ route('topic.index') }}" class="btn btn-primary">Browse Topics </a>
    <a href=" {{ route('classrooms.edit' , $class->id); }}" class="btn btn-primary">Edit</a>
    <form method="post" action="{{ route('classrooms.delete', $class->id ); }}" >
      @csrf
      @method('delete')
      <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </form>
  </div>
</div>
</div>
@endforeach 
</div>