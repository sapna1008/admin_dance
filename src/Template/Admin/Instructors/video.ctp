<section class="content-header">
    <h1>
    Video   <?//= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Video</li>
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
                        '<span class="video">Add Video</span><span class="sr-only">' . __('AddVideo') . '</span>',
                        ['action' => 'addvideo'],
                        ['escape' => false, 'title' => __('AddVideo'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Instructor</th>
                  <th>Count</th>
                  <th>Level</th>
                  <th>Video</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($videos as $user): ?>
                <tr>
                  <td><?php echo $user->id; ?></td>
                  <td><?php echo $user->instructor->name ?></td>
                  <td><?php echo $user->count ?></td>
                  <td><?php echo $user->level ?></td>
                  <td>
                
                      <video width="260" height="200" controls>
                      <source src="<?php echo ($user->video != '') ? $this->request->webroot.'images/introductoryimages/'.$user->video : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" type="video/mp4">
                      <source src="<?php echo ($user->video != '') ? $this->request->webroot.'images/introductoryimages/'.$user->video : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" type="video/ogg">
                    Your browser does not support the video tag.
                    </video>
                  </td>
                  <td>
                      <?php echo $user->description ?>
                  </td>
                  <td>
                      
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('editvid') . '</span>',
                        ['action' => 'editvid', $user['id']],
                        ['escape' => false, 'title' => __('editvid'), 'class' => 'btn btn-success btn-xs']
                    ) ?>

                    <?php
                    ?>
                    <a style="margin-left: 23px;" href="<?php echo $this->request->webroot; ?>admin/instructors/del/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this video?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
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