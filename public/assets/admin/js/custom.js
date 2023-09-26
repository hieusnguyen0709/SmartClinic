$('#check-all').click(function(e){
    var table = $(e.target).closest('table');
    $('td input:checkbox', table).prop('checked', this.checked);
});

// var check = document.getElementsByClassName("check-item");
// var i;
// for (i = 0; i < check.length; i++) {
//     check[i].addEventListener("click", function (event) {
//     const checkall = event.target.classList.contains('check-all-permission');
//     const uncheck = event.target.classList.contains('uncheck-all-permission');
//     var panel = this.nextElementSibling;
//     let inputs = panel.getElementsByTagName('input');
//     if (checkall) {
//       for (let c = 0; c < inputs.length; c++) {
//         inputs[c].disabled = false;
//         inputs[c].checked = true;
//       }
//     } else if (uncheck) {
//       for (let c = 0; c < inputs.length; c++) {
//         inputs[c].disabled = true;
//         inputs[c].checked = false;
//       }
//     } else {
//       this.classList.toggle("active");
//       if (panel.style.display === "block") {
//         panel.style.display = "none";
//       } else {
//         panel.style.display = "block";
//       }
//     }
//   });
// }