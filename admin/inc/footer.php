            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer bg-white text-center">
                All Rights Reserved by Clipping Path House. Designed and Developed by <a href="http://arif-hossain.epizy.com" target="_blank">Arif Hossain</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--Datatables -->
    <script src="assets/js/datatables.min.js"></script>
    <!--Country Time -->
    <script src="assets/js/jClocksGMT.js"></script>
    <script src="assets/js/jquery.rotate.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.js"></script>
    <script>
         $(document).ready(function(){

                $('#clock_hou').jClocksGMT(
                {
                    title: 'USA TIME', 
                    offset: '-6',
                    skin: 5
                });

                $('#clock_india').jClocksGMT(
                {
                    title: 'GERMANY TIME', 
                    offset: '+1', 
                    skin: 5 
                    
                });

                $('#clock_korea').jClocksGMT(
                {
                    title: 'AUSTRALIA TIME', 
                    offset: '+10', 
                    skin: 5
                });

                $('#clock_uk').jClocksGMT(
                {   
                    title: 'UK TIME', 
                    offset: '+0', 
                    skin: 5
                });

                $('#clock_tokyo').jClocksGMT(
                {
                    title: 'ITALY TIME',
                    offset: '+1',
                    skin: 5
                });

            });

        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

</body>

</html>