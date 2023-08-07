@include('partial/header');
<div class="row">
@foreach($classrooms as $class) 
<div class="col-md-3" >
  <div class="card">
  <img src="" class="card-img-top" alt="">
  <div class="card-body">
     <h5 class="card-title">{{  $class->name }}</h5> 
     <p class="card-title">{{  $class->subject }}</p> 
     {{--   <a href=" {{ route('classroom.restore' , $class->id); }}" class="btn btn-primary">Restore</a>
    <a href=" {{ route('topic.index') }}" class="btn btn-primary">Browse Topics </a>
    <a href=" {{ route('classrooms.edit' , $class->id); }}" class="btn btn-primary">Edit</a> --}}
   <div class=" d-flex justify-content-between">
    <form method="post" action=" {{ route('classroom.restore' , $class->id); }}" >
      @csrf
      @method('put')
      <button type="submit" name="delete" class="btn btn-primary">Restore Classroom! </button>
    </form>

    <form method="post" action="{{ route('classroom.forceDelete', $class->id ); }}" >
      @csrf
      @method('delete')
      <button type="submit" name="delete" class="btn btn-danger">Delete Forever! </button>
    </form>
   </div>
  </div>
</div>
</div>
@endforeach 
</div>