import Echo from 'laravel-echo';
import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
if(classroomId){
Echo.private('classroom.' + classroomId)
    .listen('.classwork-created', function (event){
        alert("LL");
    });
}
Echo.private('App.Models.User.'+userId)
    .notification(function(event){
        alert(event.body);
    })