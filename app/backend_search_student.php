<?php 

require_once '../Library/Student.php'; 

if (isset($_POST['filter'])) {
	 $results =  $students->search_student($_POST['filter']);
	 if ($results->rowCount() > 0) {
	 	foreach ($results as $row) {
		 	echo('
		    <a href="javascript:void(0)" class="list-group-item list-group-item-action rounded-0 student" id="student" data-index="'.$row['id'].'" style="position: relative;">'.$row["last_name"].', '.$row['first_name'].' '.$row['middle_name'].'</a>  ');
		 }
	 }else{
	 	echo '<p>No result(s) found</p>';
	 }
}
elseif (isset($_POST['id'])) {
    /*
    This is not functionong anymore
     */
	$results =  $students->student_curriculum_details($_POST['id']);
	require_once '../Library/Prospectus.php';
	 if ($results->rowCount() > 0) {
	 	 	foreach ($results as $row) {
	 	 		$id = $row['id']; 
			    $course = $row['course_title'];
			    $ay = $row['AY'];
                $curlvl_id = $row['curlvl_id']; 
	 	 	} 
	 	 	?>
	 	 		<div class="main-loader" style="display: none;">
                  <div class="loader"></div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Student ID</label>
                        <input type="text" name="" class="form-control rounded-0 ttttt" id="student_id" value="<?php echo $id; ?>"> 
                    </div>
                    <input type="text" name="curlvl_id" id="curlvl_id" value="<?php echo $curlvl_id; ?>" hidden>
                    <div class="form-group col-md-4">
                        <label>Course</label>
                        <input type="text" name="" class="form-control rounded-0" value="<?php echo $course; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Curriculum</label>
                        <input type="text" name="" class="form-control rounded-0" value="<?php echo $ay; ?>">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="thisdiv">
                            <label for="code">Search Subject</label>
                            <div class="input-group">
                               <input type="text" class="form-control" id="code" placeholder="Subject Code" name="code" autocomplete="off" >
                                <span class="input-group-append">
                                    <label class="input-group-text"><a href="javascript:void(0)" id="cleartext"><i class="ik ik-x"></i></a></label>
                                </span>
                            </div>
                            
                            <div class="list-item-wrap">
                                <div id="result" style="max-height: 200px; overflow-x: hidden; background: #fff; display: relative;">
                                    
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <table class="w-100" border="1">
                            <thead class="text-center">
                                <th class="w-25">Subject Code</th>
                                <th>Subject Name</th> 
                                <th>Unit</th>
                                <th class="w-25">Action</th>
                            </thead>
                            <tbody class="text-center" id="student_subject_table">
                                <?php
                                require_once '../Library/Prospectus.php';
                                // echo $curlvl_id;
                                // die();
                                    $listofsubjects = $prospectus->prospectus_per_course($id,$curlvl_id,1);
                                       if ($listofsubjects->rowCount() > 0) {
                                            foreach ($listofsubjects as $ls) {
                                                echo '<tr>
                                                        
                                                        <td>'.$ls["subject_code"].'</td>
                                                        <td>'.$ls["subject_title"].'</td>
                                                        <td>'.$ls["units"].'</td>
                                                        <td><i class="ik ik-trash"></i></td>
                                                    </tr>';
                                            }
                                        }
                                ?>
                            </tbody>
                        </table> 
                    </div>  
                </div> 
	 	 	<?php
	 } 
}
elseif (isset($_POST['subid'])) { 
}

?>
<script>
    $(document).ready(function(){
        $('.student').on('click', function(){ 
            $('#student_result').hide();
            $('#search').val($(this).html());

            let id = $(this).data('index');
             alert(id);
            $.ajax({
                type: 'POST',
                url: 'backend_search_student.php',
                data: {id:id}, 
                success:function(data){
                   $('.main-loader').show();        
                    setTimeout(function(){
                        $('.main-loader').hide();
                        $('#result2').html(data);
                    }, 1000); 
                }
            });
        });
    });
</script>
<script type="text/javascript" src="test.js"></script>