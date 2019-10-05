    
	<div class="container-fluid">

          <!-- Page Heading -->
         
          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-12 col-lg-7">

              <!-- Area Chart -->
			  <!--
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                  <hr>
                    </div>
              </div>
			  -->

              <!-- Bar Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disease Chart(Population Wise)</h6>
                </div>
                <div class="card-body">
                 
<div id="columnchart_values"></div>
                
                
                </div>
              </div>

            </div>

            <!-- Donut Chart -->
			<!--
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
               
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                </div>
               
                <div class="card-body">
                  <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <hr>
                  Styling for the donut chart can be found in the <code>/js/demo/chart-pie-demo.js</code> file.
                </div>
              </div>
            </div>
			-->
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
	   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	   <?php include('footer.php');?>
  <script type="text/javascript">
  
  $.ajax({
	 
	  url:"AdminDashboard/getDiseaseDetails",
	  dataType: 'json',
	   method:'POST',
	  async:true,
	  success: function(data){
		  console.log(data);
		  
		  
		google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(function() {drawChart(data); });
    function drawChart(data)
	{
		var dataval = [];
		   dataval.push (["Disease","Total (in %)"]);
		  
		  for(var i=0;i<data.length;i++)
		  {
			var tempdata = [];
			let total = parseInt(data[i]['total']);
			tempdata.push(data[i]['disId']);
			tempdata.push(total);
			dataval.push(tempdata);
		  }
		var data = google.visualization.arrayToDataTable(dataval);
      /*var data = google.visualization.arrayToDataTable([
        ["Disease", "Percentage(in %)", { role: "style" } ],
        [disId, 15, "#b87333"],
        ["Dengue", 10.49, "silver"],
        ["TuberCulosis", 19.30, "gold"],
        ["Typhoid", 21.45, "color: #e5e4e2"]
      ]);*/

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);

      var options = {
        title: "Disease ratio (in %)",
        width: 1000,
        height: 400,
		vAxis: {title:'Total Population (in %)',viewWindow : {min: 0, max: 100}},
		hAxis: {title:'Diseases'},
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  
	} // End of Success
	  
	  
  });
    
  </script>
      <!-- End of Main Content -->

      <!-- Footer -->
    