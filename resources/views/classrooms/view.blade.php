@include('partial/header')
@include('partial/classroomHeader')

<div class="container">
    <div class="row border rounded p-2 text-center">

        <img src="{{ asset('storage/'. $classroom->cover_image)}}" alt="" style="border-radius: 30px;">
        <div class="row">
            <div class="col-md-3 " style="margin-top: 10px;">
                <div class="border rounded p-2 text-center">
                    <span class="text-light-dark fs-6">Classroom Code</span>
                    <span class="text-success fs-3 "> {{ $classroom->code }}</span>
                <div>
                    <h6> Invitation Link </h6>
                    <input type="hidden" id="invitation_link" value="{{ $invitation_link }}">
                    <button onclick="copy()" value="{{ $invitation_link }}" class="btn btn-outline-success" id="">Copy Invitation Link</button>
                </div>
            </div>
            </div>
            <div class="col md-8">

                <h2> {{ $classroom->name}}</h2>
                <h5> {{ $classroom->subject}}</h5>
            </div>

        </div>
    </div>

    <script>
        function copy() {
            var copyText = document.getElementById("invitation_link");
            copyText.select();
            navigator.clipboard.writeText(copyText.value);
            alert("Invitation Link copied successfully");
        }
    </script>