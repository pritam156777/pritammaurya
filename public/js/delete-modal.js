$(document).ready(function () {

    $('.delete-btn').on('click', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');

        $('#deleteItemName').text(name);
        $('#deleteForm').attr('action', '/super-admin/categories/' + id);

        $('#deleteModal').fadeIn(200).removeClass('hidden');
    });

    $('#cancelDelete').on('click', function () {
        $('#deleteModal').fadeOut(200).addClass('hidden');
    });

    $('#deleteModal').on('click', function (e) {
        if (e.target.id === 'deleteModal') {
            $('#deleteModal').fadeOut(200).addClass('hidden');
        }
    });

});
