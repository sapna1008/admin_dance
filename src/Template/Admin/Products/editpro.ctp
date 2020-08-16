<section class="content-header">
    <h1>
    Product Option
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product Option</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Product Option <strong>(ID: <?php echo $item['id']; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($item, ['id' => 'user-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">
             
                
            <div>
                  <label for="exampleInputEmail1">Product name</label>
                 <div class="input select">
                     <select name="product_id" class="form-control valid" id="product_id" aria-invalid="false">
                         <?php foreach($products as $key=>$val) { ?>
                         <option value="<?php echo $key;  ?>" <?php if($item->instructor_id == $key){ echo "selected"; } ?>><?php echo $val;  ?></option>
                         <?php  } ?>
                    </select>
                     </div>
                </div>
                
                 <div>
                  <label for="exampleInputEmail1">Option name</label>
                 <div class="input select">
                     <select name="option_id" class="form-control valid" id="option_id" aria-invalid="false">
                         <?php foreach($options as $key=>$val) { ?>
                         <option value="<?php echo $key;  ?>" <?php if($item->option_id == $key){ echo "selected"; } ?>><?php echo $val;  ?></option>
                         <?php  } ?>
                    </select>
                     </div>
                </div>
                    <div class="form-group">
                  <label for="exampleInputEmail1">Quantity</label>
                  <?php echo $this->Form->control('quantity', ['class' => 'form-control','type' => 'number', 'label' => false]); ?>
                </div>
                
              
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
	$("#instructor-form").validate({
		rules: {
			video: "required", 
			description: "required",
			phone: {
				required: true,
				//digits: true
			},
			country: {
				required: true
			},
			gender: {
				required: true
			}
		},
		messages: {
			video: "Required",
			description: "Required",
			phone: "Please enter valid phone number",	
			country: "Please select country",
			gender: "Please select gender"
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

$("#profilePic").change(function() {
  readURL(this);
});
</script>      