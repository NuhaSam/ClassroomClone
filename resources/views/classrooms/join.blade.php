@include('partial/header');
<h1>Classroom Info</h1>
<div class="row">



    <!-- <div class="col md3"> -->
    <div class="col-md-9">

            <div class="border rounded p-3 text-center">
                
                <span class="text-success fs-3 "> <h2> {{ $classroom->name}}</h2> </span>
                <form action="{{ route('classrooms.joinStore',$classroom->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-primary" type="submit" name="submit" value="{{ $classroom->id }} ">Join</button>
                </form>
            </div>
        </div>
    
</div>
</div>