// Guarda en almacenamiento local la pestaña activada de la vista de equipos.

$(document).ready(function() {
   $('a[data-toggle=\"tab\"]').on('show.bs.tab', function (e) {
      localStorage.setItem('lastTab', $(this).attr('href'));
   });
   var lastTab = localStorage.getItem('lastTab');
   if (lastTab) {
      $('[href=\"' + lastTab + '\"]').tab('show');
   }
});
