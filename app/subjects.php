<?php 

require_once '../Library/Subject.php';
require_once 'layout/main.php'; 
?>
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
                                            <h5>Subjects Tables</h5>
                                            <span>List of Subjects</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <a href="subject_add.php" class="btn btn-success"><i class="ik ik-plus"></i>Add Subject</a>
                                        <button id="delete" type="button" class="btn btn-danger"><i class="ik ik-trash"></i>Delete Subject(s)</button>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                               <div class="dt-responsive">
                                <form method="post" action="test" id="target">
                                    <table id="scr-vtr-dynamic"
                                           class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="nosort" width="10"> 
                                                        <input type="checkbox" id="selectall" name="check[]"> 
                                                    </label>
                                                </th>
                                                <!-- <th class="nosort">Avatar</th> -->
                                                <th>Code</th>
                                                <th>Subject Title</th>
                                                <th>Units</th>
                                                <th>Prerequisite</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                foreach ($subject_list as $subject) {
                                            ?>
                                                <tr>
                                                    
                                                    <td> 
                                                            <input type="checkbox" class="select_all_child" id="" name="check[]" value=""> 
                                                    </td>
                                                    <!-- <td><img src="../img/users/1.jpg" class="table-user-thumb" alt=""></td> -->
                                                    <td><?php echo $subject['subject_code'];?></td>
                                                    <td><?php echo $subject['subject_title'];?></td>
                                                    <td><?php echo $subject['units'];?></td>
                                                    <td><?php echo $subject['prerequisite'];?></td>
                                                    <td class="text-center">
                                                        <a href="#" class="text-info subject_info" data-index="<?php echo $subject['id']; ?>" data-toggle="modal" data-target="#subject_info"><i class="ik ik-eye"></i></a>
                                                        <a href="subject_edit.php?id=<?php echo $subject['id'];?>" class="text-primary"><i class="ik ik-edit"></i></a>
                                                        <a href="subject_delete.php?id=<?php echo $subject['id'];?>" class="text-danger"><i class="ik ik-trash"></i></a>
                                                        
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
        <div class="modal fade edit-layout-modal" id="subject_info" tabindex="-1" role="dialog" aria-labelledby="editLayoutItemLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="result"></div>
                </div>
            </div>
        </div>
        <?php include 'layout/menu_modal.php'; ?>
        
        <?php require_once 'default_js_script.php'; ?>
        <script src="../js/datatables.js"></script>
        <script>
            $(document).ready(function(){

                $('#delete').click(function(){
                     $("#target").submit();                                      
                }); 
            });
            $(document).ready(function(){
                $('.subject_info').on('click', function(){
                    let id = $(this).data('index'); 
                    let model = "subject";
                    $.ajax({
                        type: 'POST',
                        url: 'backend_info.php',
                        data: {id:id, model:model},
                        success:function(html){
                            $('#result').html(html);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
