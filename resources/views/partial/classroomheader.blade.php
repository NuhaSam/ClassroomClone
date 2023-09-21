<nav class="navbar navbar-expand-lg topnav">
    <a class="navbar-brand" href="{{ route('classroom.classworks.index',$classroom->id) }}" style="margin-left: 700px; color:green">Classworks</a>
    <a class="navbar-brand" style="color:green">assignment</a>
    <a class="navbar-brand" style="color:green" href="{{route('classrooms.people',$classroom->id) }}">People</a>
    <a class="navbar-brand" style="color:green" href="{{route('classroom.notifications',$classroom->id) }}">Notifications</a>
</nav>
<hr>

<style>
    a:hover {
  background-color: 	#F0F0F0;
  border-bottom: lawngreen;
}

.topnav {
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  display: block;
  color: #f0f0f0;
  text-align: center;
  text-decoration: none;
  font-size: 17px;
  border-bottom: 3px solid transparent;
  padding:0;
  
}

.topnav a:hover {
  border-bottom: 3px solid green;
}

.topnav a:active {
  border-bottom: 3px solid green;
}

    </style>

