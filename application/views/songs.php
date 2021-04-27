<div id="page-wrapper">
  <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row" id="main" >
          <div class="col-sm-12 col-md-12 well" id="content">
            <button id='add_new_song' class="add-new-song"><i class="fa fa-plus" style="margin-right: 8px"></i>Add New</button>
            <table id="songs" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Duration</th>
                        <th>Created Date</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
          </div>
      </div>
      <!-- /.row -->
  </div>
  <form style="visibility: hidden" id='fileForm' enctype="multipart/form-data" class="jNice" accept-charset="utf-8" method="post" action="<?php echo base_url().'songs/upload';?>">              
    <fieldset>      
            <label>Title * : </label>                       
            <input type="text" class="text-long" value="" name="title">

            <label>Description : </label>                       
            <textarea class="mceEditor" rows="10" cols="40" name="description"></textarea>

            <label>Image : </label>                     
            <input type="file" onchange="fileSubmit()" id="uploadFile" multiple="" name="videos[]">                             
            <input type="hidden" id="uploadId" name='id' value=''>                             

            <button class="button-submit" type="submit" name="save" id="">Save</button>
    </fieldset>         
  </form>
  <!-- /.container-fluid -->
</div>