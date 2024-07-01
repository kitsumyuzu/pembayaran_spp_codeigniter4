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

														<a>teacher_data</a>

													</li>

												<li class="separator">

                                                    <i class="flaticon-right-arrow"></i>

                                                </li>

													<li class="nav-item">

														<a><?php echo $teacherData -> _teacherId ?></a>

													</li>

                                            </ul>

                                            <a href="<?= base_url('/home/teacher_data/') ?>" class="ml-auto">
											
												<button class="btn btn-danger btn-round"><i class="mr-2 fas fa-angle-double-left"></i> Back </button>

											</a>

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
														<th>First Name</th>
														<th>Surname</th>
														<th>Gender</th>
														<th>Phone Number</th>
														<th>Birthdate</th>
														<th>Birthdate</th>
                                                        <th>Class Guard</th>

													</tr>

												</thead>
												
												<tbody>

													<tr>

														<td align="center">1</td>
														<td align="center"><?php echo ucwords($teacherData -> teacher_first_name ? $teacherData -> teacher_first_name : '-') ?></td>
														<td align="center"><?php echo ucwords($teacherData -> teacher_last_name ? $teacherData -> teacher_last_name : '-') ?></td>
														<td align="center"><?php echo ucwords($teacherData -> teacher_gender ? $teacherData -> teacher_gender : '-') ?></td>
														<td align="center"><?php echo $teacherData -> teacher_phone_number ? $teacherData -> teacher_phone_number : '-' ?></td>
														<td align="center"><?php echo $teacherData -> teacher_birth_date ? $teacherData -> teacher_birth_date : '-' ?></td>
														<td align="center"><?php echo ucwords($teacherData -> teacher_birth_place ? $teacherData -> teacher_birth_place : '-') ?></td>
                                                        <td align="center"><?php echo strtoupper($teacherData -> teacher_class_guard ? $teacherData -> teacher_class_guard :'-')?></td>

													</tr>
													
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