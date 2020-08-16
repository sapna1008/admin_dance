<section class="content-header">
    <h1>
    Dance style
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Programs</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Program</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <?= $this->Form->create('programs', ['id' => 'user-form','type' => 'post','enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Thumbnail</label>
                  <?php echo $this->Form->control('thumbnail', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                   <span id="previewHolder" style="width: 135px;"/></span> 
                </div>        
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Featured Video</label>
                  <?php echo $this->Form->control('featured_video', ['id' => 'featured_video', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                   <span id="previewHolder2" style="width: 135px;"/></span>  
                </div>        
              </div>


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
                  <label for="exampleInputEmail1">Style Form</label>
                  <select name="style_id" id="styles" class="form-control no_option">
                    <option value="">Choose style</option>
                  </select>
                </div>


              <div class="form-group"><label>Subscribed Plain</label></div>
                <div class="form-group">
                <div class="radio">
               <?php $options = array('1' => 'Yes', '0' => 'No');
                  $attributes = array('legend' => false);
                  echo $this->Form->radio('subscription', $options, $attributes); ?>
                  </div>
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
			title: "required",
      description: "required",
			thumbnail: "required",
		},
		messages: {
			style: "Please enter dance style",
      description: "Please enter description",
			thumbnail: "Please enter thumbnail"		}
	});
});
</script>     
<script>
$('#profilePic').change(function (event) {
    var filePath = this.value;
     var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
     if(!allowedExtensions.exec(filePath)){
         document.getElementById('previewHolder').innerHTML = 'Please upload file having extensions .jpg/.jpeg/.png';
        this.value = '';
        return false;
    }
    else
    {
        var file = URL.createObjectURL(event.target.files[0]);
       document.getElementById('previewHolder').innerHTML = '<img src="' + file + '" width="125px;">';
    }
});


$('#featured_video').change(function (event) {
    var filePath = this.value;
     var allowedExtensions = /(\.mp4|\.mpg)$/i;
     if(!allowedExtensions.exec(filePath)){
         document.getElementById('previewHolder2').innerHTML = 'Please upload file having extensions .mp4/.mpg';
        this.value = '';
        return false;
    }
    else
    {
        var file = URL.createObjectURL(event.target.files[0]);
       document.getElementById('previewHolder2').innerHTML = '<video width="125px;"><source src="' + file + '"></video>';
    }
});




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
                $(".no_option").empty();
                $(".no_option").append(response);
            }
        });



});
</script>