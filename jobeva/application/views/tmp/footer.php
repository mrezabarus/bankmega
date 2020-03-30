
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.9.0
    </div>
    <strong>Copyright &copy; 2017 <a href="#">HCMG &reg;</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-Success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-Success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- remember scroll -->
<script src="<?php echo base_url();?>template/bower_components/rz/jquery.rememberscroll.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>  
  $(document).scroll(function() {
    sessionStorage.scrollTop = $(window).scrollTop();
  });

  $(document).ready(function() {
    if (sessionStorage.scrollTop != "undefined") {
      $(window).scrollTop(sessionStorage.scrollTop); 
    }
  });
  //console.log($(this).scrollTop());
  console.log(sessionStorage.scrollTop);


  $('#datepicker').datepicker({
    autoclose: true
  })

  
  //alert(BrowserDetect.browser);
</script>
<!-- FastClick -->
<script src="<?php echo base_url();?>template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url();?>template/dist/js/demo.js"></script> -->
<!-- ORG CART -->
<script src="<?php echo base_url();?>assets/odcart/jquery.jOrgChart.js"></script>

<script>
$('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
</script>



<script>
  
    //$('#example1').DataTable()
    //list table tanpa button
    
    
    
    

    $('#example1').DataTable({
      
      "dom": '<"toolbar">frtip'
    })
    $("div.toolbar").html('<caption class="toolbar"><a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-default2" type="button">Add Employee</a></caption>');

    

    $('#readinesscareer').on('input', function () {
    
        var value = $(this).val();
       
       
          if ((value !== '') && (value.indexOf('.') === -1)) {
            $(this).val(Math.max(Math.min(value, 36), -36));
          }
        
    });

    /*$('#readinesscareer').keypress(function(event) {
      if(event.which < 46 || event.which >= 58 || event.which == 47) {
        event.preventDefault();

      }

      if(event.which == 46 && $(this).val().indexOf('.') != -1) {
        this.value = '' ;
      }  
    });*/
  
</script>

<script>
//$('#example1').DataTable()
    $('#example3').DataTable({
      "dom": '<"toolbars">frtip'
    })

    $("div.toolbars").html('<caption class="toolbar"><a href="#" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-default33" type="button">Add Successor</a></caption>');

</script>

<script type="text/javascript" src="<?php echo base_url();?>template/bower_components/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/bower_components/tooltipster-master/dist/js/tooltipster-scrollableTip.min.js"></script>

<!-- data table 2 -->
<script>  
    var example4 = $('#example4').DataTable({
      "pageLength": 5,
      "bStateSave": true
    });
    var example2 = $('#example2').DataTable({
      "pageLength": 5,
      "order": [],
      
      "bStateSave": true,
      "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
      },
      "fnStateLoad": function (oSettings) {
          return JSON.parse(localStorage.getItem('offersDataTables'));
      },
       "fnDrawCallback": function(){
          $('.tooltipsski').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/viewskilist/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          })

          $('.tooltipexpold').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/viewExpOld/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          })

          $('.tooltipseval').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/checkAtasan/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          });
      }
    });

    var examplenobutton = $('#examplenobutton').DataTable({
      "pageLength": 5,
      "bStateSave": true,
      "fnDrawCallback": function(){
           $('.tooltipsski').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/viewskilist/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          })
          $('.tooltipseval').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/checkAtasan/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          });
      }
    });


    var examplenobutton2 = $('#examplenobutton2').DataTable({
      "pageLength": 5,
      "bStateSave": true,
      "fnDrawCallback": function(){
           $('.tooltipsski').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/viewskilist/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          })
          $('.tooltipseval').tooltipster({
              content: 'Loading...',
              theme: 'tooltipster-noir',
              contentAsHTML: true,
              plugins: ['sideTip', 'scrollableTip'],
              functionBefore: function(instance, helper) {
                  
                  var $origin = $(helper.origin);
                  //var boxCount = $('#tot').text();

                  var tooltips = $origin.attr('data-tooltip-content');
                  // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
                  if ($origin.data('loaded') !== true) {

                      $.get('<?php echo base_url();?>index.php/talent/checkAtasan/'+tooltips, function(data) {

                          // call the 'content' method to update the content of our tooltip with the returned data.
                          // note: this content update will trigger an update animation (see the updateAnimation option)
                          instance.content(data);

                          // to remember that the data has been loaded
                          $origin.data('loaded', true);
                      });
                  }
              }
          });
      }
    });


    
    $('#datepicker').datepicker({
      autoclose: true
    })
   
  
</script>

<script>
  $("#sEmployee").keyup(function(){
    var keyword = $(this).val();

    if ($(this).val().length > 3) {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/talent/sEmployee",
        data:'keyword='+keyword,
        beforeSend: function(){
          $("#sEmployee").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#sEmployee").css("background","#FFF");

        }
      });
    }
  });

  //To select employee name
  /*function selectEmployee(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
    $("#addKeterangan").show();
  }

  function selectEmployees(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
    $("#addKeterangan").show();
  }*/
  
</script>
<script>
  function countChar(val) {
    var len = val.value.length;
    if (len >= 50) {
      //val.value = val.value.substring(0, 500);
      $(".inputDisableds").removeAttr("disabled");
    } else {
      //$('#charNum').text(50 - len);
    }
  };
</script>
<script>
  /*var count = $("#keterangan").val().length;
  console.log(count);*/
  

  
</script>

<script>
  $("#addEmployeeSuccesslist").click(function(){
    var nip = $("#sEmployees").val();
    
    var inputnip= nip.substr(0, nip.indexOf('-')); 
    var keterangan = $("#keterangan").val();

    //alert(streetaddress);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php/talent/addEmployeeSuccesslist",
      //url: "addEmployeetalentlist",
      data:'nip='+inputnip+'&keterangan='+keterangan,
      success: function(){
        alert("Success");
        window.location.reload();  
      }
    });
  });

  $("#addEmployeeSuccesslistVacPos").click(function(){
    var nip = $("#sEmployees").val();
    var pos = $("#pos").val();
    
    var inputnip= nip.substr(0, nip.indexOf('-')); 
    var keterangan = $("#keterangan").val();

    //alert(streetaddress);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php/talent/addEmployeesuccesslistvacpos",
      //url: "addEmployeetalentlist",
      data:'nip='+inputnip+'&pos='+pos+'&keterangan='+keterangan,
      success: function(){
        alert("Success");
        window.location.reload();  
      }
    });
  });

  
</script>

<script>
  $("#sEmployees").keyup(function(){
    if ($(this).val().length > 5) {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/talent/sEmployeeS",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#sEmployees").css({
                            "background":"#FFF url(../../assets/tenor.gif) no-repeat 165px"
                          });
        },
        success: function(data){
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#sEmployees").css("background","#FFF");
        }
      });
    }
  });

  
</script>

<!-- menampilkan cart organisasi-->
<script>
$("#org").jOrgChart({
    chartElement : '#chart',
    dragAndDrop  : false
});
</script>



<!-- change password -->
<script>
$('#chgpwd').click(function() { 
   
  var id_user = $("#id_user").val();
  var pwd1 = $("#pwd1").val();
  var pwd2 = $("#pwd2").val();


  if(pwd1 != pwd2){
    alert("Password Tidak Sama");
  }
  else{
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php/talent/changepwd",
      data:'pwd1='+pwd1+'&pwd2='+pwd2+'&id_user='+id_user,
      success: function(response){
        alert("Success");
        window.location.reload();  
      }
    });
  }
  
});
</script>

<!--function potensi -->
<script>
function countPotensiSatu()
{
  
  var potensi = 0;
  var a1 = $("input[name='a1']:checked").val();
  
}

function countPotensiDua()
{
  var potensi = 0;
  var a2 = $("input[name='a2']:checked").val();
  
}

function countPotensiTiga()
{
  var potensi = 0;
  var a3 = $("input[name='a3']:checked").val();
  
}

function countTotalPotensi()
{
  var a1 = $("input[name='a1']:checked").val();
  var a2 = $("input[name='a2']:checked").val();
  var a3 = $("input[name='a3']:checked").val();
  var nip = $('#nip').val();
  
  $.ajax({
      type: "POST",
      url: "checkPotensi",
      data:'a1='+a1+'&a2='+a2+'&a3='+a3+'&nip='+nip,
      
      success: function(data){
        $("#potentialScore").html(data); 
        

      }
    });

  //$("#potentialScore").text(countPotesiAll);
}
$().ready(function(){
    $("input[type='radio']").change(function(){
        
        countPotensiSatu();
        countPotensiDua();
        countPotensiTiga();
        
        countTotalPotensi();


    });
});
</script>

<script>
function countPotensiSatuNE()
{
  
  var potensi = 0;
  var a1NE = $("input[name='a1NE']:checked").val();
  
}

function countPotensiDuaNE()
{
  var potensi = 0;
  var a2NE = $("input[name='a2NE']:checked").val();
  
}

function countPotensiTigaNE()
{
  var potensi = 0;
  var a3NE = $("input[name='a3NE']:checked").val();
  
}

function countTotalPotensiNE()
{
  var a1NE = $("input[name='a1NE']:checked").val();
  var a2NE = $("input[name='a2NE']:checked").val();
  var a3NE = $("input[name='a3NE']:checked").val();
  var nip = $('#nip').val();
  
  $.ajax({
      type: "POST",
      url: "checkPotensiNe",
      data:'a1='+a1NE+'&a2='+a2NE+'&a3='+a3NE+'&nip='+nip,
      
      success: function(data){
        $("#potentialScoreNE").html(data); 
        

      }
    });

  //$("#potentialScore").text(countPotesiAll);
}
$().ready(function(){
    $("input[type='radio']").change(function(){
        
        countPotensiSatuNE();
        countPotensiDuaNE();
        countPotensiTigaNE();
        
        countTotalPotensiNE();


    });
});
</script>


<script>
function countPotensiSatuED()
{
  
  var potensi = 0;
  var a1ED = $("input[name='a1ED']:checked").val();
  
}

function countPotensiDuaED()
{
  var potensi = 0;
  var a2ED = $("input[name='a2ED']:checked").val();
  
}

function countPotensiTigaED()
{
  var potensi = 0;
  var a3ED = $("input[name='a3ED']:checked").val();
  
}

function countTotalPotensiED()
{
  var a1ED = $("input[name='a1ED']:checked").val();
  var a2ED = $("input[name='a2ED']:checked").val();
  var a3ED = $("input[name='a3ED']:checked").val();
  var nip = $('#nip').val();
  
  $.ajax({
      type: "POST",
      url: "checkPotensiED",
      data:'a1='+a1ED+'&a2='+a2ED+'&a3='+a3ED+'&nip='+nip,
      
      success: function(data){
        $("#potentialScoreED").html(data); 
        

      }
    });

  //$("#potentialScore").text(countPotesiAll);
}
$().ready(function(){
    $("input[type='radio']").change(function(){
        
        countPotensiSatuED();
        countPotensiDuaED();
        countPotensiTigaED();
        
        countTotalPotensiED();


    });
});
</script>

<script>
$('#savePotensi').click(function() { 
    var a1 = $("input[name='a1']:checked").val();
    var a2 = $("input[name='a2']:checked").val();
    var a3 = $("input[name='a3']:checked").val();
    var nip = $('#nip').val();
    var evaluator = $('#evaluator').val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php/talent/savePotensi",
      data:'a1='+a1+'&a2='+a2+'&a3='+a3+'&nip='+nip+'&evaluator='+evaluator,
      success: function(){
        alert("Success");
        window.location.reload();  
      }
    });
});

$('#savePotensiEligible').click(function() { 
    var a1ED = $("input[name='a1ED']:checked").val();
    var a2ED = $("input[name='a2ED']:checked").val();
    var a3ED = $("input[name='a3ED']:checked").val();
    var nip = $('#nip').val();
    var evaluator = $('#evaluator').val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php/talent/savePotensiEd",
      data:'a1='+a1ED+'&a2='+a2ED+'&a3='+a3ED+'&nip='+nip+'&evaluator='+evaluator,
      success: function(){
        alert("Success");
        window.location.reload();  
        event.preventDefault();
        $('#myTab a:last').tab('show');
      }
    });
});


$('#savePotensi-notEligible').click(function() { 
    var a1NE = $("input[name='a1NE']:checked").val();
    var a2NE = $("input[name='a2NE']:checked").val();
    var a3NE = $("input[name='a3NE']:checked").val();
    var nip = $('#nip').val();
    var evaluator = $('#evaluator').val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>index.php/talent/savePotensi",
      data:'a1='+a1NE+'&a2='+a2NE+'&a3='+a3NE+'&nip='+nip+'&evaluator='+evaluator,
      success: function(){
        alert("Success");
        window.location.reload();  
        event.preventDefault();
        $('#myTab a:last').tab('show');
      }
    });
});
</script>
<!-- end of function potensi-->



<script>
$(document).on("click", ".open-AddNipDialog", function () {
     var nip = $(this).data('id');
     $(".modal-body #nip").val( nip );
});
</script>

<script>
$('table.ninebox td.data').each(function(a,b){
    $(b).click(function(){
         //$('table td').css('background','#E4E4E4');
         $('table td.data').css('background','#FFF');
         /*$('table td.datas').hover(function(){$(this).css("background","yellow")});*/

         $(this).css('background','#3399FF');   
         
    });
});

$('.data').click(function() {
    $('input[name=a1]', this).prop("checked",true);
    $('.data').removeClass('hli');
    $(this).addClass('hli');
});

$('table.ninebox td.data2').each(function(a,b){
    $(b).click(function(){
         //$('table td').css('background','#E4E4E4');
         $('table td.data2').css('background','#FFF');
         /*$('table td.datas').hover(function(){$(this).css("background","yellow")});*/

         $(this).css('background','#3399FF');   
         
    });
});

$('.data2').click(function() {
    $('input[name=a2]', this).prop("checked",true);
    $('.data2').removeClass('hli');
    $(this).addClass('hli');
});

$('table.ninebox td.data3').each(function(a,b){
    $(b).click(function(){
         //$('table td').css('background','#E4E4E4');
         $('table td.data3').css('background','#FFF');
         /*$('table td.datas').hover(function(){$(this).css("background","yellow")});*/

         $(this).css('background','#3399FF');   
         
    });
});

$('.data3').click(function() {
    $('input[name=a3]', this).prop("checked",true);
    $('.data3').removeClass('hli');
    $(this).addClass('hli');
});
</script>

<script>
$('#modal-default-upd-potensi').on("shown.bs.modal",function(e){
   $(this).hide().show(); 
   e.preventDefault();
});


$('#modal-default-not-eligible-emp').on("hidden.bs.modal",function(){
   $(this).find('form')[0].reset();
});

$('#modal-default-not-eligible-emp').on("hidden.bs.modal",function(){
   $(this).find('form')[0].reset();
});

$('#modal-default22').on('hidden.bs.modal', function () {
     location.reload();
});

$('#modal-development-edit').on('hidden.bs.modal', function () {
     location.reload();
});

$('#modal-default').on("shown.bs.modal",function(){
   $(this).hide().show();
   $(this).find('form')[0].reset(); 
});

$('#modal-default11').on('shown.bs.modal', function () {
     $(this).hide().show(); 
});


$('#modal-default2').on('hidden.bs.modal', function () {
     parent.location.reload();
});

$('#modal-default-list-alasan').on('hidden.bs.modal', function () {
     location.reload();
});


$('#modal-viewOthers').on('shown.bs.modal', function () {
     $(this).hide().show(); 
});

$('#modal-development-add').on('shown.bs.modal', function () {
     $(this).hide().show();
});


$('#modal-development-view').on('hidden.bs.modal', function () {
     location.reload();
});

$('#modal-defaultsp1').on('hidden.bs.modal', function () {
     location.reload();
});

$('#modal-box').on("shown.bs.modal",function(){
   $(this).hide().show(); 
});
</script>

<script>
$(document).on("click", ".open-AddNipDialog ", function () {
     var nip = $(this).data('id');
     $(".modal-body #nip").val( nip );
});
</script>


<script>
$('#saveCareerPlan').click(function() { 
    var nip = $("#nip").val();
    var cartype = $('select[name=cartype]').val()
    var careerplan = $("#careerplan").val();
    var readinesscareer = $("#readinesscareer").val();
    var idadd = $("#idadd").val();

    if(readinesscareer>36){
      alert("Maksimal 36 Bulan");
    }
    else{
      console.log(nip);
      console.log(cartype);
      console.log(careerplan);
      console.log(readinesscareer);
      console.log(idadd);
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/talent/saveCarPlan",
        data:'nip='+nip+'&careerplan='+careerplan+'&cartype='+cartype+'&readinesscareer='+readinesscareer+'&idadd='+idadd,
        success: function(){
          alert("Success");
          window.location.reload();  
        }
      });
    }
    $("form").trigger("reset");
    
});
</script>

<script>


/*$(window).on('load', function() {
 $(".se-pre-con").fadeOut("slow");
});*/

/*$(".se-pre-con").fadeOut(1000, function() {
    $(".wrapper").fadeIn(3000);        
});*/

$(window).on('load', function() { // makes sure the whole site is loaded 
  $('.se-pre-con').fadeOut(); // will first fade out the loading animation 
  $('#wrapper').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(350).css({'overflow':'visible'});
});

function ConfirmDelete(){
    if (confirm("Delete Account?")){
          return true;
    }
    else {
       alert('sorry');
       return false;
    }
}  
</script>

<script>
$('#searchnoteligible').click(function() {
    var keyword = $("#keyword").val();

    if(keyword==''){
      alert("please input keyword..");
    }else{
      $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>index.php/talent/searchNotEligible",
          data:'keyword='+keyword,
          
          success: function(response) {
              $('#showresults').html(response);
          }               
      });  
    }
    
});
</script>

</body>
</html>
