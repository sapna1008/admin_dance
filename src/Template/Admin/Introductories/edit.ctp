<section class="content-header">
    <h1>
    Screens
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Edit Screens</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Screen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($user, ['id'=>'int-form','enctype' => 'multipart/form-data']); ?>
              <div class="box-body">
               
                <div class="form-group">
               
                <label>Title</label>
                  <?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false,'required'=>"required"]); ?>
                </div>


                <div class="form-group">
                  <?php echo $this->Form->control('description',['class'=>'form-control']);   ?>
                </div>

                <div class="form-group">
                 <label for="exampleInputEmail1">Image</label>
                 <?php echo $this->Form->control('image', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                 <img src="<?php echo ($user->image != '') ? $this->request->webroot.'images/introductoryimages/'.$user->image : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" class="previewHolder" style="width: 135px;"/>  
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
  $("#int-form").validate({
    rules: {
      title: "required", 
      description: 
      {
            required: true,
            maxlength: 100
        }
      
    },
    messages: {
      title: "Please enter your title",
      description: "Please enter valid description"

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