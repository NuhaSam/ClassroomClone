@include('partial/header');
<h1 style="margin-left: 7%;">Create Topic</h1>
    <form action=" {{ route('topic.add') }}" method="post" style="width: 70%;  margin-left:7% ">
    {{ csrf_field() }}
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="classroom name">
            <label for="name">Class name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="classroom_id" id="classroom_id" placeholder="classroom ID">
            <label for="classroom_id">Classroom ID</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID">
            <label for="user_id">user ID</label>
        </div> 
         </div>
       <button type="submit" name="create" class="btn btn-primary">Create Topic</button>
    </form>