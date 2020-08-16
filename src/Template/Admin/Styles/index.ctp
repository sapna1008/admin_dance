<section class="content-header">
    <h1>
    Dance style   <?//= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <?= $this->Html->link(
                        '<span class="video">Add Dance style</span><span class="sr-only">' . __('add') . '</span>',
                        ['action' => 'add'],
                        ['escape' => false, 'title' => __('Add Style'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Style</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">

            <div class="box-body">
               <div>
                  
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Style Form</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($styles as $user): ?>
                <tr>
                  <td><?php echo $user->id; ?></td>
                  <td><?php echo $user->style ?></td>
                  <td>
                      
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('edit') . '</span>',
                        ['action' => 'edit', $user['id']],
                        ['escape' => false, 'title' => __('edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                    <?php
                    ?>
                    <a href="<?php echo $this->request->webroot; ?>admin/styles/delete/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this video?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
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