@include('partial.header')

@section('content')
<div class="container">
  <h3>
    Classwork
    @can('classworks.create',$classroom)
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        + create
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('classroom.classworks.create', [$classroom->id , 'type' => 'assignment']) }}">Assignment</a></li>
        <li><a class="dropdown-item" href="{{ route('classroom.classworks.create', [$classroom->id , 'type' => 'material']) }}">Material</a></li>
        <li><a class="dropdown-item" href="{{ route('classroom.classworks.create', [$classroom->id , 'type' =>  'question']) }}">Question</a></li>
      </ul>
    </div>
    @endcan
  </h3>

  <form class="row row-cols-lg-auto g-3 align-items-center" method="get" action="{{ route('classroom.classworks.index',$classroom) }}">
    <div class="col-12">
      <input type="text" name="search" class="form-control" placeholder="search">
    <!-- </div>
    <div class="col-12"> -->
      <button type="submit" name="submit" class="btn btn-primary ms-2">Search</button>
    </div>
  </form>
  <div class="accordion accordion-flush" id="accordionFlushExample">

    @forelse($classworks as $classwork)

    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-heading{{$classwork->id}}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$classwork->id}}" aria-expanded="false" aria-controls="flush-collapse{{$classwork->id}}">
          {{ $classwork->title }} / {{ $classwork->type }}
        </button>
      </h2>
      <div id="flush-collapse{{$classwork->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$classwork->id}}" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
          <p> {{ $classwork->description }} </p>

          <a class="btn btn-sm btn-outline-success" href="{{ route('classroom.classworks.edit',[ $classroom, $classwork ]) }}">Edit</a>
          <a class="btn btn-sm btn-outline-dark" href="{{ route('classroom.classworks.show',[ $classroom, $classwork ]) }}">Show</a>
       

        </div>
      </div>
    </div>

    @empty
    <p>No Classwork Found.</p>
    @endforelse
  </div>
  {{ $classworks->withQueryString()->links() }}