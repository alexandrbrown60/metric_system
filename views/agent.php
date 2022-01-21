<?php 
require 'html-parts/header.php';
require '../controllers/getSingleAgent.php';

?>
<div class="container-fluid">
  <div class="row">
    <?php require 'html-parts/navigation.php';?>

     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo $agentName;?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Экспорт</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Дата
              </button>
            </div>
           </div>
           <div class="row">
            <div class="col-3">
              <h4>Последние данные: <?php echo $date;?></h4>
              <div class="data-box">
                <table class="table">
                  <tbody>
                    <?php
                      foreach($displayTable as $key => $value) {
                        echo "<tr><td>";
                        echo "$key</td><td>";
                        echo "$displayTable[$key]</td></tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-4">
              <h4>Воронка набора</h4>
              <div class="flex">
                <div class="funnel"></div>
              </div>
            </div>
            <div class="col-1"></div>
            <div class="col-4">
              <h4>Воронка продаж</h4>
              <div class="flex">
                <div class="funnel2"></div>
              </div>
            </div>            
           </div>


      </main>

  </div>
</div>
<?php 
require 'html-parts/footer.php';
?>
<script type="text/javascript">
  var data1 = {
            labels: ['Исходящие', 'Встречи'],
            colors: ['#FFB178', '#FF3C8E'],
            values: [<?php echo $displayTable['Исходящие'];?>, <?php echo $displayTable['Встречи'];?>]
        };

  var graph = new FunnelGraph({
      container: '.funnel',
      gradientDirection: 'horizontal',
      data: data1,
      displayPercent: true,
      direction: 'vertical',
      width: 300,
      height: 600,
      subLabelValue: 'raw'
  });

  graph.draw();

  //second graph
  var data2 = {
    labels: ['Входящие', 'Показы', 'Задатки', 'Сделки'],
    colors: ['#FFB178', '#FF3C8E'],
    values: [<?php echo $displayTable['Входящие'];?>, 
              <?php echo $displayTable['Презентации'];?>, 
              <?php echo $displayTable['Задатки'];?>, 
              <?php echo $displayTable['Сделки'];?>
              ]
  };
  var graph2 = new FunnelGraph({
      container: '.funnel2',
      gradientDirection: 'horizontal',
      data: data2,
      displayPercent: true,
      direction: 'vertical',
      width: 300,
      height: 600,
      subLabelValue: 'raw'
  });

  graph2.draw();
</script>
</body>
</html>