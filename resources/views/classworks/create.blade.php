@include('partial.header')

<div class="container">
    <h1> {{ $classroom->name }} # {{ $classroom->id}}</h1>
    <h3>Create Classwork</h3>
    <hr>

    @if($error)
    <p> {{ $error }}</p>
    @endif

    <form method="post" action="{{ route('classroom.classworks.store',[$classroom->id , 'type'=> $type ])  }}">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <label for="title">Classwork Title</label>
                <input type="text" class="form-control" name="title" placeholder="title">

                <label for="description">Classwork Description (Optional)</label>
                <input type="textarea" placeholder="description" class="form-control" name="description">

                <label>Topic</label>
                <select class="form-select" aria-label="Default select example" name="topic_id" id="topic_id">

                    <option value="">No topics</option>
                    @foreach($classroom->topics as $topic)
                    <option value="{{$topic->id}}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col md-4">
                @foreach($classroom->students as $student )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="students[]" value="{{ $student->id }}" id="std-{{$student->id}}" checked>
                    <label class="form-check-label" for="std-{{$student->id}}">
                        {{$student->name}}
                    </label>
                </div>
                @endforeach
                <br>
                @if($type == 'assignment')
                <label>Grade</label>
                <input type="number" class="form-control" placeholder="grade" name="grade">
                <label>Due</label>
                <input type="date" class="form-control" name="due">
                @endif
            </div>

        </div>


        <input type="submit" name="submit" class="btn btn-primary" value="Create Classwork">

    </form>