<section class="content-header">
    <h1>
    Products
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <?= $this->Form->create('product', ['id' => 'user-form','type' => 'post', 'url' => ['controller' => 'products', 'action' => 'add'], 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <?php echo $this->Form->control('product_name', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <?php echo $this->Form->control('cost', ['class' => 'form-control','type' => 'number', 'label' => false]); ?>
                </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                   <select name="status" class="form-control">
                    <option value="1">Activate</option>
                    <option value="0">Deactivate</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Featured_image</label>
                  <?php echo $this->Form->control('featured_image', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Image1</label>
                  <?php echo $this->Form->control('image1', ['id' => 'profilePic1', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Image2</label>
                  <?php echo $this->Form->control('image2', ['id' => 'profilePic2', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Image3</label>
                  <?php echo $this->Form->control('image3', ['id' => 'profilePic3', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 

<script>     
        
$().ready(function() {
	$("#user-form").validate({
		rules: {
			product_name: "required",
			cost: "required",
			featured_image: "required",
			quantity: "required",
			status: "required",
		},
		messages: {
			product_name: "enter product name",
			cost: "enter product cost",
			featured_image: "enter one featured image",
			quantity: "enter quantity",
			status: "enter status of product",
		}
	});
});
</script>     
<script>

$("#profilePic").change(function() {
  readURL(this);
});
$("#profilePic1").change(function() {
  readURL(this);
});
$("#profilePic2").change(function() {
  readURL(this);
});
$("#profilePic3").change(function() {
  readURL(this);
});
</script>