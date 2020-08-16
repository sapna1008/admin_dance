<section class="content-header">
    <h1>
    Users   <?= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Users


        </li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                  <td><?php echo $user['name']; ?></td>
                  <td><?php echo $user['email']; ?></td>
                  <td><?php echo ucwords($user['role']); ?></td>
                  <!-- <td><?php echo ($user['status'] == '0') ? 'Disabled' : 'Enabled'; ?></td> -->

                  <td><?php
                  if($user['status'] == '0' && $user['deactivate_reason'] == '' && $user['deactivate_desc'] == ''){?>
                      Deactivated by Admin
                 <?php }else if($user['status'] == '0' && $user['deactivate_reason'] != '' && $user['deactivate_desc'] != '') { ?>
                    Deactivated by Self  
                <?php  }else if($user['status'] == '1') { ?>
                    Activated  
                <?php  }
                  ?>
                  </td>

                  <td>
               
                  <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $user['id']],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>
                      
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $user['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>

                    <?= $this->Html->link(
                        'Change Password',
                        ['action' => 'changepassword', $user['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-warning btn-xs']
                    ) ?>
                    <?php if($user['status'] == 1){ ?>    
                  <?= $this->Form->postLink(__('Disable '), ['action' => 'desable', $user->id], ['confirm' => __('Are you sure you want to disable # {0}?', $user->id),'class' => 'btn btn-danger btn-xs']) ?>  
                    <?php }else{ ?>
                    <?= $this->Form->postLink(__('Enable'), ['action' => 'enable', $user->id], ['confirm' => __('Are you sure you want to enable # {0}?', $user->id),'class' => 'btn btn-success btn-xs']) ?>     
                    <?php } if($user['role'] != 'admin'){ ?>
                    <a style="margin-left: 23px;" href="<?php echo $this->request->webroot; ?>admin/users/delete/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this user?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
                    <?php } ?>
                    
                       <?php  if(!empty($user['usertones'])){  ?>
                    <?= $this->Html->link(__('Voice') ,
                        ['action' => 'uservoicelist', $user['id']],
                        ['escape' => false, 'title' => __('Voice'), 'class' => 'btn btn-info btn-xs']
                    ) ?>
                    <?php } ?>  
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