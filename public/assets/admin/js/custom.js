$('#check-all').click(function(e){
    var table = $(e.target).closest('table');
    $('td input:checkbox', table).prop('checked', this.checked);
});

var header = document.getElementsByClassName("header-permission");
for (var i = 0; i < header.length; i++) {
    header[i].addEventListener("click", function (e) {
    const check = e.target.classList.contains('check-all-permission');
    const uncheck = e.target.classList.contains('uncheck-all-permission');
    var body = this.nextElementSibling;
    let inputs = body.getElementsByTagName('input');

    if (check) {
      for (let j = 0; j < inputs.length; j++) {
        inputs[j].disabled = false;
        inputs[j].checked = true;
      }
    } else if (uncheck) {
      for (let j = 0; j < inputs.length; j++) {
        inputs[j].disabled = true;
        inputs[j].checked = false;
      }
    }
  });
}