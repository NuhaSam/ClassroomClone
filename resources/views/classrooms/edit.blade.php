@include('partial/header');

<h1 style="margin-left: 7%;">Update Room</h1>
    <form action=" {{ route('classrooms.update' , $classroom->id) }}" method="post" style="width: 70%;  margin-left:7% ">
    {{ csrf_field() }}
 @method('put')

        <div class="form-floating mb-3">
            <input type="text" class="form-control" value=" {{ $classroom->name }}" name="name" id="name" placeholder="classroom name">
            <label for="name">Class name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control"  value=" {{ $classroom->subject }}" name="subject" id="subject" placeholder="classroom subject">
            <label for="subject">Subject</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control"  value=" {{ $classroom->section }}" name="section" id="section" placeholder="section">
            <label for="section">Section</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control"  value=" {{ $classroom->room }}" name="room" id="room" placeholder="room">
            <label for="room">Room</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control"  value=" {{ $classroom->user_id }}" name="userID" id="userID" placeholder="User ID">
            <label for="userID">User ID</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control"  value=" {{ $classroom->cover_image }}" name="cover_image" id="cover_image" placeholder="Cover Image">
            <label for="cover_image">Image</label>
        </div>
       <button type="submit" name="create" class="btn btn-primary">Update Room</button>
    </form>
</body>

</html>