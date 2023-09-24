$('#check-all').click(function(e){
    var table = $(e.target).closest('table');
    $('td input:checkbox', table).prop('checked', this.checked);
});