<?php 
require 'html-parts/header.php';
?>
    <div class="container-fluid">
    	<div class="row">
        <?php require 'html-parts/navigation.php';?>

    	   <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <table class="table">
              <thead>
                <tr>
                  <th>ФИО</th>
                  <th>ID группы</th>
                  <th>Статус<th>
                  <th>Действие</th>
                </tr>
              </thead>
              <tbody id="all-agents-table">
                
              </tbody>
            </table>
        </main>


        
    	</div>
    </div>
<?php 
require 'html-parts/footer.php';
?>
<script type="text/javascript">
  let url = "https://kluch.me/kluch_metrics/controllers/getAgents.php";
  let table = "#all-agents-table";
  getData(url, table);
</script>
</body>
</html>