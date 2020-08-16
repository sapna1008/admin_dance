<section class="content-header">
    <h1>
    Screens
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Add Screens</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Screen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create('screen', ['enctype' => 'multipart/form-data']); ?>
              <div class="box-body">
               
                <div class="form-group">
                <label>Title</label>
                  <?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false,'required'=>"required"]); ?>
                </div>


                <div class="form-group">
                  <?php echo $this->Form->textarea('description'['required'=>"required"]);   ?>
                </div>

                <div class="form-group">
                 <label for="exampleInputEmail1">Image</label>
                 <?php echo $this->Form->control('image', ['id' => 'image', 'type' => 'file', 'class' => 'form-control', 'label' => false,'required'=>"required"]); ?>
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
        },
      image : "required"
      
    },
    messages: {
      title: "Please enter your title",
      description: "Please enter valid description",
      image: "Please upload your image"
    }
  });
});
</script>