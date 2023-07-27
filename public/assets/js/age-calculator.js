const handler = {
    calculateAge: function(date_of_birth) {
        var today = new Date();
        var birthDate = new Date(date_of_birth);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;

        return age;
    },

    populateAge: function() {
        let birthdate = $('#birthdate').val();
        let age = handler.calculateAge(birthdate);

        localStorage['age'] = age;
        $('#age').val(age);
    }
}

$(document).ready(function() {
    if (!Date.parse($("#birthdate").val())) localStorage['age'] = '';

    if (localStorage['age'] !== '') $('#age').val(localStorage['age']);
});

// onchange="calculateAge()" 
$("#birthdate").on("change", handler.populateAge);