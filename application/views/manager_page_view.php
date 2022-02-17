<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<title>Manager Panel: </title>
</head>
<body>
<ul class="breadcrumb">
  <li><a href="<?php echo base_url('Manager_page/searchListing'); ?>">User Listing</a></li>
  <li class="active">Add User</li>
</ul>
<?php 
if($this->session->flashdata('success'))
{   
    echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong>'.$this->session->flashdata('success').'</div>';
}
if($this->session->flashdata('error'))
{   
    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>'.$this->session->flashdata('error').'</div>';
}
if(validation_errors())
{
    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>'.validation_errors().'</div>';
} ?>
<section >
    <form action="<?php echo base_url('Manager_page/addPatient');?>"  method="post" >
    <h3>Managr Page:</h3> <h4>Add user Here</h4>
        <div class="user-wrap " style="margin-top:60px">
                <div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="patient_name" id="patient_name" value="<?php echo  set_value('patient_name'); ?>" required />
                        </div>
                    </div>
	
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="text" class="form-control" placeholder="Please Email ID" name="email" id="email" value="<?php echo  set_value('email'); ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" placeholder="Please Phone" name="pnumber" id="pnumber" value="<?php echo  set_value('pnumber'); ?>" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Hospital</label>
                       <select name="hospital" class="form-control hospital" id="hospital">
                           <option value="">----------Choose Hospital--------</option>
                           <?php foreach($hospital_name as $key=>$val){ ?>
                             <option data-id="<?php echo $val['department_id']?>" value="<?php echo $val['id']?>"  ><?php echo $val['hospital_name'];?></option>
                          <?php }?>
                       </select> 
                    </div>
                    <div class="col-md-4 department"  style="display:none;">
                        <label>Department</label>
                       <select name="department" class="form-control department_name" >
                          <option value="">-------Choose Department</option>
                       </select> 
                    </div>
                    <div class="col-md-12"  style="margin-top:50px">
                      <input type="submit" name="add" value="Submit" class="btn btn-default" />
                    </div>
                </div>
                   
        </div>
    </form>
</section>
<script>
  $('#hospital').on('change',function(e){
    var hospitalId      = $('.hospital').val(); 
    var dep_id      =  $(this).find('option:selected').data("id"); 
    if(dep_id && dep_id != ""){
        dep_id = dep_id;
    }else{
        dep_id = 0;
    }
    if(hospitalId && hospitalId != ''){
      $('.department').css("display","block");
    }else{
      $('.department').css("display","none");
     }
       $.ajax({
          type: "POST",
          url: "<?php echo base_url('Manager_page/getDepartmentData')?>",
          data:{dep_id:dep_id},
          success: function (data) {  
            var response = JSON.parse(data);
            var res = response.dep_data;
            if(res && res != "" &&  response.status == 200){
            $('.department_name').find('option').remove();
            $('.department_name').append('<option value="">-------------Choose Department------------</option');
            $.each(res,function(key, value)
                {
                    $('.department_name').append('<option value=' + key + '>' + value + '</option>'); // return empty
                });
            }else{
                $('.department').css("display","none");
            }
          }
      });

    });
</script>
</body>
</html>