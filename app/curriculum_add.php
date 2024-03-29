<?php
require_once '../Library/AcademicYear.php'; // Populate Academic Year
require_once '../Library/Course.php'; //Populate Course
require_once '../Library/Curriculum.php';

if (isset($_SERVER['PHP_SELF'])) {
    if (isset($_POST['save'])) {
       if ($curriculum->curriculum_add($_POST) == 1) {
           header('location: curriculum.php');
       }else{
            $message = 'Theres a problem adding new curriculum. Please try again';
       }
    }
}else{
    unset($message);
}
require_once 'layout/main.php';  ?>

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
                                            <h5>Add Curriculum</h5>
                                            <span>Add new curriculum form</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <a  href="curriculum.php" class="btn btn-info"><i class="ik ik-corner-up-left"></i>Back to Lists</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Curriculum Title</label> <span class="text-danger">*</span>
                                                <input type="text" class="form-control" id="title" placeholder="Curriculum Title" name="title" required="">
                                            </div>
                                        </div>                                     
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course">Course</label> <span class="text-danger">*</span>
                                                <select id="course" name="course" class="form-control" required="">
                                                    <option selected="" value="">Select Course</option>
                                                    <?php foreach ($listOfCourses as $course) {
                                                       echo '<option value="'.$course['id'].'">'.$course['course_title'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">                                  
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="academicyear">Academic Year</label> <span class="text-danger">*</span>
                                                <select id="academicyear" name="academicyear" class="form-control" required="">
                                                    <option selected="" value="">Select Academic Year</option>
                                                    <?php foreach ($academic_list as $academic) {
                                                       echo '<option value="'.$academic['id'].'">'.$academic['name'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label> <span class="text-danger">*</span>
                                                <select id="status" name="status" class="form-control" required="">
                                                    <option selected="" value="">Status</option>
                                                    <option value="1">Open</option>
                                                    <option value="0">Close</option>
                                                </select>
                                            </div>
                                        </div>  
                                    </div> 
                                    <button name="save" class="btn btn-success float-right" type="submit"><i class="ik ik-save"></i>Save</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once 'layout/footer.php'; ?>                
            </div>
        </div>

        <?php include 'layout/menu_modal.php'; ?>
        
        <?php require_once 'default_js_script.php'; ?>

        <script src="../plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
        <script src="../js/custom_alert.js"></script>
        <script>    
            <?php
                if (isset($message)) {
                    print('dangerAlert("'.$message.'");');                       
                }
            ?>
        </script> 
    </body>
</html>
