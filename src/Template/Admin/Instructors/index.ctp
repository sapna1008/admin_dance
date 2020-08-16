<section class="content-header">
    <h1>
    Instructors   <?//= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home  </li>
        <li class="active">Instructors</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">

            <div class="box-body">
              <!-- <div>-->
              <!--  <button>Add Instructor</button>-->
              <!--</div>-->
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                   <th>Email</th>

                  <th>Phone</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($instructors as $user): ?>
                <tr>
                  <td><?php echo $user['id']; ?></td>
                  <td><?php echo $user['name']; ?></td>
                  <td>
                  <?php echo $user['email']; ?>
                 </td>
                  <td><?php echo $user['phone']; ?></td>
                  

                  <td>
               
                  <?=
                  $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $user['id']],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) 
                    ?>
                      
                    <?=
                    $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $user['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) 
                    ?>
                    <a  href="<?php echo $this->request->webroot; ?>admin/instructors/delete/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this user?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
                    <?php  ?>
                    
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