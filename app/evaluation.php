<?php 

// require_once '../Library/AcademicYear.php';
require_once 'layout/main.php'; 
?>
    <body>
        <div class="wrapper">
           <?php require_once 'layout/header.php'; ?>
            <div class="page-wrap">
                <?php require_once 'layout/sidebar.php'; ?>
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="card">
                            <div id="evaluation">
                                <div class="card-header bg-purple"><h3 class=" text-white"><i class="ik ik-user"></i> Student Add Subject Form</h3></div>
                                <div class="card-body">
                                    <form class="forms-sample">
                                        <div class="row">                                           
                                            <div class="form-group col-md-12">
                                                <h5>Search Student : Id/Name</h5>
                                                <input type="text" name="" class="form-control rounded-0" id="search" placeholder="Enter Student" autocomplete="off">
                                                <div id="student_result" class="list-group " >
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div id="result2">
                                            <div class="main-loader">
                                              <div class="loader"></div>
                                            </div>
                                        </div>
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
        <script src="../plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
        <script src="../js/custom_alert.js"></script>
        <script src="../js/datatables.js"></script>
        <!-- <style type="text/css">
             #result{
                   width: 97%; 
                    z-index: 1000;  
                    margin: 0 auto;
                } 
        </style> -->
        <script>
            $(document).ready(function(){
                $('#delete').click(function(){
                     $("#target").submit();                                      
                });
                $('.main-loader').hide();
                $('#search').on('keyup', function(){
                    let filter = $(this).val(); 
                    if (!filter) {
                        $('#student_result').hide();
                    }else{
                        $.ajax({
                        type: 'POST',
                        url: 'backend_search_student.php',
                        data: {filter:filter},
                        success:function(html){
                            $('#student_result').show();
                            $('#student_result').html(html);
                        }
                    });
                    }
                });
            });
        </script>
        <style type="text/css">
            
        </style>
        <script type="text/javascript" src="test.js"></script>
         
    </body>
</html>
