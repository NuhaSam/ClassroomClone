@include('partial/header')
<div class="container" style="margin-top: 40px;">
<div class="row justify-content-between ">
@if($success)
  <div class="alert alert-success">
    {{$success}}
  </div>
  @endif
  @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p> {{ $error }}</p>
                    @endforeach
                    @endif
  <div >
    <a href="{{ route('classroom.create') }}" class="create-classroom-button btn btn-light" >
      <i class="fas fa-plus create-classroom-icon"></i>
      Create Classroom </a>
</div>
  @foreach($classrooms as $class)

 <div class="col-md-4">
    <div class="card" style="margin-top: 20px;">
      <img src="{{ asset('storage/'. $class->cover_image)}}"alt="">
      <div class="card-body">
        <h5 class="card-title">{{ $class->name }}</h5>
        <p class="card-title">{{ $class->subject }}</p>
        <div class="d-flex justify-content-between"> 
        <a href="{{ route('classrooms.view' , $class->id); }}" class="btn btn-primary">{{ __('View') }}</a>
    {{--   <a href="{{ route('topic.index',['classroom_id' => $class->id]) }}" class="btn btn-primary">Browse Topics </a>
      --}}  <a href="{{ route('classrooms.edit' , $class->id); }}" class="btn btn-dark">{{ __('Edit') }}</a>
      <form method="post" action="{{ route('classrooms.delete', $class->id ); }}">
          @csrf
          @method('delete')
          <button type="submit" name="delete" class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
      </div>
      </div>
    </div>
  </div>
  @endforeach
  <div style="margin-top: 30px;">
  {{ $classrooms->links() }}
</div></div>
</div>
<!-- <script>

fetch('/api/v1/classrooms')
  .then(res =>res.json())
  .then(json => {
    let ul = document.getElementById('classrooms')
    for(let i in json.data){
      ul.innerHTML += `<li>${json.data[i].name} </li>`
    }
  })
</script> -->
<style>
  .create-classroom-button {
    display: flex;
    align-items: center;
    padding: 10px;
    /* background-color: #007bff; */
    color: blue;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    width: 180px;
  }

  .create-classroom-icon {
    margin-right: 8px;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- <script>

  fetch('/api/v1/classrooms')
    .then(res =>res.json())
    .then(json => {
      let ul = document.getElementById('classrooms')
      for(let i in json.data){
        ul.innerHTML += `<li>${json.data[i].name} </li>`
      }
    })
</script> -->