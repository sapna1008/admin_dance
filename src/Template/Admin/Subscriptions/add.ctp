<section class="content-header">
    <h1>
    Subscription
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Add Subscription</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Subscription</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create('subscription', ['id' => 'sub-form','enctype' => 'multipart/form-data']); ?>
              <div class="box-body">
               
                <div class="form-group">
                <label>Title</label>
                  <?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false]); ?>
                </div>

              <div class="form-group">
                <label>Price</label>
                   <?php echo $this->Form->control('price', ['class' => 'form-control', 'label' => false,'min'=>'1']); ?>
                </div>

                <div class="form-group">
                  <label>Description</label>
                   <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?>
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
  $("#sub-form").validate({
    rules: {
      title:
      {
          required: true,
         lettersonly: true
      }  ,
      price: "required", 
      description: {
          required: true
        }
      
    },
    messages: {
      title: "Please enter your title",
      price: "Please enter your price",
      description: "Please enter description"
    }
  });
});
</script>