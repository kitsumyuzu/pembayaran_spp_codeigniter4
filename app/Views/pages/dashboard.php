		<div class="main-panel">

			<div class="content">

				<div class="panel-header bg-secondary-gradient">

					<div class="page-inner py-5">

						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

								<div>

									<h2 class="text-white pb-2 fw-bold">Welcome back, <?php echo session() -> username ?></h2>
									<h5 class="text-white op-7 mb-2">Keep the enthusiasm for learning because making money is not an easy thing like picking leaves on a tree.</h5>

								</div>

						</div>
						
					</div>

				</div>

				<div class="page-inner mt--5">

					<div class="row row-card-no-pd mt--2">

						<?php

							if (in_array(session() -> get('roles'), [1, 2, 3])) {

						?>

							<!-- Active Account -->

								<div class="col-lg-6 col-md-3">

									<div class="card card-stats card-round">

										<div class="card-body ">

											<div class="row">

												<div class="col-5">

													<div class="icon-big text-center">

														<i class="fas fa-user-graduate text-warning"></i>

													</div>

												</div>

												<div class="col-7 col-stats">

													<div class="numbers">

														<p class="card-category">Active Student</p>
														<h4 class="card-title"><?php echo $onlineCount; ?></h4>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							<!-- End Active Account -->

							<!-- Active Invoice -->

								<div class="col-lg-6 col-md-3">

									<div class="card card-stats card-round">

										<div class="card-body ">

											<div class="row">

												<div class="col-5">

													<div class="icon-big text-center">

														<i class="fas fa-file-invoice-dollar text-success"></i>

													</div>

												</div>

												<div class="col-7 col-stats">

													<div class="numbers">
														
														<p class="card-category">Active Invoice</p>
														<h4 class="card-title"><?php echo $activeDocument; ?></h4>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							<!-- End Active Invoice -->

						<?php

							} else if (in_array(session() -> get('roles'), [4])) {

						?>

							<!-- Active Invoice -->

								<div class="col-lg-6 col-md-3">

									<div class="card card-stats card-round">

										<div class="card-body ">

											<div class="row">

												<div class="col-5">

													<div class="icon-big text-center">

														<i class="fas fa-file-invoice-dollar text-success"></i>

													</div>

												</div>

												<div class="col-7 col-stats">

													<div class="numbers">

														<p class="card-category">Active Invoice</p>
														<h4 class="card-title"><?php echo $activeInvoice_Student; ?></h4>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							<!-- End Active Invoice -->

							<!-- Active Due Date Invoice -->

								<div class="col-lg-6 col-md-3">

									<div class="card card-stats card-round">

										<div class="card-body ">

											<div class="row">

												<div class="col-5">

													<div class="icon-big text-center">

														<i class="fas fa-file-invoice-dollar text-danger"></i>

													</div>

												</div>

												<div class="col-7 col-stats">

													<div class="numbers">

														<p class="card-category">Due Date Invoice</p>
														<h4 class="card-title"><?php echo $activeDueDateInvoice_Student; ?></h4>

													</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							<!-- End Active Invoice -->

						<?php

							}

						?>

					</div>
					
				</div>

			</div>