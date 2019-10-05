
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Pending Cases</h1>
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pending Cases</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Infected Body Part</th>
                      <th>Disease</th>
                      <th>Past Info</th>
                      <th>Start date</th>
                      <th>End Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Infected Body Part</th>
                      <th>Disease</th>
                      <th>Past Info</th>
                      <th>Start date</th>
                      <th>End Date</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>Satish Patel</td>
                      <td>Kidney</td>
                      <td>Stone</td>
                      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#p1">
                        INFO
                      </button></td>
                      <td>2020/04/25</td>
                      <td><button class="btn btn-info m-1 " data-toggle="modal" data-target="#Edit" >Edit</button><button class="btn  m-1 btn-danger" data-toggle="modal" data-target="#Close">Close</button></td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>

<!-- The Modal -->
<div class="modal" id="p1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">MEDICINE & PRESCRIPTION :-</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h4 class="badge badge-success">Medicine :-</h4>
        <ul>
          <li>Ibuprofen (Advil, Motrin IB)</li>
          <li>Acetaminophen (Tylenol)</li>
          <li>Naproxen sodium (Aleve)</li>
        </ul>
        <hr>
        <h4 class="badge badge-success">Prescription :-</h4>
        <ul>
          <li>Drink water throughout the day.</li>
          <li>Eat fewer oxalate-rich foods.</li>
          <li>Choose a diet low in salt and animal protein.</li>
        </ul>
      </div>

</div >
  </div >
    </div>


<!-- !-- The Modal --> -->
<div class="modal" id="Edit">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">MEDICINE & PRESCRIPTION :-</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
          <select name="bodyPart" id="bd" class="form-group form-control">
		    <option selected="true">Select Body Part</option>
            <option value="">Heart</option>
            <option value="">Liver</option>
            <option value="">Kidney</option>
          </select>
          <select name="disease" id="d" class="form-group form-control" >
		    <option>Select Disease</option>
              <option value="">Hepatitis A</option>
              <option value="">Kidney Stone</option>
              <option value="">Cirrhosis</option>
            </select>
            <select name="medicine" id="med" class="form-group form-control ">
                <option>Select Medicines</option>
				<option value="">Adderall</option>
                <option value="">Pamelor</option>
                <option value="">Tabloid</option>
              </select>
            <textarea class="form-control">Enter Remarks</textarea>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
      </div>

    </div>
  </div>
</div>

<!----------------Close Modal----------->
      <!-- End of Main Content -->
