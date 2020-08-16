<section class="content-header">
    <h1>
    Products   <?//= $this->Html->link(__('Add User'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
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
                        '<span class="video">Add Product</span><span class="sr-only">' . __('AddStyle') . '</span>',
                        ['action' => 'add'],
                        ['escape' => false, 'title' => __('AddStyle'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Description</th>
                  <!--<th>Quantity</th>-->
                  <th>Price</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($products as $user): ?>
                <tr>
                  <td><?php echo $user['id']; ?></td>
                  <td><?php echo $user['product_name']; ?></td>
                  <td><?php echo $user['description']; ?></td>
                  <!--<td><?php echo $user['quantity']; ?></td>-->
                  <td><?php echo $user['cost']; ?></td>
                  <td><?php echo ($user['status'] == '0') ? 'Disabled' : 'Enabled'; ?></td> 

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
                   
                    <a href="<?php echo $this->request->webroot; ?>admin/products/delete/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this product?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
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