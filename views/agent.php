<?php 
require 'html-parts/header.php';
require '../controllers/getSingleAgentName.php';

?>
<div class="container-fluid">
  <div class="row">
    <?php require 'html-parts/navigation.php';?>

     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo $agentName;?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
           </div>
           <div class="row">
            <div class="col-5">
              <h4>Воронка набора</h4>
              <div id="funnel-1-date-picker" class="date-picker hidden">
                <p>С <input id="date-from" type="date" value="2022-01-01"> по <input id="date-to" type="date" value="<?php echo date('Y-m-d');?>"> <button id="search">Построить</button></p>
              </div>
              <div class="data-box">
                <div class="funnel"></div>
              </div>
            </div>
            <div class="col-5">
              <h4>Воронка продаж</h4>
              <div class="data-box">
                <div class="funnel2"></div>
              </div>
            </div>
            <div class="col-2">
              <h4>Объекты</h4>
              <div class="data-box">
                <p>Квартиры</p>
                <p></p>
              </div>
              <div class="data-box">
                <p>Дома и участки</p>
                <p></p>
              </div>
              <div class="data-box">
                <p>Коммерция</p>
                <p></p>
              </div>
            </div>            
           </div>
           <div class="row">
             
           </div>


      </main>

  </div>
</div>
<?php 
require 'html-parts/footer.php';
?>
<script type="text/javascript" src="../controllers/js/agentDataLoader.js"></script>
<script type="text/javascript">
  $("#search").on('click', function() {
    console.log('Yo');
  });

</script>
</body>
</html>