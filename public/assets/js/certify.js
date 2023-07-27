$('#submit-btn').on('click', function (e) {
    if (! $('#certify').is(':checked')) {
        $('#confirmModal').modal('show');

        e.preventDefault();
        return false;
    }
});


