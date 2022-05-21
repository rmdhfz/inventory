<div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              Periode: <?php echo date('d-M-Y'); ?>
            </li>
          </ol>
        </nav>
        <div class="row">
          <div class="col-md-4 col-xl-4">
            <div class="card comp-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <i class="fas fa-th-list bg-c-red" aria-hidden="true"></i>
                  </div>
                  <div class="col">
                    <a href="<?php echo base_url('asset'); ?>">
                    	<h6><b>Total Asset</b></h6><hr>
                    </a>
                    <div id="total-asset"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-xl-4">
            <div class="card comp-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <i class="fa fa-users bg-c-blue" aria-hidden="true"></i>
                  </div>
                  <div class="col">
                    <a href="<?php echo base_url('employee'); ?>">
                    	<h6><b>Total Employee</b></h6>
                    </a>
                    <hr />
                    <div id="total-employee"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-xl-4">
            <div class="card comp-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <i class="fa fa-retweet bg-c-green" aria-hidden="true"></i>
                  </div>
                  <div class="col">
                    <a href="<?php echo base_url('assignment'); ?>">
                    	<h6><b>Total Assignment</b></h6>
                    </a>
                    <hr />
                    <div id="total-assignment"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function() {
  		async function getTotalAsset()
  		{
  			await $.post('total/asset').done((res, xhr, status) => {
  				$("#total-asset").text(res.data.total);
  			})
  		}
  		async function getTotalEmployee()
  		{
  			await $.post('total/employee').done((res, xhr, status) => {
  				$("#total-employee").text(res.data.total);
  			})
  		}
  		async function getTotalAssigment()
  		{
  			await $.post('total/assignment').done((res, xhr, status) => {
  				$("#total-assignment").text(res.data.total);
  			})
  		}
  		getTotalAsset();
  		getTotalEmployee();
  		getTotalAssigment();
  	});
  </script>