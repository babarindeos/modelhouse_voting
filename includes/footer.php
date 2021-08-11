
 <!-- /End your project here-->
     <div class="container-fluid" style='background-color:#000000;color:#ffffff;' id='footer' >
          <div class="row">
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 py-2' >&copy; <?php echo date('Y') ?> The Official House of CEO. All rights reserved.</div>
          </div>
     </div>

 <!-- SCRIPTS -->
 <!-- JQuery -->
 <script type="text/javascript" src="<?php echo $baseUrl; ?>lib/js/jquery-3.3.1.min.js"></script>
 <!-- Bootstrap tooltips -->
 <script type="text/javascript" src="<?php echo $baseUrl; ?>lib/js/popper.min.js"></script>
 <!-- Bootstrap core JavaScript -->
 <script type="text/javascript" src="<?php echo $baseUrl; ?>lib/js/bootstrap.min.js"></script>
 <!-- MDB core JavaScript -->
 <script type="text/javascript" src="<?php echo $baseUrl; ?>lib/js/mdb.min.js"></script>

 <!-- DataTables JS -->
 <script src="<?php echo $baseUrl; ?>lib/js/addons/datatables.min.js" type="text/javascript"></script>


 <!-- DataTables Select JS -->
 <script src="<?php echo $baseUrl; ?>lib/js/addons/datatables-select.min.js" type="text/javascript"></script>


 <script>
       // SideNav Button Initialization
       $(".button-collapse").sideNav({
         breakpoint: 1200
       });
       // SideNav Scrollbar Initialization
       var sideNavScrollbar = document.querySelector('.custom-scrollbar');
       var ps = new PerfectScrollbar(sideNavScrollbar);
 </script>
</body>

</html>
