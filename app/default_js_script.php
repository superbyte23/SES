        <script src="../plugins/jquery/jquery-3.4.1.js"></script> 
        <script src="../plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../plugins/screenfull/dist/screenfull.js"></script>
        <script src="../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script> 
        <script src="../plugins/moment/moment.js"></script>        
        <script src="../plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="../js/tables.js"></script>  
        <script src="../dist/js/theme.min.js"></script>  
        <script>
            $(document).ready(function(){
                $('.modal').on('show.bs.modal', function (e){
                    $('body').addClass('no-scroll');
                });

                 $('.modal').on('hidden.bs.modal', function (e){
                    $('body').removeClass('no-scroll');
                });
            });
        </script>