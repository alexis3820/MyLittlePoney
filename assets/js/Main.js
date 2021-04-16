$(document).ready(function() {

   $('#table1').DataTable({
      paging: false,
      "language": {
         "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
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
             function(data){
                data = $.parseJSON(data);
                console.log(data);
                $('.DataTr').html(data.HTMLHEAD);
                $('.DataTd').html(data.HTMLBODY);
                $('.modal-title-view').html(name);
             },
         error:
            function(){
            console.log('error AJAX');
            }
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

      $.ajax({
         url: '/Panel/deleteTable',
         type: 'POST',
         data: {
            getDelete: true,
            name: name
         },
         success:
             function(data){
                console.log(data);
             },
         error:
             function(){
                console.log('error AJAX');
             }
      })
   });
});