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

														<a>student_data</a>

													</li>

                                            </ul>

                                            <?php 
                                                        
                                                if (in_array(session() -> get('roles'), [1, 2])) {
                                                                
                                            ?>

                                                <a href="<?= base_url('/home/insert_student_data/') ?>" class="ml-auto">
											
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

														<?php

															if (in_array(session() -> get('roles'), [1, 2])) {

														?>

															<th>Username</th>
															<th>Email</th>
															<th>Password</th>
															<th>Roles</th>
															<th>Created By</th>
															<th style="width: 10%;">Action</th>

														<?php

															} else if (in_array(session() -> get('roles'), [3])) {

														?>

															<th>First Name</th>
															<th>Surname</th>
															<th>Gender</th>
															<th>Phone Number</th>
															<th>Birthdate</th>
															<th>Birthdate</th>
															<th>Class</th>

														<?php

															}

														?>

													</tr>

												</thead>
												
												<tbody>

													<?php

														$_row = 1;

														foreach ($studentaccount as $_data) {

															if (in_array(session() -> get('roles'), [1, 2]) && in_array($_data -> _roles, [4])) {

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

																	<a href="<?= base_url('/home/update_student_data/'.$_data -> _studentId) ?>">

																		<button type="button" data-toggle="tooltip" class="btn btn-link btn-primary btn-lg" data-original-title="Edit task"><i class="fas fa-edit"></i></button>

																	</a>

																	<a href="<?= base_url('/home/delete_student_data/'.$_data -> _studentId) ?>">

																		<button type="button" data-toggle="tooltip" class="btn btn-link btn-danger btn-lg" data-original-title="Delete task"><i class="fas fa-trash"></i></button>

																	</a>

																	<a href="<?= base_url('/home/view_more_student/'.$_data -> _studentId) ?>">

																		<button type="button" data-toggle="tooltip" class="btn btn-link btn-info btn-lg" data-original-title="View more info"><i class="fas fa-info-circle"></i></button>

																	</a>

																	<?php

																		if (in_array(session() -> get('roles'), [1])) {

																	?>

																		<a href="<?= base_url('/home/suspend_account/'.$_data -> _idAccount) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-danger btn-lg" data-original-title="Suspend Account"><i class="fas fa-user-slash"></i></button>

																		</a>

																		<a href="<?= base_url('/home/unsuspend_account/'.$_data -> _idAccount) ?>">

																			<button type="button" data-toggle="tooltip" class="btn btn-link btn-success btn-lg" data-original-title="Unsuspend Account"><i class="fas fa-user-check"></i></button>

																		</a>

																	<?php

																		}

																	?>

																</div>

															</td>

														</tr>

													<?php

														    } else if (in_array(session() -> get('roles'), [3]) && in_array($_data -> _roles, [4])) {

																if ($_data -> teacher_class_guard == $_data -> student_class) {

													?>

														<tr>

															<td align="center">1</td>
															<td align="center"><?php echo ucwords($_data -> student_first_name ? $_data -> student_first_name : '-') ?></td>
															<td align="center"><?php echo ucwords($_data -> student_last_name ? $_data -> student_last_name : '-') ?></td>
															<td align="center"><?php echo ucwords($_data -> student_gender ? $_data -> student_gender : '-') ?></td>
															<td align="center"><?php echo $_data -> student_phone_number ? $_data -> student_phone_number : '-' ?></td>
															<td align="center"><?php echo $_data -> student_birth_date ? $_data -> student_birth_date : '-' ?></td>
															<td align="center"><?php echo ucwords($_data -> student_birth_place ? $_data -> student_birth_place : '-') ?></td>
															<td align="center"><?php echo strtoupper($_data -> student_class ? $_data -> student_class :'-')?></td>

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

							</div>

						</div>

					</div>

                </div>

            </div>