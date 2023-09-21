@include('../partial/header');
<div class="container"> 
    <h1>{{ $classroom->name }} - Chat Room</h1> 
 
    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p> {{ $error }}</p>
                    @endforeach
                    @endif
                    

    <div class="row"> 
        <div class="col-md-3"> 
            <div class="border rounded p-3 text-center"> 
 
            </div> 
        </div> 
        <div class="col-md-9"> 
            <div id="messages" class="border rounded bg-light p-3 mb-3"> 
 
            </div> 
            <form class="row g-3 align-items-center" action="{{ route('classroom.messages.store',$classroom) }}" method="post"> 
            @csrf    
            <div class="col-9"> 
                    <label class="visually-hidden" for="body">Username</label> 
                    <div class="input-group"> 
                        <div class="input-group-text"></div> 
                        <textarea class="form-control" name="body" id="body" 
                            placeholder="Type your message.."></textarea> 
                    </div> 
                </div> 
                <div class="col-3"> 
                    <button type="submit" class="btn btn-primary">Send dd</button> 
                </div> 
            </form> 
        </div> 
    </div> 
</div> 
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>    
const messages = {
        list_url : " {{ route('classroom.messages.index' , [$classroom->id] )}} ",
        store_url : " {{ route('classroom.messages.store' , [$classroom->id] )}}",
        }
        const csrf_token = " {{ csrf_token()}}" ;
        const user = { 
            name: " {{ Auth::user()->name }}" };

        const classroom = " {{ $classroom->id }}"
</script>
@vite(['resources/js/chat.js'])
        @endpush