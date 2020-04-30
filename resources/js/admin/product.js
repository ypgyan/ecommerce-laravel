import Swal from 'sweetalert2';

$( "#removeButton" ).click(function() {
    let button = document.getElementById("removeButton");
    let product = button.getAttribute('data-product-id');
    let token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: 'Tem certeza?',
        text: "Essa ação não poder ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/product/' + product,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function(result) {
                    if (result.status) {
                        Swal.fire(
                            'Deletado!',
                            'Produto deletado com sucesso.',
                            'success'
                        ).then(() => {
                            window.location.href = '/admin/product';
                        })
                    } else {
                        Swal.fire(
                            'Falha ao deletar',
                            'Tente novamente mais tarde.',
                            'error'
                        )
                    }
                }
            });
        }
    })
});
