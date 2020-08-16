<section class="content-header">
    <h1>
    Dance style
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Style</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Style</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <?= $this->Form->create($styles, ['id' => 'user-form','type' => 'post','enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Dance Style</label>
                  <?php echo $this->Form->control('style', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Thumbnail</label>
                  <?php echo $this->Form->control('thumbnail', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                  <img src="<?php echo ($styles->thumbnail != '') ? $this->request->webroot.'images/introductoryimages/'.$styles->thumbnail : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" class="previewHolder" style="width: 135px;"/>  
                </div>        
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 

<script>     
        
$().ready(function() {
	$("#user-form").validate({
		rules: {
			style: "required",
      description: "required"
		},
		messages: {
			style: "Please enter dance style",
      description: "Please enter description"
		}
	});
});
</script>     
<script>

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
$("#profilePic").change(function() {
  readURL(this);
});

</script>