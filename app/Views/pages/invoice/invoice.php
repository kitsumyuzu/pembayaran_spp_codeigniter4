		<div class="main-panel">

			<div class="content">

				<div class="page-inner py-3">

					<!-- Tab Header -->

						<ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">

							<li class="nav-item submenu">
								
								<a href="#tab-belum-lunas" class="nav-link active" id="pills-belum-lunas-tab-nobd" data-toggle="pill" role="tab" aria-controls="pills-belum-lunas-nobd" aria-selected="true">Belum Bayar</a>

							</li>

							<li class="nav-item submenu">
								
								<a href="#tab-lunas" class="nav-link" id="pills-lunas-tab-nobd" data-toggle="pill" role="tab" aria-controls="pills-lunas-nobd" aria-selected="false">Lunas</a>

							</li>

						</ul>

					<!-- End Tab Header -->
					
					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<!-- Card Header -->

									<div class="card-header">

										<div class="d-flex align-items-center">

											<h4 class="card-title">Invoice</h4>

										</div>

									</div>

								<!-- End Card Header -->

								<!-- Card Body -->

								<div class="card-body">

									<div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">

										<!-- Tab Belum Lunas -->

											<div class="tab-pane fade active show" id="tab-belum-lunas" role="tabpanel" aria-labelledby="pills-belum-lunas-tab-nobd">

												<!-- Buttons -->

													<div class="d-flex align-items-center">
												
														<?php

															if (in_array(session() -> get('roles'), [1, 2])) {

														?>

															<a href="<?= base_url('/home/insert_invoice_data/') ?>" class="ml-auto">
														
																<button class="btn btn-secondary btn-round"><i class="mr-2 fas fa-plus"></i> New invoice </button>

															</a>

														<?php

															} else if (in_array(session() -> get('roles'), [4])) {

														?>

															<a href="<?= base_url('/home/insert_invoice_data/') ?>" class="ml-auto">
														
																<button class="btn btn-success btn-round"> Bayar </button>

															</a>

														<?php

															}

														?>

													</div>

												<!-- End Buttons -->

												<!-- Data Table -->

													<div class="table-responsive">

														<table id="add-row" class="display table table-striped table-hover" >

															<thead>

																<tr style="text-align: center;">

																	<th>#</th>
																	<th>Invoice ID</th>
																	<th>Username</th>
																	<th>Description</th>
																	<th>Due Date</th>
																	<th>Total</th>
																	<th>Status</th>

																	<?php

																		if (in_array(session() -> get('roles'), [1, 2])) {

																	?>

																		<th style="width: 10%">Action</th>

																	<?php

																		}

																	?>

																</tr>

															</thead>
															
															<tbody>

																<?php

																	$_row = 1;

																	foreach ($invoice as $_data) {

																		if (in_array(session() -> get('roles'), [1, 2, 3])) {

																			if (in_array($_data -> invoice_status, ['belum lunas', 'denda'])) {

																?>

																	<tr>

																		<td align="center"><?php echo $_row++ ?></td>
																		<td align="center"><a href=""><?php echo $_data -> _idInvoice?>/INV/KMZ</a></td>
																		<td align="center"><?php echo ucwords($_data -> student_first_name) ?></td>
																		<td align="center"><?php echo strtoupper($_data -> invoice_description) ?></td>
																		<td align="center"><?php echo substr($_data -> invoice_due_date, 0, 10) ?></td>
																		<td align="center"><?php echo number_format($_data -> invoice_bill, 0, '.', ',') ?></td>

																		<?php

																			if ($_data -> invoice_status === 'denda') {

																		?>
																			
																			<td align="center"><button disabled="disabled" class="btn btn-danger btn-round">Denda</button></td>

																		<?php

																			} else if ($_data -> invoice_status === 'belum lunas') {

																		?>

																			<td align="center"><button disabled="disabled" class="btn btn-danger btn-round">Belum Bayar</button></td>

																		<?php

																			}

																		?>
																		<td align="center">

																			<?php

																				if (in_array(session() -> get('roles'), [1, 2])) {

																			?>
																				
																				<a href="<?= base_url('/home/change_accept/'.$_data -> _idInvoice) ?>">

																					<button type="button" data-toggle="tooltip" class="btn btn-link btn-success btn-lg" data-original-title="Manual Change"><i class="fas fa-check-circle"></i></button>

																				</a>

																			<?php

																				}

																			?>

																		</td>
																		

																	</tr>


																<?php

																			}

																		} else if (in_array(session() -> get('roles'), [4])) {

																			if (in_array($_data -> invoice_status, ['belum lunas', 'denda']) && $_data -> _invoiceId === session() -> get('id')) {

																?>

																	<tr>

																		<td align="center"><input type="checkbox" name="paid_invoice[]" id="<?php echo $_data -> _idInvoice ?>"></td>
																		<td align="center"><a href=""><?php echo $_data -> _idInvoice?>/INV/KMZ</a></td>
																		<td align="center"><?php echo ucwords($_data -> student_first_name) ?></td>
																		<td align="center"><?php echo strtoupper($_data -> invoice_description) ?></td>
																		<td align="center"><?php echo substr($_data -> invoice_due_date, 0, 10) ?></td>
																		<td align="center"><?php echo number_format($_data -> invoice_bill, 0, '.', ',') ?></td>
																		<td align="center"><button disabled="disabled" class="btn btn-danger btn-round">Belum Bayar</button></td>

																	</tr>

																<?php

																			}

																		}

																	}

																?>
																
															</tbody>

														</table>

													</div>

												<!-- End Data Table -->

											</div>

										<!-- End Tab Belum Lunas -->

										<!-- Tab Lunas -->

											<div class="tab-pane fade" id="tab-lunas" role="tabpanel" aria-labelledby="pills-lunas-tab-nobd">

												<!-- Data Table -->

													<div class="table-responsive">

														<table id="add-row" class="display table table-striped table-hover" >

															<thead>

																<tr style="text-align: center;">

																	<th>#</th>
																	<th>Invoice ID</th>
																	<th>Username</th>
																	<th>Description</th>
																	<th>Date</th>
																	<th>Total</th>
																	<th>Status</th>
																	
																	<?php

																		if (in_array(session() -> get('roles'), [1, 2, 4])) {

																	?>

																		<th style="width: 20%">Action</th>

																	<?php

																		}

																	?>

																</tr>

															</thead>
															
															<tbody>

																<?php

																	$_row = 1;

																	foreach ($invoice as $_data) {

																		if (in_array(session() -> get('roles'), [1, 2, 3])) {

																			if (in_array($_data -> invoice_status, ['lunas'])) {

																?>

																	<tr>

																		<td align="center"><?php echo $_row++ ?></td>
																		<td align="center"><a href=""><?php echo $_data -> _idInvoice?>/INV/KMZ</a></td>
																		<td align="center"><?php echo ucwords($_data -> student_first_name) ?></td>
																		<td align="center"><?php echo strtoupper($_data -> invoice_description) ?></td>
																		<td align="center"><?php echo substr($_data -> invoice_due_date, 0, 10) ?></td>
																		<td align="center"><?php echo number_format($_data -> invoice_bill, 0, '.', ',') ?></td>
																		<td align="center"><button disabled="disabled" class="btn btn-success btn-round">Lunas</button></td>
						
																		<td align="center">

																			<?php

																				if (in_array(session() -> get('roles'), [1, 2])) {

																			?>

																				<a href="<?= base_url('/home/change_decline/'.$_data -> _idInvoice) ?>">

																					<button type="button" data-toggle="tooltip" class="btn btn-link btn-success btn-lg" data-original-title="Manual Change"><i class="fas fa-check-circle"></i></button>

																				</a>

																				<a href="<?= base_url('/home/invoice/') ?>">

																					<button type="button" data-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" data-original-title="Detail"><i class="fas fa-file-pdf"></i></button>

																				</a>

																			<?php

																				}

																			?>

																		</td>

																	</tr>

																<?php

																			}

																		} else if (in_array(session() -> get('roles'), [3, 4])) {

																			if (in_array($_data -> invoice_status, ['lunas']) && $_data -> _invoiceId === session() -> get('id')) {

																?>

																	<tr>

																		<td align="center"><?php echo $_row++ ?></td>
																		<td align="center"><a href=""><?php echo $_data -> _idInvoice?>/INV/KMZ</a></td>
																		<td align="center"><?php echo ucwords($_data -> student_first_name) ?></td>
																		<td align="center"><?php echo strtoupper($_data -> invoice_description) ?></td>
																		<td align="center"><?php echo substr($_data -> invoice_due_date, 0, 10) ?></td>
																		<td align="center"><?php echo number_format($_data -> invoice_bill, 0, '.', ',') ?></td>
																		<td align="center"><button disabled="disabled" class="btn btn-success btn-round">Lunas</button></td>
						
																		<td align="center">
																			
																			<a href="<?= base_url('/home/invoice/') ?>">

																				<button type="button" data-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" data-original-title="Detail"><i class="fas fa-file-pdf"></i></button>

																			</a>

																		</td>

																	</tr>

																<?php

																			}

																		}

																	}

																?>
																
															</tbody>

														</table>

													</div>

												<!-- End Data Table -->

											</div>

										<!-- End Tab Lunas -->

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>