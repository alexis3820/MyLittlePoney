$(document).ready(function() {
   $('#table1').DataTable({
      bPaginate: false,
      dom: 'Bfrtip',
      buttons: [
         'copy',
         'csv'
      ],
      order: [[0, "desc"]],
      language: {
         processing: "Traitement en cours...",
         search: "Rechercher&nbsp;:",
         lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
         info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
         infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
         infoFiltered: "(filtr&eacute; sde _MAX_ &eacute;l&eacute;ments au total)",
         infoPostFix: "",
         loadingRecords: "Chargement en cours...",
         zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
         emptyTable: "Aucune donnée disponible dans le tableau",
         aria: {
            sortAscending: ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre dÃ©croissant"
         }
      }

   });

   $('.View').click(function() {
      var name = $(this).attr('id');

      $.ajax({
         url: '/Panel/myTable',
         type: 'POST',
         data: {
            getData: true,
            name: name
         },
         success:
             function(){
                console.log('OK');
             },
         error:
            function(){
            console.log('error AJAX');
            }
      })
   });

   $('.Delete').click(function() {
      var name = $(this).attr('id');

      $.ajax({
         url: '/Panel/deleteTable',
         type: 'POST',
         data: {
            getDelete: true,
            name: name
         },
         success:
             function(){
                console.log('OK');
             },
         error:
             function(){
                console.log('error AJAX');
             }
      })
   });
});