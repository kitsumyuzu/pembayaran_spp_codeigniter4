        <div class="main-panel">

            <div class="content">

                <div class="page-inner py-3">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <!-- Card Header -->

                                    <div class="card-header">

                                        <div class="d-flex align-items-center">

                                            <h4 class="card-title"><i class="mr-2 fas fa-archive"></i><b>UPDATE DATA</b></h4>
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

                                                <li class="separator">

                                                    <i class="flaticon-right-arrow"></i>

                                                </li>

                                                    <li class="nav-item">

                                                        <a>update_student_data</a>

                                                    </li>

                                            </ul>

                                            <a href="<?= base_url('/home/student_data/') ?>" class="ml-auto">
                                        
                                                <button class="btn btn-danger btn-round"><i class="mr-2 fas fa-angle-double-left"></i> Back </button>

                                            </a>

                                        </div>

                                    </div>

                                <!-- End Card Header -->

                                <form action="<?= base_url('/home/action_update_student_data') ?>" method="post">

                                    <input type="hidden" name="idAccount" value="<?php echo $accountData -> _idAccount ?>">
                                    <input type="hidden" name="idStudent" value="<?php echo $studentData -> _studentId ?>">

                                    <!-- Card Body -->

                                        <div class="card-body">

                                            <div class="row">

                                                <!-- Username -->

                                                    <div class="form-group col-md-3">

                                                        <label for="username_input">Username <span style="color: red;">*</span></label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-user"></i>

                                                            </span>
                                                            
                                                            <input type="text" value="<?php echo $accountData -> username ?>" name="username_input" id="username_input" placeholder="username" class="form-control" maxlength="30" required autofocus>
                                                        
                                                        </div>
                                                        

                                                    </div>

                                                <!-- End Username -->

                                                <!-- Email -->

                                                    <div class="form-group col-md-3">

                                                        <label for="email_input">Email <span style="color: red;">*</span></label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-envelope"></i>

                                                            </span>
                                                            
                                                            <input type="email" value="<?php echo $accountData -> email ?>" name="email_input" id="email_input" placeholder="example@gmail.com" class="form-control" maxlength="45" required>
                                                        
                                                        </div>
                                                        

                                                    </div>

                                                <!-- End Email -->

                                                <!-- Password -->

                                                    <div class="form-group col-md-3">

                                                        <label for="password_input">Password <span style="color: red;">*</span></label>

                                                        <div class="input-group">

                                                            <div class="input-icon">

                                                                <span class="input-icon-addon">

                                                                    <i class="fas fa-user-lock"></i>

                                                                </span>
                                                                
                                                                <input type="password" value="<?php echo $accountData -> password_decrypted ?>" name="password_input" id="password_input" placeholder="password" class="form-control" maxlength="26" required>
                                                            
                                                            </div>

                                                            <div class="input-group-append">

                                                                <span class="input-group-text" id="show-password"><i class="fas fa-eye-slash" aria-hidden="true"></i></span>

                                                            </div>

                                                        </div>

                                                    </div>
                                                    
                                                <!-- End Password -->

                                            </div>

                                            <div class="row">

                                                <!-- First name -->

                                                    <div class="form-group col-md-3">

                                                        <label for="first_name_input">First name <span style="color: red;">*</span></label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-user"></i>

                                                            </span>
                                                            
                                                            <input type="text" value="<?php echo $studentData -> student_first_name ?>" name="first_name_input" id="first_name_input" placeholder="first name" class="form-control" maxlength="20" required>
                                                        
                                                        </div>
                                                        

                                                    </div>

                                                <!-- End First name -->

                                                <!-- Surname -->

                                                    <div class="form-group col-md-3">

                                                        <label for="surname_input">Surname</label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-user"></i>

                                                            </span>
                                                            
                                                            <input type="text" value="<?php echo $studentData -> student_last_name ?>" name="surname_input" id="surname_input" placeholder="surname" maxlength="100" class="form-control">
                                                        
                                                        </div>
                                                        

                                                    </div>
                                                    
                                                <!-- End Surname -->

                                                <!-- Gender -->

                                                    <div class="form-group col-md-3">

                                                        <label for="gender_input">Gender <span style="color: red;">*</span></label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-user"></i>

                                                            </span>
                                                            
                                                            <select name="gender_input" id="gender_input" class="form-control" required>

                                                                <option selected disabled>Select Gender</option>
                                                                <option value="male" <?php echo ($studentData -> student_gender == 'male') ? 'selected' : '' ?>>Male</option>
                                                                <option value="female" <?php echo ($studentData -> student_gender == 'female') ? 'selected' : '' ?>>Female</option>
                                                                <option value="rather not say" <?php echo ($studentData -> student_gender == 'rather not say') ? 'selected' : '' ?>>Rather not say</option>

                                                            </select>
                                                        
                                                        </div>

                                                    </div>
                                                    
                                                <!-- End Gender -->

                                                <!-- Phone Number -->

                                                    <div class="form-group col-md-3">

                                                        <label for="phone_number_input">Phone Number <span style="color: red;">*</span></label>

                                                        <div class="input-group mb-3">

                                                            <div class="input-group-prepend">
                                                            
                                                                <span class="input-group-text">+62</span>
                                                            
                                                            </div>

                                                            <input type="text" value="<?php echo substr($studentData -> student_phone_number, 4) ?>" name="phone_number_input" id="phone_number_input" placeholder="8XX-XXXX-XXXX" pattern="8[0-9]{2}-[0-9]{4}-[0-9]{4,5}" class="form-control" maxlength="16" required>
                                                        
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                <!-- End Phone Number -->

                                                <!-- Birthdate -->

                                                    <div class="form-group col-md-3">

                                                        <label for="birthdate_input">Birthdate</label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-calendar"></i>

                                                            </span>
                                                            
                                                            <input type="date" value="<?php echo $studentData -> student_birth_date ?>" name="birthdate_input" id="birthdate_input" placeholder="birthdate" class="form-control">
                                                        
                                                        </div>
                                                        

                                                    </div>
                                                    
                                                <!-- End Birthdate -->

                                                <!-- Birthplace -->

                                                    <div class="form-group col-md-3">

                                                        <label for="birthplace_input">Birthplace</label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-home"></i>

                                                            </span>
                                                            
                                                            <input type="text" value="<?php echo $studentData -> student_birth_place ?>" name="birthplace_input" id="birthplace_input" placeholder="birthplace" class="form-control">
                                                        
                                                        </div>
                                                        

                                                    </div>
                                                    
                                                <!-- End Birthplace -->

                                                <!-- Gender -->

                                                    <div class="form-group col-md-3">

                                                        <label for="class_guard_input">Class Guard <span style="color: red;">*</span></label>

                                                        <div class="input-icon">

                                                            <span class="input-icon-addon">

                                                                <i class="fas fa-user"></i>

                                                            </span>
                                                            
                                                            <select name="class_guard_input" id="class_guard_input" class="form-control" required>
                                                                
                                                                <option selected disabled>Select Class</option>

                                                                <option disabled>————————————————</option>


                                                                <option value="akl x" <?php echo ($studentData -> student_class == 'akl x') ? 'selected' : '' ?>>AKL X</option>
                                                                <option value="akl x a" <?php echo ($studentData -> student_class == 'akl x a') ? 'selected' : '' ?>>AKL X A</option>
                                                                <option value="akl x b" <?php echo ($studentData -> student_class == 'akl x b') ? 'selected' : '' ?>>AKL X B</option>
                                                                <option value="akl x c" <?php echo ($studentData -> student_class == 'akl x c') ? 'selected' : '' ?>>AKL X C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="bdp x" <?php echo ($studentData -> student_class == 'bdp x') ? 'selected' : '' ?>>BDP X</option>
                                                                <option value="bdp x a" <?php echo ($studentData -> student_class == 'bdp x a') ? 'selected' : '' ?>>BDP X A</option>
                                                                <option value="bdp x b" <?php echo ($studentData -> student_class == 'bdp x b') ? 'selected' : '' ?>>BDP X B</option>
                                                                <option value="bdl x c" <?php echo ($studentData -> student_class == 'bdl x c') ? 'selected' : '' ?>>BDL X C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="rpl x" <?php echo ($studentData -> student_class == 'rpl x') ? 'selected' : '' ?>>RPL X</option>
                                                                <option value="rpl x a" <?php echo ($studentData -> student_class == 'rpl x a') ? 'selected' : '' ?>>RPL X A</option>
                                                                <option value="rpl x b" <?php echo ($studentData -> student_class == 'rpl x b') ? 'selected' : '' ?>>RPL X B</option>
                                                                <option value="rpl x c" <?php echo ($studentData -> student_class == 'rpl x c') ? 'selected' : '' ?>>RPL X C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="akl xi" <?php echo ($studentData -> student_class == 'akl xi') ? 'selected' : '' ?>>AKL XI</option>
                                                                <option value="akl xi a" <?php echo ($studentData -> student_class == 'akl xi a') ? 'selected' : '' ?>>AKL XI A</option>
                                                                <option value="akl xi b" <?php echo ($studentData -> student_class == 'akl xi b') ? 'selected' : '' ?>>AKL XI B</option>
                                                                <option value="akl xi c" <?php echo ($studentData -> student_class == 'akl xi c') ? 'selected' : '' ?>>AKL XI C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="bdp xi" <?php echo ($studentData -> student_class == 'bdp xi') ? 'selected' : '' ?>>BDP XI</option>
                                                                <option value="bdp xi a" <?php echo ($studentData -> student_class == 'bdp xi a') ? 'selected' : '' ?>>BDP XI A</option>
                                                                <option value="bdp xi b" <?php echo ($studentData -> student_class == 'bdp xi b') ? 'selected' : '' ?>>BDP XI B</option>
                                                                <option value="bdl xi c" <?php echo ($studentData -> student_class == 'bdl xi c') ? 'selected' : '' ?>>BDL XI C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="rpl xi" <?php echo ($studentData -> student_class == 'rpl xi') ? 'selected' : '' ?>>RPL XI</option>
                                                                <option value="rpl xi a" <?php echo ($studentData -> student_class == 'rpl xi a') ? 'selected' : '' ?>>RPL XI A</option>
                                                                <option value="rpl xi b" <?php echo ($studentData -> student_class == 'rpl xi b') ? 'selected' : '' ?>>RPL XI B</option>
                                                                <option value="rpl xi c" <?php echo ($studentData -> student_class == 'rpl xi c') ? 'selected' : '' ?>>RPL XI C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="akl xii" <?php echo ($studentData -> student_class == 'akl xii') ? 'selected' : '' ?>>AKL XII</option>
                                                                <option value="akl xii a" <?php echo ($studentData -> student_class == 'akl xii a') ? 'selected' : '' ?>>AKL XII A</option>
                                                                <option value="akl xii b" <?php echo ($studentData -> student_class == 'akl xii b') ? 'selected' : '' ?>>AKL XII B</option>
                                                                <option value="akl xii c" <?php echo ($studentData -> student_class == 'akl xii c') ? 'selected' : '' ?>>AKL XII C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="bdp xii" <?php echo ($studentData -> student_class == 'akl x') ? 'selected' : '' ?>>BDP XII</option>
                                                                <option value="bdp xii a" <?php echo ($studentData -> student_class == 'bdp xii a') ? 'selected' : '' ?>>BDP XII A</option>
                                                                <option value="bdp xii b" <?php echo ($studentData -> student_class == 'bdp xii b') ? 'selected' : '' ?>>BDP XII B</option>
                                                                <option value="bdl xii c" <?php echo ($studentData -> student_class == 'bdl xii c') ? 'selected' : '' ?>>BDL XII C</option>
                                                                    
                                                                    <option disabled>————————————————</option>

                                                                <option value="rpl xii" <?php echo ($studentData -> student_class == 'rpl xii') ? 'selected' : '' ?>>RPL XII</option>
                                                                <option value="rpl xii a" <?php echo ($studentData -> student_class == 'rpl xii a') ? 'selected' : '' ?>>RPL XII A</option>
                                                                <option value="rpl xii b" <?php echo ($studentData -> student_class == 'rpl xii b') ? 'selected' : '' ?>>RPL XII B</option>
                                                                <option value="rpl xii c" <?php echo ($studentData -> student_class == 'rpl xii c') ? 'selected' : '' ?>>RPL XII C</option>

                                                            </select>
                                                        
                                                        </div>

                                                    </div>
                                                    
                                                <!-- End Gender -->

                                            </div>
                                        
                                        </div>

                                    <!-- End Card Body -->

                                    <!-- Card Footer -->

                                        <div class="card-footer">

                                            <button type="submit" class="btn btn-round btn-success mr-2">Submit</button>

                                        </div>

                                    <!-- End Card Footer -->

                                </form>

                            </div>

                        </div>

                    </div>
                    
                </div>

            </div>