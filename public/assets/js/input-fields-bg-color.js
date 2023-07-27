var selects = document.querySelectorAll('select');

selects.forEach(element => {
    if (element.value !== '') element.style.background = "#E9E9E9";
});

$('select').on('change', function(e) {
    if (this.value !== '') $(this).css("background", "#E9E9E9");
});