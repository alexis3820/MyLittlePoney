$(document).ready(function() {


    var firstSQL = 0;
    var secondSQL = 10;

    $('#table1').DataTable({
      paging: false,
      "language": {
         "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
      }
   });

    $('#modalView').on('show', function() {
        $(this).removeData('modal');
    });

    $('.View').click(function () {

        var name = $(this).attr('id');
        $.ajax({
            url: '/Panel/myTable',
            type: 'POST',
            data: {
                getData: true,
                getColumn: true,
                name: name,
                firstSQL: firstSQL,
                secondSQL: secondSQL
            },
            success:
                function (data) {
                    data = $.parseJSON(data);
                    $('.modal-title-view').html(name);
                    $('.DataTr').html(data.HTMLHEAD);
                    $('.DataTd').html(data.HTMLBODY);
                    $('.ButtonClass').html(data.NEXTBUTTON);
                    $('.nbTable').html(data.NUMBER);
                    $('.precButton').addClass('disabled');
                    $('#editTable').dataTable({
                        paging: false,
                        searching: true,
                        retrieve: true,
                        bInfo: false,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
                        }
                    });
                },
            error:
                function () {
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

    $('body').delegate('.EditData','click',function (){
        var id = $(this).attr('id');
        var table = $(this).attr('mytable');
        $.ajax({
            url: '/Panel/getDataFromTable',
            type: 'POST',
            data: {
                getData: true,
                getColumn: true,
                id: id,
                table: table
            },
            success:
                function (data) {
                    data = $.parseJSON(data);
                    console.log(data);
                    $('#form-edit-data').html(data);
                },
            error:
                function () {
                    console.log('error AJAX');
                },

        })
    })

    $('body').delegate('.EditData','click',function (){
        var id = $(this).attr('id');
        var table = $(this).attr('mytable');
        $.ajax({
            url: '/Panel/getDataFromTable',
            type: 'POST',
            data: {
                getData: true,
                getColumn: true,
                id: id,
                table: table
            },
            success:
                function (data) {
                    data = $.parseJSON(data);
                    console.log(data);
                    $('#form-edit-data').html(data);
                },
            error:
                function () {
                    console.log('error AJAX');
                },

        })
    })

    $('body').delegate('.DeleteData','click',function () {
        var id = $(this).attr('id');
        var table = $(this).attr('mytable');

        var result = confirm("Voulez-vous vraiment supprimer l'id n°" + id);

        if(result === true) {
        $.ajax({
            url: '/Panel/deleteLine',
            type: 'POST',
            data: {
                getDeleteLine: true,
                id: id,
                table: table
            },
            success:
                function (data) {
                },
            error:
                function () {
                    console.log('error AJAX');
                },

        })
    }
        $('#modalEdit').modal('hide');
    })

    $('body').delegate('.nextButton','click',function () {

        $('.DataTr').html('');
        $('.DataTd').html('');

        var name = $(this).attr('id');
        firstSQL += 10;
        secondSQL += 10;
        if(secondSQL > 10){
            $('.precButton').removeClass('disabled');
        }else{
            $('.precButton').addClass('disabled');
        }

        $.ajax({
            url: '/Panel/myTable',
            type: 'POST',
            data: {
                getData: true,
                getColumn: true,
                name: name,
                firstSQL: firstSQL,
                secondSQL: secondSQL
            },
            success:
                function (data) {
                    data = $.parseJSON(data);
                    $('.DataTr').html(data.HTMLHEAD);
                    $('.DataTd').html(data.HTMLBODY);
                    $('#editTable').dataTable({
                        paging: false,
                        searching: true,
                        retrieve: true,
                        bInfo: false,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
                        }
                    });
                },
            error:
                function () {
                    console.log('error AJAX');
                },

        })
    })
    $('body').delegate('.precButton','click',function () {

        var name = $(this).attr('id');

        $('.DataTr').html('');
        $('.DataTd').html('');

        firstSQL -= 10;
        secondSQL -= 10;
        if(secondSQL > 10){
            $('.precButton').removeClass('disabled');
        }else{
            $('.precButton').addClass('disabled');
        }

        $.ajax({
            url: '/Panel/myTable',
            type: 'POST',
            data: {
                getData: true,
                getColumn: true,
                name: name,
                firstSQL: firstSQL,
                secondSQL: secondSQL
            },
            success:
                function (data) {
                    data = $.parseJSON(data);
                    $('.DataTr').html(data.HTMLHEAD);
                    $('.DataTd').html(data.HTMLBODY);
                    $('#editTable').dataTable({
                        paging: false,
                        searching: true,
                        retrieve: true,
                        bInfo: false,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
                        }
                    });
                },
            error:
                function () {
                    console.log('error AJAX');
                },

        })
    })





});