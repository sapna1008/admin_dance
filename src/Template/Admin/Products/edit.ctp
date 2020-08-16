<section class="content-header">
    <h1>
    Products
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Product <strong>(ID: <?php echo $product->id; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
         <?php print_r(debug($this->request->url);
         ); ?>
            <?= $this->Form->create($product, ['id' => 'instructor-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">
              	       <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <?php echo $this->Form->control('product_name', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Quantity</label>
                  <?php echo $this->Form->control('quantity', ['class' => 'form-control','type' => 'number', 'label' => false]); ?>
                </div>
                   <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <?php echo $this->Form->control('cost', ['class' => 'form-control','type' => 'number', 'label' => false]); ?>
                </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                   <select name="status" class="form-control">
                    <option value="1" <?php if($product->status=='1'){ echo "selected"; }?>>Activate</option>
                    <option value="0" <?php if($product->status=='0'){ echo "selected"; }?>>Deactivate</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Featured_image</label>
                    <img src="<?php echo ($product['featured_image'] != '') ? $this->request->webroot.'images/products/'.$product['featured_image'] : $this->request->webroot.'images/products/noimage.png'; ?>" class="previewHolder" style="width: 135px;"/> 
                  <?php echo $this->Form->control('featured_image', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                  
                </div>
                <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Product Image1</th>
                  <th>Product Image2</th>
                  <th>Product Image3</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>
                 <img src="<?php echo ($product['image1'] != '') ? $this->request->webroot.'images/products/'.$product['image1'] : $this->request->webroot.'images/products/noimage.png'; ?>" class="previewHolder1" style="width: 135px;"/>   
                <div class="form-group">
                 <?php echo $this->Form->control('image1', ['id' => 'image1', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div> 
                </td>
                   <td>
                <img src="<?php echo ($product['image2'] != '') ? $this->request->webroot.'images/products/'.$product['image2'] : $this->request->webroot.'images/products/noimage.png'; ?>" class="previewHolder2" style="width: 135px;"/>   
                <div class="form-group">
                 <?php echo $this->Form->control('image2', ['id' => 'image2', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>  
                </td>
                   <td>
                <img src="<?php echo ($product['image3'] != '') ? $this->request->webroot.'images/products/'.$product['image3'] : $this->request->webroot.'images/products/noimage.png'; ?>" class="previewHolder3" style="width: 135px;"/>   
                <div class="form-group">
                 <?php echo $this->Form->control('image3', ['id' => 'image3', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>
                </td>
                </tr>
                </tbody>
              </table>
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

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
   function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder1').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
   function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder2').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
   function readURL3(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder3').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#profilePic").change(function() {
  readURL(this);
});
$("#image1").change(function() {
  readURL1(this);
});
$("#image2").change(function() {
  readURL2(this);
});
$("#image3").change(function() {
  readURL3(this);
});
</script>      