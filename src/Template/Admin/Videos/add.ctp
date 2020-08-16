<section class="content-header">
    <h1>
    Video
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Add Video</li>
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
            <?= $this->Form->create('video', ['id' => 'user-form','type' => 'post', 'enctype' => 'multipart/form-data']) ?>
            <div class="loader" style="display:none;"></div>
              <div class="box-body">
                <div class="form-group">
              
                

                <div class="form-group">
                  <label for="exampleInputEmail1">Instructor name</label>
                 <?php
                  echo $this->Form->input('instructor_id',
                    array(
                        'options' => $instructors,
                        'class' => 'form-control',
                        'label' => false,
                         'empty' => 'Select instructor',
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'label custom-inline-error label-important help-inline'))
                    ));
                    ?>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Program</label>
                  <select name="program_id" id="program_id" class="form-control pro_option">
                    <option value="">Choose Program</option>
                  </select>
                </div>



               <div class="form-group">
                  <label for="exampleInputEmail1">Style Form</label>
                  <select name="style_id" id="styles" class="form-control no_option">
                    <option value="">Choose style</option>
                  </select>
                </div>

               


                  <div class="form-group">
                     <label for="exampleInputEmail1">Level</label>
                  <?php echo $this->Form->select('level', [ 
                    'beginner' => 'Beginner', 
                    'intermediate' => 'Intermediate',
                    'expert' => 'Expert'],
                    ['class' => 'form-control']);  
                ?>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Set count of video</label>
                    <select class = "form-control" name="count" id="count">
                      <option selected="selected">1</option>
                      <?php
                        foreach($count as $count) { ?>
                         <option value="<?= $count ?>"><?= $count ?></option>
                      <?php
                        } ?>
                    </select> 
                      </div>
                     <div class="form-group">
                  <label for="exampleInputEmail1">Video</label>
                  <?php echo $this->Form->control('video', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>   
                <span id="element2"></span>
               <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
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
.loader {

    border: 16px solid #f3f3f3;

    border-top-color: rgb(243, 243, 243);
    border-top-style: solid;
    border-top-width: 16px;

border-radius: 77%;

border-top: 16px solid

    #3498db;
    width: 78px;
    height: 76px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 36%;
    left: 40%;

}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<script>
        
$().ready(function() {
  $("#user-form").validate({
		rules: {
      instructor_id : "required",
      style_id: "required",
      program_id: "required",
			description: "required",
			video: "required",
      subscription: "required"

		},
		messages: {
      instructor_id : "Please select instructor name",
      style_id: "Please select any style",
      program_id: "Please select any program",
			descripton: "Please enter description",
			video: "Please enter video",
      subscription: "This field is required"
		}
	});
});

</script>      

<script>


$("#instructor-id").on("change",function(){

var instructor_id = $(this).val();

$(".loader").show();


$.ajax({
            type: 'post',
            url: 'getStyles',
            data:'id='+instructor_id,
            success: function(response) 
            {
                $(".loader").hide();
                $(".pro_option").empty();
                $(".pro_option").append(response);
            }
        });



});


$("#program_id").on("change",function(){

var instructor_id = $("#instructor-id").val();
var program_id = $(this).val();

$(".loader").show();


$.ajax({
            type: 'post',
            url: 'getstylepro',
            data: { id:instructor_id,
                  pro_id: program_id
             },


            success: function(response) 
            {
                $(".loader").hide();
                $(".no_option").empty();
                $(".no_option").append(response);
            }
        });



});

$('#profilePic').change(function (event) {
    var filePath = this.value;
    var allowedExtensions = /(\.mp4|\.docx|\.mpg)$/i;
     if(!allowedExtensions.exec(filePath)){
         document.getElementById('element2').innerHTML = 'Please upload file having extensions .mp4/.mpg';
        this.value = '';
        return false;
    }
    else
    {
        var file = URL.createObjectURL(event.target.files[0]);
       document.getElementById('element2').innerHTML = '<video width="20%;"><source src="' + file + '"></video>';
    }
});
</script>