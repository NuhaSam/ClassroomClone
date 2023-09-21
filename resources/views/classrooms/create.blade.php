@include('../partial/header');

    <h1 style="margin-left: 7%;">Create room</h1>
    @if($errors->any())
    <div class="alert alert-danger ">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach

    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p> {{ $error }}</p>
                    @endforeach
                    @endif
                    
    </div>
    @endif
    <form action=" {{ route('classroom.add') }}" method="post" style="width: 70%;  margin-left:7% " enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="classroom name">
            <label for="name">Class name</label>
         
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ old('subject') }}"  name="subject" id="subject" placeholder="classroom subject">
            <label for="subject">Subject</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ old('section') }}" name="section" id="section" placeholder="section">
            <label for="section">Section</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ old('room') }}" name="room" id="room" placeholder="room">
            <label for="room">Room</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="Cover Image">
            <label for="cover_image">Image</label>
        </div>
       <button type="submit" name="create" class="btn btn-primary">Create Room</button>
    </form>
</body>

</html>