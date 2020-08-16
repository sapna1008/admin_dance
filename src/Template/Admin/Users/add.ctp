<section class="content-header">
    <h1>
    Users
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Add User</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create('user',['id'=>'user-form']) ?>
              <div class="box-body">
                <div class="form-group">
                  <?php echo $this->Form->hidden('role', ['class' => 'form-control', 'disabled' => 'disabled' ,'label' => false,'autocomplete'=>'off','id' =>'role', 'value'=>"user"]);
                ?>

                
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                </div>

                
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                </div>
        
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <?php echo $this->Form->control('phone', ['id'=>'phone','class' => 'form-control', 'label' => false,'autocomplete'=>'off','maxlength'=>15]); ?> 
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <?php echo $this->Form->select('gender', [
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Others'
                ],['class' => 'form-control']);
                ?>
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <?php echo $this->Form->control('age', ['class' => 'form-control', 'min'=> 0 , 'label' => false,'type'=>'number']); ?>
                </div>
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <?php echo $this->Form->control('password1', ['label' => false, 'class' => 'form-control', 'type' => 'password']); ?>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <?php echo $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'type' => 'password']); ?>
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
<style>
.form-group .error .iti__selected-flag 
{
height: 55% !important;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/intlTelInput.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/utils.js"></script> 
<script>
 
var input = document.querySelector("#phone");
window.intlTelInput(input, {
  nationalMode: false,
  defaultCountry: "us",    
  preferredCountries: ["us"],
  hiddenInput: "phone",
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/utils.js"
});    

$("#phone").on('input', function() {
   this.value = this.value
      .replace(/[^\+\d]/g, '')             // numbers and decimals only
      // .replace(/(\..*)\./g, '$1')         // decimal can't exist more than once
      // .replace(/(\.[\d]{4})./g, '$1');    // not more than 4 digits after decimal


});

</script>


<script>
 $.validator.addMethod('mypassword', function(value, element) 
        {
            return this.optional(element) || (value.match(/[a-zA-Z]/) &&  value.match(/[!@#$%&*]/));
        },
        'Password must contain alphanumeric and special character.');

$().ready(function() {
    	$("#user-form").validate({
		rules: {
			name:  {
          required: true
      },
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true
        			},
			gender: {
				required: true
			},
      age :
      {
        required: true
      },
			password1: {
        required: true,
        minlength: 8,
        maxlength: 12,
        mypassword: true  
      },
			password: {
        required: true,
				equalTo: "#password1"
			}
		},
		messages: {
			name: {
              required :"Please enter your name"
            },
			email: "Please enter a valid email address",
			phone: "Please enter valid phone number",	
			gender: "Please select gender",
      age: "Please enter age",
      password1: {
        required: "Password is required",
        minlength: "Please enter at least 8 characters.",
        maxlength: "Please enter no more than 12 characters.",
      },
			password: {
				equalTo: "Password and confirm password should be same"
			}
		},
    highlight: function(element) {
        $(".form-group").addClass('error');
    }
	});
});
</script>   

<script>

$("#phone").on("keyup",function(){
  $(".form-group").removeClass('error');

});



</script>   
