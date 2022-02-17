<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<title>:User Details</title>
</head> 
<body>
<ul class="breadcrumb">
  <li><a href="<?php echo base_url('Manager_page/addPatient'); ?>">Add User</a></li>
  <li class="active">User Details</li>
</ul>
 <div id="tb"style="padding:10px 0 10px 0; margin: 0 0 20px;">
     <form action ="<?php echo base_url('Manager_page/searchListing'); ?>"  method="get" >
         <div class="row">
             <div class="col-md-4  form-group">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Search Email" class="form-control" id="email" value="<?php echo $email; ?>">
             </div>
             <div class="col-md-4">
             <label for="number">Phone Number</label>
                <input type="text" name="number" placeholder="Search number" class="form-control" id="number" value="<?php echo $number; ?>">
             </div>
            

             <div class="col-md-4" style="margin-top:20px;">
                 <button class="btn btn-default" type="submit">Search</button>
                 <a class="btn btn-default" href="<?php echo base_url('Manager_page/searchListing'); ?>">Clear</a>        
             </div>   
         </div>
     </form>
  </div>        
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered ">
    <thead>
    <tr>
    	<td width="1%" align="center">S.NO</td>
        <td width="10%" align="center">Name</td>
        <td width="10%" align="center">Email</td>
        <td width="10%" align="center">Phone Number</td>
        <td width="5%" align="center">Hospital Name</td>
        <td width="5%" align="center">Department Name</td>
        <td width="5%" align="center">Date&Time</td>
     </tr>
    </thead>  
    <tbody>
    	<?php
    	 if(count($result)>0){
    	 	 $i = 1;
        	foreach($result as $res){?>
      <tr>
      <td align="center"><?php echo $i; ?></td>
      <td align="center"><?php echo $res->name; ?></td>
      <td align="center"><?php echo $res->email; ?></td>
      <td align="center"><?php echo $res->phone_number;?></td>
      <td align="center"><?php echo $res->hospital_name;?></td>
      <td align="center"><?php echo $res->department_name;?></td>
      <td align="center"><?php echo date('Y-m-d H:i:s',$res->created_date);?></td> 
    </tr>
     <?php $i++; } 
   } else {?>
    <tr >
      <td colspan="10">No Records Found !</td>
   </tr>
        <?php }
     ?>
   </tbody>
</table>
</body>
 </html>
