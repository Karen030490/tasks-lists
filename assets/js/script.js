$(document).ready(function () {


    $('#logout').click(function () {
        localStorage.removeItem('hopeToken');
        localStorage.removeItem('userData');
        window.location.href = base_url + "index.php";
    });


});

function toggleNewTask(){
    $('.add-new-task').slideToggle();
}
