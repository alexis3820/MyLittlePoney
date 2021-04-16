$(document).ready(function() {

   $('#table1').DataTable({
      paging: false,
      "language": {
         "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
      }
   });

    $('#modalView').on('show', function() {
        $(this).removeData('modal');
    });


   $('.View').click(function() {
      var name = $(this).attr('id');
      $.ajax({
         url: '/Panel/myTable',
         type: 'POST',
         data: {
             getData: true,
             getColumn: true,
            name: name
         },
         success:
             function(data){
                data = $.parseJSON(data);
                 $('.modal-title-view').html(name);
                $('.DataTr').html(data.HTMLHEAD);
                $('.DataTd').html(data.HTMLBODY);
                 $('#editTable').dataTable( {
                     paging: false,
                     searching: true,
                     retrieve: true,
                     bInfo : false,
                     "language": {
                         "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
                     }
                 } );
             },
         error:
            function(){
            console.log('error AJAX');
            },

      })
   });

   $('.Edit').click(function() {
      var name = $(this).attr('id');

      $.ajax({
         url: '/Panel/getTableName',
         type: 'POST',
         data: {
            getData: true,
            name: name
         },
         success:
             function(data){
                $("#newTable").val(data);
                $("#oldTable").val(data);
             },
         error:
             function(){
                console.log('error AJAX');
             }
      })
   });


   $('.Delete').click(function() {
      var name = $(this).attr('id');
      var result = confirm("Voulez-vous vraiment supprimer la table " + name);

      if(result === true) {
          $.ajax({
              url: '/Panel/deleteTable',
              type: 'POST',
              data: {
                  getDelete: true,
                  name: name
              },
              success:
                  function (data) {
                      console.log(data);
                  },
              error:
                  function () {
                      console.log('error AJAX');
                  }
          })
      }
   });
});