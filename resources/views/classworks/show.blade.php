@include('partial.header')

<div class="container">
    <h1> {{ $classroom->name }} # {{ $classroom->id}}</h1>
    <h3>{{ $classwork->title }}</h3>
    <hr>
    <div>
        {{ $classwork->description }}
    </div>

    <div class="row">
        <div class="col-md-8">

            <h3>Comments </h3>
            <form method="post" action="{{ route('comment.store')  }}">
                @csrf
                <div class="d-flex">
                    <div class="col-8">
                        <h5>Comments</h5>
                        <input type="hidden" name="id" value="{{ $classwork->id }}">
                        <input type="hidden" name="type" value="Classwork ">
                        <input type="textarea" class="form-control" name="content">
                    </div>
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p> {{ $error }}</p>
                    @endforeach
                    @endif
                </div>
                <div class="ms-1">
                    <input type="submit" name="submit" value="Comment">
                </div>
            </form>
            <div class="mt-4">
                @foreach($classwork->comments()->latest()->get() as $comment)
                <div class="row">
                    <div class="col-md-10">
                        <div class="border rounded p-2">
                            <img src="https://ui-avatars.com/api/{{$comment->user->name}}" width="40px" style="display: inline-flex;">
                            <p style="display: inline;"> 
                                {{ $comment->user?->name }} - Time: {{ $comment->created_at->diffForHumans(null,true,true) }}
                            </p>
                            <p style="margin-left: 50px; background-color:gainsboro; padding:1px;padding-left:5px"> {{$comment->content}} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            @if($success)
            <p class="alert alert-success"> {{$success }} </p>
            @endif
            @can('submissions.create',$classwork)

            <h5>
                Submissions
            </h5>
            @if($submissions->count())
            @foreach($submissions as $submission)
            <li>
                <a href="{{ route('submission.file',$submission) }}">File #{{ $loop->iteration }}</a>
            </li>
            @endforeach
            @endif
            <form method="post" action="{{ route('submission.store',$classwork) }}" enctype="multipart/form-data">
                @csrf
                <label>Upload File</label>
                <input type="file" name="files[]" multiple class="form-control">
                <button type="submit" name="submit" value="Upload" class="btn btn-outline-primary">Upload </button>
                @if($errors->any())
                @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @endif
            </form>
            @endcan
        </div>
    </div>