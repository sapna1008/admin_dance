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
              <h3 class="box-title"><?= __('Add Reason') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($reason, ['id' => 'reason-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                 </div-->     
                <div class="form-group">
                  <label for="exampleInputEmail1">Reason</label> 
                  <?php echo $this->Form->control('reason', ['class' => 'form-control', 'label' => false]); ?>
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
     

