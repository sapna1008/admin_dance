<section class="content-header">
    <h1>
   <?= __('Question') ?>
    <small></small>
    </h1>
   
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Question') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($question, ['id' => 'question-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                 </div-->     
                <div class="form-group">
                  <label for="exampleInputEmail1">Question</label> 
                  <?php echo $this->Form->control('question', ['class' => 'form-control', 'label' => false]); ?>
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
     

