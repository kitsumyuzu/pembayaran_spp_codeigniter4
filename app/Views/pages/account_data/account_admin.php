        <div class="main-panel">

            <div class="content">

                <div class="page-inner py-3">

                    <div class="row">

						<div class="col-md-12">

							<div class="card">

								<!-- Card Header -->

									<div class="card-header">

										<div class="d-flex align-items-center">

											<h4 class="card-title"><i class="mr-2 fas fa-archive"></i><b>DATABASE</b></h4>
                                            <ul class="breadcrumbs">

                                                <li class="nav-home">

                                                    <a href="<?= base_url('/home/dashboard') ?>" class="fas fa-home"></a>

                                                </li>

                                                <li class="separator">

                                                    <i class="flaticon-right-arrow"></i>

                                                </li>

													<li class="nav-item">

														<a>account</a>

													</li>

												<li class="separator">

                                                    <i class="flaticon-right-arrow"></i>

                                                </li>

													<li class="nav-item">

														<a>admin_data</a>

													</li>

                                            </ul>

                                            <?php

												if (in_array(session() -> get('roles'), [1])) {

											?>

												<a href="<?= base_url('/home/insert_admin_data/') ?>" class="ml-auto">
											
													<button class="btn btn-success btn-round"><i class="mr-2 fas fa-user-plus"></i> New user </button>

												</a>

											<?php

												}

											?>

										</div>

									</div>

								<!-- End Card Header -->

								<!-- Card Body -->

								<div class="card-body">

									<!-- Data Table -->

										<div class="table-responsive">

											<table class="table table-striped table-hover table-bordered-bg-dark mt-4">

												<thead>

													<tr style="text-align: center;">

														<th>#</th>
														<th>Username</th>
														<th>Email</th>
														<th>Password</th>
														<th>Roles</th>
														<th>Created By</th>

														<th style="width: 10%;">Action</th>

													</tr>

												</thead>
												
												<tbody>

													<?php

														$_row = 1;

														foreach ($adminaccount as $_data) {

															if (in_array(session() -> get('roles'), [1]) && in_array($_data -> _roles, [1, 2])) {

													?>

														<tr>

															<td align="center"><?php echo $_row++ ?></td>
															<td align="center"><?php echo $_data -> username ? $_data -> username : '-' ?></td>
															<td align="center"><?php echo $_data -> email ? $_data -> email : '-' ?></td>
															<td align="center"><?php echo $_data -> password_decrypted ? $_data -> password_decrypted : '-' ?></td>
															<td align="center"><?php echo ucwords($_data -> roles_name) ?></td>
															<td align="center"><?php echo $_data -> _accountCreatedBy ? $_data -> _accountCreatedBy : '-' ?></td>

															<?php

																if ($_data -> _roles === '2') {

															?>

																<td align="center">

																	<div class="form-button-action">

																		<a href="<?= base_url('/home/update_admin_data/'.$_data -> _adminId) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" data-original-title="Edit task"><i class="fas fa-edit"></i></button>

																		</a>

																		<a href="<?= base_url('/home/delete_admin_data/'.$_data -> _adminId) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-danger btn-lg" data-original-title="Delete task"><i class="fas fa-trash"></i></button>

																		</a>

																		<a href="<?= base_url('/home/view_more_admin/'.$_data -> _adminId) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-info btn-lg" data-original-title="View more info"><i class="fas fa-info-circle"></i></button>

																		</a>

																		<a href="<?= base_url('/home/suspend_account/'.$_data -> _idAccount) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-danger btn-lg" data-original-title="Suspend Account"><i class="fas fa-user-slash"></i></button>

																		</a>

																		<a href="<?= base_url('/home/unsuspend_account/'.$_data -> _idAccount) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-success btn-lg" data-original-title="Unsuspend Account"><i class="fas fa-user-check"></i></button>

																		</a>

																	</div>

																</td>

															<?php

																}

															?>

														</tr>

													<?php

															} else if (in_array(session() -> get('roles'), [2]) && $_data -> _idAccount == session() -> get('id')) {

													?>

														<tr>

															<td align="center"><?php echo $_row++ ?></td>
															<td align="center"><?php echo $_data -> username ? $_data -> username : '-' ?></td>
															<td align="center"><?php echo $_data -> email ? $_data -> email : '-' ?></td>
															<td align="center"><?php echo $_data -> password_decrypted ? $_data -> password_decrypted : '-' ?></td>
															<td align="center"><?php echo ucwords($_data -> roles_name) ?></td>
															<td align="center"><?php echo $_data -> _accountCreatedBy ? $_data -> _accountCreatedBy : '-' ?></td>

															<td align="center">

																<div class="form-button-action">

																	<a href="<?= base_url('/home/update_admin_data/'.$_data -> _adminId) ?>">

																		<button type="button" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" data-original-title="Edit task"><i class="fas fa-edit"></i></button>

																	</a>

																	<a href="<?= base_url('/home/view_more_admin/'.$_data -> _adminId) ?>">

																		<button type="button" data-toggle="tooltip" class="btn btn-link btn-info btn-lg" data-original-title="View more info"><i class="fas fa-info-circle"></i></button>

																	</a>

																</div>

															</td>

														</tr>

													<?php

															}

														}

													?>
													
												</tbody>

											</table>

										</div>

									<!-- End Data Table -->

								</div>

							</div>

						</div>

					</div>

                </div>

            </div>