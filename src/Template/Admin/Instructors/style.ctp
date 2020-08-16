<section class="content-header">
    <h1>
    Dance style   <?//= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
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
                  <?= $this->Html->link(
                        '<span class="video">Add Dance style</span><span class="sr-only">' . __('AddStyle') . '</span>',
                        ['action' => 'addstyle'],
                        ['escape' => false, 'title' => __('AddStyle'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Style</th>
                  <th>Description</th>
                  <th>Thumbnail</th>
                  <th>Video</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($styles as $user): ?>
                <tr>
                  <td><?php echo $user->id; ?></td>
                  <td><?php echo $user->style ?></td>
                  <td><?php echo $user->description ?></td>
                  <td>
                      <img src="<?php echo ($user->thumbnail != '') ? $this->request->webroot.'images/introductoryimages/'.$user->thumbnail : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" class="previewHolder1" style="width: 260px;"/>
                  </td>
                   <td>
                      <video width="260" controls>
                      <source src="<?php echo ($user->video != '') ? $this->request->webroot.'images/introductoryimages/'.$user->video : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                  </td>
                  <td>
                      
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('editstyle') . '</span>',
                        ['action' => 'editstyle', $user['id']],
                        ['escape' => false, 'title' => __('editstyle'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                    <?php
                    ?>
                    <a href="<?php echo $this->request->webroot; ?>admin/instructors/delstyle/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this video?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
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