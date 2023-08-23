@include('partial.header')

<div class="container">
    <h1> {{ $classroom->name }} # {{ $classroom->id}}</h1>
    <h3>Update Classwork</h3>
    <hr>
    <form method="post" action="{{ route('classroom.classworks.update',[$classroom->id, $classwork->id , 'type'=> $type ])  }}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-8">
                <label for="title">Classwork Title</label>
                <input type="text" class="form-control"  name="title" value="{{$classwork->title }}" placeholder="Classwork Title">

                <label for="description">Classwork Description (Optional)</label>
                <input type="textarea" class="form-control" name="description" value="{{$classwork->description }}" >

                <label class="" >Topic</label>
                <select class="form-select" aria-label="Default select example" name="topic_id" id="topic_id">

               <option value="">No topics</option>
                    @foreach($classroom->topics as $topic)
                    <option value="{{$topic->id}}" @selected($topic->id == $classwork->topic_id ) >{{ $topic->name }}</option>
                    @endforeach  
                </select>
                <label>Published Date</label>
                <input type="date" class="form-control" name="published_date" value="{{ $classwork->published_date }}" >
                
            </div>
            <div class="col md-4">
                @foreach($classroom->students as $student )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="students[]" value="{{ $student->id }}" 
                            id="std-{{$student->id}}" @checked(in_array($student->id,$assigned))>
                    <label class="form-check-label" for="std-{{$student->id}}">
                    {{$student->name}} // {{ $student->id }}
                    </label>
                </div>
                @endforeach
                <br>
                @if($type == 'assignment')
                <label >Grade</label>
                <input type="number" class="form-control" name="grade" value="{{ $classwork->options['grade'] }}" placeholder="grade" >
                <label>Due</label>
                <input type="date" class="form-control" name="due" value="{{ $classwork->options['due'] }}" >
                @endif
            </div>
        </div>

<br>
        <input type="submit" name="submit" class="btn btn-primary" value="Update Classwork">

    </form>