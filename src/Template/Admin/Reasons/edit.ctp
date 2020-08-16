<section class="content-header">
    <h1>
   <?= __('Reason') ?>
    <small></small>
    </h1>
     
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Edit Reason') ?><strong>(ID: <?php echo $reason->id; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($reason, ['id' => 'reason-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">
                    
                <div class="form-group">
                  <?php echo $this->Form->control('reason', ['class' => 'form-control', 'label' =>'Reason']); ?>
                </div>
              </div>
 

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?> 
          </div>
        </div>
    </div>
</section> 

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

$("#categoryPic").change(function() {
  readURL(this);
});
</script>      