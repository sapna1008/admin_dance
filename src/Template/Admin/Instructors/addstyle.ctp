<section class="content-header">
    <h1>
    Dance style
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
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
              <?= $this->Form->create('style', ['id' => 'user-form','type' => 'post', 'url' => ['controller' => 'instructors', 'action' => 'addstyle'], 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Dance Style</label>
                  <?php echo $this->Form->control('style', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Thumbnail</label>
                  <?php echo $this->Form->control('thumbnail', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Video</label>
                  <?php echo $this->Form->control('video', ['id' => 'profilePic1', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
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
			thumbnail: "required",
			video: "required",
		},
		messages: {
			style: "Please enter dance style",
			thumbnail: "Please enter thumbnail",
			video: "Please enter a video",
		}
	});
});
</script>     
<script>

$("#profilePic").change(function() {
  readURL(this);
});
$("#profilePic1").change(function() {
  readURL(this);
});
</script>