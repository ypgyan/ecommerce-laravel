import Swal from 'sweetalert2';

$( "#removeUser" ).click(function() {
    let button = document.getElementById("removeUser");
    let user = button.getAttribute('data-user-id')
    Swal.fire(
        'Good job!',
        'user ID: ' + user,
        'success'
    )
});
