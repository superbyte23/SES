<?php require_once 'layout/main.php'; require_once '../Library/Student.php'; ?>
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
                                        <i class="fa fa-users bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Student Tables</h5>
                                            <span>List of Students</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <a href="student_add.php" class="btn btn-success"><i class="ik ik-plus"></i>Add Student</a>
                                        <button id="delete" type="button" class="btn btn-danger"><i class="ik ik-trash"></i>Delete Student(s)</button>
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
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                foreach ($student_list as $student) {
                                            ?>
                                                <tr>
                                                    
                                                    <td> 
                                                            <input type="checkbox" class="select_all_child" id="" name="check[]" value="<?php echo $student['id']; ?>"> 
                                                    </td>
                                                    <!-- <td><img src="../img/users/1.jpg" class="table-user-thumb" alt=""></td> -->
                                                    <td><?php echo $student['last_name'].', '.$student['first_name'].' '.$student['middle_name']; ?></td>
                                                    <td><?php echo $student['address']; ?></td>
                                                    <td class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#student_info" data-index="<?php echo $student['id']; ?>"  class="text-info student_info"><i class="ik ik-eye"></i></a>
                                                        <a href="student_edit.php?id=<?php echo $student['id'] ?>" class="text-primary"><i class="ik ik-edit"></i></a>
                                                        <a href="student_delete.php?id=<?php echo $student['id'] ?>" class="text-danger"><i class="ik ik-trash"></i></a>
                                                        
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
        <div class="modal fade edit-layout-modal" id="student_info" tabindex="-1" role="dialog" aria-labelledby="editLayoutItemLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="result">
                        
                    </div>
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
                $('.student_info').on('click', function(){
                    let id = $(this).data('index');
                    let model = "student";
                    $.ajax({
                        type: 'POST',
                        data: {id:id, model:model},
                        url:'backend_info.php',
                        success:function(html){
                            $('#result').html(html);
                        }

                    });
                });
            });
        </script>
    </body>
</html>
