<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/jquery/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap-4.2/js/bootstrap.min.js"></script>
    
    <script src="<?php echo base_url();?>assets/js/holder.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>

    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/Chart.js/dist/Chart.min.js"></script>
    <script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
      $('#example').DataTable();

      $(".nav-tabs a").click(function(){
        $(this).tab('show');
      });
      $('#tabs-list').click(function () {
          location.reload();
      });

      /*TAB REFRESH AFTER JQUERY POST AJAX*/
      $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
      });
      $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
      });
      var hash = window.location.hash;
      $('#myTab a[href="' + hash + '"]').tab('show');
    });

    
    </script>

    
    </body>
</html>
