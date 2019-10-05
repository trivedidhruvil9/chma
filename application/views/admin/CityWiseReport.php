    
	<div class="container-fluid">

          <!-- Page Heading -->
         
          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-12 col-lg-7">
			<div class="form-group">
  <label for="sel1">Select State</label>
 
<input type="hidden" name="country" id="countryId" value="IN"/>
<select name="state" class="col-sm-4 form-control states order-alpha" id="stateId">
    <option value="">Select State</option>
</select>
</div>
<div class="form-group">
  <label for="sel1">Select City</label>
  
<select name="city"  class="col-sm-4 form-control cities order-alpha" id="cityId">
    <option value="" >Select City</option>
</select>
</div>
 <script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="//geodata.solutions/includes/statecity.js"></script>
             
              <div class="card shadow mb-4" style="margin-left:20px;">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Disease Chart(All Population) [City Wise]</h6>
                </div>
                <div class="card-body">
                 
<div id="columnchart_values" style="margin-top:10px"></div>
                
                
                </div>
              </div>

            </div>
			

            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
	   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	   <?php include('footer.php');?>
	   <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>
$(document).ready(function(){
	Pusher.logToConsole = true;
	call();
	function call()
	{


getNotification();
	}
    var pusher = new Pusher('e35ea8ce3cd57f27702e', {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      if(data.message=='success')
	  {
		  	call();
	  }
	  else
	  {
		  	call();
	  }
    });
	$("#cityId" ).change(function() {
 getData();
});
	function getNotification()
	{
		$.ajax({
	 
	  url:"AdminDashboard/getDiseaseDetails",
	  dataType: 'json',
	   method:'POST',
	  async:true,
	  success: function(data){
		  console.log(data);
		  for(var i=0;i<data.length;i++)
		  {
			  //alert(data[i].total)
			if(data[i].total>40)
			{
				var d = new Date();
				var t = ' <a class="dropdown-item d-flex align-items-center" href="#">'+
                 ' <div class="mr-3">'+
                    '<div class="icon-circle bg-primary">'+
                     ' <i class="fas fa-file-alt text-white"></i>'+
                   ' </div>'+
                  '</div>'+
                  '<div>'+
                  '  <div class="small text-gray-500">'+d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear()+'</div>'+
                   ' <span class="font-weight-bold">'+data[i].disId+' is in Critical Condition.</span>'+
                 ' </div>'+
               ' </a>';
			   $("#alertdata").append(t);
			}
		  }
		  
		}});
	}

  
	  
	  

    
	function getData()
	{
		var city = $('#cityId').val();
		var state = $('#stateId').val();
		//alert(city);
		//alert(state);
  $.ajax({
	 
	  url:"CityWiseReport/getCityWiseDetails",
	  dataType: 'json',
	   method:'POST',
	  async:true,
	  data:{city:city,state:state},
	  success: function(data)
	  {
		  console.log(data);
		  
		 // alert(data);
		google.charts.load("current", {'packages':['bar']});
    google.charts.setOnLoadCallback(function() {drawChart(data); });
    function drawChart(data)
	{
		var dataval = [];
		   dataval.push (["Disease","Cured","UnCured", { role: "style" }, { role: 'annotation' }, { role: 'annotation' }]);
		  
		  for(var i=0;i<data.length;i++)
		  {
			var tempdata = [];
			let total = parseInt(data[i]['total']);
			tempdata.push(data[i]['disId']);
			//tempdata.push(total);
			tempdata.push(parseInt(data[i]['totalcure']));
			tempdata.push(parseInt(data[i]['totaluncure']));
			if(total < 40) {
				tempdata.push('color: #f3a953');
			}
			else {
				tempdata.push('color: #e00');
			}
			tempdata.push(parseInt(data[i]['totalcure'])+'%');
			tempdata.push(parseInt(data[i]['totaluncure'])+'%');
			console.log(tempdata);
			dataval.push(tempdata);
		  }
		  console.log(dataval);
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
		 role: "annotation" }, 2,
		 { calc: "stringify",
		 sourceColumn: 2,
		 type: "string",
		 role: "annotation"},3,4,5]);

      var options = {
        title: "Disease ratio (in %)",
        width: 800,
        height: 400,
		vAxis: {title:'Total Population (in %)', 0: {title: 'parsecs'},
            1: {title: 'apparent magnitude'},viewWindow : {min: 0, max: 100}},
		hAxis: {title:'Diseases', textStyle: {
			  fontName: 'arial',
			  fontSize: 14,
			  // The color of the text.
			}},
        bar: {groupWidth: "55%"},
		is3D:true,
		isStacked:true,
		
		annotations: {
			textStyle: {
			  fontName: 'arial',
			  fontSize: 14,
			  // The color of the text.
			  color: 'yellow'
			}
		},
        legend: { position: "none" },
		colors: ['#064acb']
      };
      //var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
	  var chart = new google.charts.Bar(document.getElementById('columnchart_values'));
	  chart.draw(data, google.charts.Bar.convertOptions(options));
      //chart.draw(view, options);
  }
  
	}, // End of Success
	error : function(xhr,status,error)
	{
		alert(error);
	}
	  
	  
  });
    }
	
});
    // Enable pusher logging - don't include this in production
    
  </script>
 
      <!-- End of Main Content -->

      <!-- Footer -->
    