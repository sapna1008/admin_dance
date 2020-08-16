<section class="content-header">
    <h1>
    Options   <?//= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Options</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add option</h3>
            </div>
                             <?php if (!empty($opt)) {
                            ?>
   <?= $this->Form->create($option, ['id' => 'user-form', 'enctype' => 'multipart/form-data']) ?>
   <table>
                <tbody>
                     <thead>
                <tr>
                  <th>Option Name</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                    <tr>
                        <td>
                <div class="form-group">
                  <?php echo $this->Form->control('option_name', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                </td>
                <td>
                    <div class="form-group">
                   <select name="status" class="form-control">
                    <option value="1" <?php if($option->status=='1'){ echo "selected"; }?>>Activate</option>
                    <option value="0" <?php if($option->status=='0'){ echo "selected"; }?>>Deactivate</option>
                  </select>
                </div>
                </td>
                <td>
                     <div>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
              </td>
              </tr>
              </tbody>
              </table>
            <?php } else { ?>
                <?= $this->Form->create('option', ['id' => 'user-form','type' => 'post', 'url' => ['controller' => 'products', 'action' => 'option'], 'enctype' => 'multipart/form-data']) ?>
                   <table>
                <tbody>
                     <thead>
                <tr>
                  <th>Option Name</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                    <tr>
                        <td>
           
                <div class="form-group">
                  <?php echo $this->Form->control('option_name', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                </td>
                <td>
                    <div class="form-group">
                   <select name="status" class="form-control">
                    <option value="1">Activate</option>
                    <option value="0">Deactivate</option>
                  </select>
                </div>
                </td>
                <td>
                     <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
              </td>
              </tr>
              </tbody>
              </table>
<?php } ?>
         
              <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Option Name</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($options as $user): ?>
                <tr>
                  <td><?php echo $user['id']; ?></td>
                  <td><?php echo $user['option_name']; ?></td>
                  <td><?php echo ($user['status'] == '0') ? 'Disabled' : 'Enabled'; ?></td> 
                  <td>
                        <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Option') . '</span>',
                        ['action' => 'option', $user['id']],
                        ['escape' => false, 'title' => __('Option'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                    <a href="<?php echo $this->request->webroot; ?>admin/products/deleteopt/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this option?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
                    <?php  ?>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>
    </div>
</section>       