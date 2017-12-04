
<html>
    <div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <h3 id="myModalLabel">Update</h3>
    </div>
    <div class="modal-body">
    <div class="alert alert-danger">
    <?php if($row['image_location'] != ""): ?>
    <img src="uploads/<?php echo $row['image_location']; ?>" width="100px" height="100px" style="border:1px solid #333333; margin-left: 30px;">
    <?php else: ?>
    <img src="abc.jpg" width="100px" height="100px" style="border:1px solid #333333; margin-left: 30px;">
    <?php endif; ?>
    <form action="edit_PDO.php<?php echo '?tbl_image_id='.$id; ?>" method="post" enctype="multipart/form-data">
    <div style="color:blue; margin-left:150px; font-size:30px;">
    	<input type="file" name="image" style="margin-top:-115px;">
    </div>
    </div>
    <hr>
    <div class="modal-footer">
    <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
    <button type="submit" name="submit" class="btn btn-danger">Yes</button>
    </form>
    </div>
    </div>
    </div>
</html>