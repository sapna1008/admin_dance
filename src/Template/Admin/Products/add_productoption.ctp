<section class="content-header">
    <h1>
    Product Option
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Product Option</li>
    </ol>
</section>

<section class="content">
	<div class="row">
	    <?php echo $this->Flash->render(); ?>
        <div class="col-xs-8">
        <div class="box box-primary">
            
            <div class="box-header with-border">
              <h3 class="box-title">Add Video</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create('product', ['id' => 'user-form','type' => 'post', 'url' => ['controller' => 'products', 'action' => 'add_productoption'], 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div>
                  <label for="exampleInputEmail1">Product name</label>
                 <?php
                  echo $this->Form->input('product_id',
                    array(
                        'options' => $products,
                        'class' => 'form-control',
                        'label' => false,
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'label custom-inline-error label-important help-inline'))
                    ));
                    ?>
                </div>
                
                <div>
                  <label for="exampleInputEmail1">Option name</label>
                 <?php
                  echo $this->Form->input('option_id',
                    array(
                        'options' => $options,
                        'class' => 'form-control',
                        'label' => false,
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'label custom-inline-error label-important help-inline'))
                    ));
                    ?>
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
	$("#user-form").validate({
		rules: {
			description: "required",
			video: "required",
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				//digits: true
			},
			country: {
				required: true
			},
			gender: {
				required: true
			},
			dob: "required",
			password1: "required",
			password: {
				equalTo: "#password1"
			}
		},
		messages: {
			descripton: "Please enter description",
			video: "Please enter video",
			email: "Please enter a valid email address",
			phone: "Please enter valid phone number",	
			country: "Please select country",
			gender: "Please select gender",
			dob: "Please fill this field",
			password1: "Password is required",
			password: {
				equalTo: "Password and confirm password should be same"
			}
		}
	});
});

$('#datepicker').datepicker({
  autoclose: true
})
</script>      

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.6/tinymce.min.js"></script>
<script>
tinymce.init({
selector: 'textarea',
plugins: [
"code", "charmap", "link"
],
toolbar: [
"undo redo | styleselect | bold italic | link | alignleft aligncenter alignright | charmap code" | "media"
]
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