  
var songTableEditor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
  /**User Table */
  const userTable = $('#users').DataTable( {
    ajax: base_url + 'users/getAll',
    rowId: 'id',
    dataType: "json",
    columns: [
        { data: null, render: function ( data, type, row ) {
            // Combine the first and last names into a single table field
            return `${data.first_name ? data.first_name : ''} ${data.last_name ? data.last_name : ''}`;
        } },
        { data: "username" },
        { data: "status", render: function(status, type, row) {
            return status == 0 ? 'Disabled' : 'Enabled'
          }
       },
        { data: "createdAt" },
        {
            data: null,
            className: "dt-center editor-edit",
            orderable: false,
            render: function(data, type, row) {
              return `<button><i class="fa ${data.status == 0 ? 'fa-check' : 'fa-ban'}"/></button>`
            }
        },       
    ]
  } );
  
  $('#users').on('click', 'td.editor-edit', function (e) {
      // e.preventDefault();
      const userId = $(this).closest('tr').attr('id')
      console.log(userId)
      $.ajax({
        url: base_url+'users/updateUserStatus',
        method: 'post',
        dataType: 'json',
        data: {userId: userId},
        success: function(res){
          userTable.ajax.reload()
        }
      })
  } );

  
/**Songs Table */

  const songTable = $('#songs').DataTable( {
    ajax: base_url + 'songs/getAll',
    rowId: 'id',
    dataType: "json",
    columns: [
        { data: "id" },
        { data: "title" },
        { data: "author" },
        { data: "duration" },
        { data: "createdAt" },
        {
            data: null,
            titile: '',
            className: "dt-center editor-edit",
            orderable: false,
            render: function(data, type, row) {
              return `<button><i class="fa fa-pencil"/></button>`
            }
        },  
        {
          data: null,
          titile: '',
          className: "dt-center editor-upload",
          orderable: false,
          render: function(data, type, row) {
            return `<button><i class="fa fa-upload"/></button>`
            // return `<input type="file" id="uploadFile" multiple="" name="images[]" />`
          }
      },  
        {
          data: null,
          titile: '',
          className: "dt-center editor-delete",
          orderable: false,
          render: function(data, type, row) {
            return `<button><i class="fa fa-trash"/></button>`
          }
      },       
    ]
  } );

  songTableEditor = new $.fn.dataTable.Editor( {
    "ajax": {
      "create": {
          "type": 'POST',
          "url":  base_url + 'songs/addNew',
          "success": function(res) {
            if(res['statusCode'] == 200) {
              showToast('Success', 'New song created', 'success')
              songTable.ajax.reload()
            } else {
              showToast('Create Error', res['message'], 'error')
            }
          }
      },
      "edit": {
        "type": 'POST',
        "url":  base_url + 'songs/update',
      },
      // "delete": {
      //   "type": 'POST',
      //   "url":  base_url + 'songs/delete',
      // },
    },
    "table": "#songs",
    "idSrc":  'id',
    "fields": [ {
            "label": "Title:",
            "name": "title"
        }, {
            "label": "Author:",
            "name": "author"
        }, {
            "label": "Duration:",
            "name": "duration"
        }
    ]
} );
 
  $('#add_new_song').on('click', function (e) {
    console.log('click event', e.target)
    e.preventDefault();

    songTableEditor.create( {
        title: 'Add New Song',
        buttons: 'Add'
    } );
  } );
 
  // Edit record
  $('#songs').on('click', 'td.editor-edit button', function (e) {
    e.preventDefault();

    songTableEditor.edit( $(this).closest('tr'), {
        title: 'Edit record',
        buttons: 'Update'
    } );
  } );

  // Upload record
  $('#songs').on('click', 'td.editor-upload', function (e) {
    e.preventDefault();
    
    const uploadingId = $(this).closest('tr').attr('id')
    $("#uploadId").val(uploadingId)
    $("#uploadFile").trigger('click')
  } );

  // // Delete a record
  $('#songs').on('click', 'td.editor-delete', function (e) {
      e.preventDefault();
    const id = $(this).closest('tr').attr('id')
    songTableEditor
    .title( 'Delete row' )
    .message( 'Are you sure you wish to delete this row?' )
    .buttons( { "label": "Delete", 
    
    "fn": function () {
      $.ajax({ 
        url: base_url + 'songs/delete',
        type: 'post',
        data: {id: id},
        dataType: 'json',
        success: function(response){
            if(response['statusCode'] == 200){
              showToast('Delete Success', 'Successfully deleted', 'success')
              songTable.ajax.reload()
              
            }
            else{
              showToast('Delete Error', 'Delete failed', 'error')
            }
        },
      });
    this.close();
      } } )
    .remove( $(this).closest('tr') );
  } );
 
  $('#download').on('click', function (e) {
    console.log('click event', e.target)
    e.preventDefault();

    $.ajax({
      url: 'http://localhost/mzansi/api/songs/download/6?file_name=test4.mp4',
      contentType: 'application/octet-stream',
      headers: {"Authorization": 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjMiLCJ1c2VybmFtZSI6Imhhbm1pbmd5dW4xMjEyQGdtYWlsLmNvbSIsImlhdCI6MTYxOTQ5MTgwNywiZXhwIjoxNjE5NDk5MDA3fQ.Jr445rVwrJ_MykLuSqNwFkDHFB42fJpdZIHmNJsge4Q'},
      success: function(res){
        console.log(res)
      }
    })
  } );
   
} );

function fileSubmit() {
  var formData = new FormData($('#fileForm')[0]);

  $.ajax({ 
      url: base_url + 'songs/upload',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response){
          $('#uploadId').val('')
          console.log(response)
          if(response['statusCode'] == 200){
            showToast('Upload Success', 'Selected Files uploaded successfully', 'success')
          }
          else{
            showToast('Upload Failed', 'Selected Files uploading Failed', 'error')
          }
      },
  });
}