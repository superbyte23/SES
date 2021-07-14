<?php 

require_once '../Library/Curriculum.php';
require_once 'layout/main.php'; 
?>
<style>
    .link:hover{
      text-decoration: underline;
    }
</style>
    <body>
        <div class="wrapper">
           <?php require_once 'layout/header.php'; ?>

            <div class="page-wrap">
                <?php require_once 'layout/sidebar.php'; ?>
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-credit-card bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Curriculum Tables</h5>
                                            <span>List of Curriculum</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <a href="curriculum_add.php" class="btn btn-success"><i class="ik ik-plus"></i>Add Curriculum</a>
                                        <button id="delete" type="button" class="btn btn-danger"><i class="ik ik-trash"></i>Delete Curriculum(s)</button>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                               <div class="dt-responsive">
                                <form method="post" action="test" id="target">
                                    <table id="scr-vtr-dynamic"
                                                   class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th class="nosort" width="10"> 
                                                        <input type="checkbox" id="selectall" name="check[]"> 
                                                    </label>
                                                </th>
                                                <!-- <th class="nosort">Avatar</th> -->
                                                <th>Curriculum Title</th>
                                                <th>Course</th>
                                                <th>Academic Year</th>
                                                <th>Prospectus</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                foreach ($curriculum_list as $curriculum) {
                                            ?>
                                                <tr>
                                                    
                                                    <td> 
                                                            <input type="checkbox" class="select_all_child" id="" name="check[]" value=""> 
                                                    </td> 
                                                    <td><a class="link" href="curriculum_details.php?id=<?php echo $curriculum['id'];?>"><?php echo $curriculum['curriculum_title'];?></a></td>
                                                    <td><?php echo $curriculum['course_title'];?></td>
                                                    <td><?php echo $curriculum['name'];?></td>
                                                    <td><a href="curriculum_prospectus.php?id=<?php echo $curriculum['id'];?>&cpid=<?php echo $curriculum['id'];?>" class="badge badge-info mb-1 block"><i class="ik ik-book"></i> View</a></td>
                                                    <td><?php echo $curriculum['status'] == 1? '<span class="badge badge-pill badge-success mb-1">Open</span>' : '<span class="badge badge-pill badge-danger mb-1">Close</span>'; ?></td> 
                                                    <td class="text-center">
                                                        <!-- <a href="#" data-toggle="modal" data-target="#student_info"  class="text-info"><i class="ik ik-eye"></i></a> -->
                                                        <a href="curriculum_edit.php?id=<?php echo $curriculum['id'];?>" class="text-primary"><i class="ik ik-edit"></i></a>
                                                        <a href="curriculum_delete.php?id=<?php echo $curriculum['id'];?>" class="text-danger"><i class="ik ik-trash"></i></a>
                                                        
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php require_once 'layout/footer.php'; ?>
                
            </div>
        </div>
        <?php require 'info.php'; ?>
        <?php include 'layout/menu_modal.php'; ?>
        
        <?php require_once 'default_js_script.php'; ?>
        <script src="../js/datatables.js"></script>
        <script>
            $(document).ready(function(){
                $('#delete').click(function(){
                     $("#target").submit();                                      
                });
            });
        </script>
    </body>
</html>
