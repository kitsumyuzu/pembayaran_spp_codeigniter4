        <div class="main-panel">

            <div class="content">

                <div class="page-inner py-3">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <!-- Card Header -->

                                    <div class="card-header">

                                        <div class="d-flex align-items-center">

                                            <h4 class="card-title"><i class="mr-2 fas fa-archive"></i><b>INSERT DATA</b></h4>
                                            <ul class="breadcrumbs">

                                                <li class="nav-home">

                                                    <a href="<?= base_url('/home/dashboard') ?>" class="fas fa-home"></a>

                                                </li>

                                                <li class="separator">

                                                    <i class="flaticon-right-arrow"></i>

                                                </li>

                                                    <li class="nav-item">

                                                        <a>invoice</a>

                                                    </li>

                                                <li class="separator">

                                                    <i class="flaticon-right-arrow"></i>

                                                </li>

                                                    <li class="nav-item">

                                                        <a>insert_invoice_data</a>

                                                    </li>

                                            </ul>

                                            <a href="<?= base_url('/home/invoice/') ?>" class="ml-auto">
                                        
                                                <button class="btn btn-danger btn-round"><i class="mr-2 fas fa-angle-double-left"></i> Back </button>

                                            </a>

                                        </div>

                                    </div>

                                <!-- End Card Header -->

                                <form action="<?= base_url('/home/action_insert_invoice_data') ?>" method="post">

                                    <!-- Card Body -->

                                        <div class="card-body">

                                            <?php

                                                if (in_array(session() -> get('roles'), [1, 2])) {

                                            ?>

                                                <div class="row">

                                                    <!-- Username -->

                                                        <div class="form-group col-md-3">

                                                            <label for="username_input">Username <span style="color: red;">*</span></label>

                                                            <div class="input-icon">

                                                                <span class="input-icon-addon">

                                                                    <i class="fas fa-user"></i>

                                                                </span>
                                                                
                                                                <select name="username_input" id="username_input" class="form-control" required>

                                                                    <option selected disabled>Select Student</option>

                                                                    <?php

                                                                        foreach ($studentData as $_data) {

                                                                    ?>

                                                                        <option value ="<?= $_data -> _studentId ?>"><?php echo ucwords($_data -> student_first_name) ?> - <?php echo strtoupper($_data -> student_class) ?></option>

                                                                    <?php

                                                                        }

                                                                    ?>

                                                                </select>
                                                            
                                                            </div>

                                                        </div>
                                                        
                                                    <!-- End Username -->

                                                    <!-- Description -->

                                                        <div class="form-group col-md-3">

                                                            <label for="description_input">Description <span style="color: red;">*</span></label>

                                                            <div class="input-icon">

                                                                <span class="input-icon-addon">

                                                                    <i class="fas fa-gem"></i>

                                                                </span>
                                                                
                                                                <select name="description_input" id="description_input" class="form-control" required>

                                                                    <option selected disabled>Select Description</option>
                                                                    <option value="uang buku">UANG BUKU</option>
                                                                    <option value="uang tahunan">UANG TAHUNAN</option>
                                                                    <option value="uang spp">UANG SPP</option>

                                                                </select>
                                                            
                                                            </div>

                                                        </div>
                                                        
                                                    <!-- End Description -->

                                                    <!-- Due Date -->

                                                        <div class="form-group col-md-3">

                                                            <label for="due_date_input">Due Date <span style="color: red;">*</span></label>

                                                            <div class="input-icon">

                                                                <span class="input-icon-addon">

                                                                    <i class="fas fa-calendar"></i>

                                                                </span>
                                                                
                                                                <input type="datetime-local"" name="due_date_input" id="due_date_input" placeholder="due-date" class="form-control" required>
                                                            
                                                            </div>
                                                            

                                                        </div>

                                                    <!-- End Due Date -->

                                                    <!-- Detail Bills -->

                                                        <div class="form-group col-md-3" id="details_input">

                                                            <label for="details_input_field">Detail Bills</label>

                                                            <div class="input-icon">

                                                                <span class="input-icon-addon">

                                                                    <i class="fas fa-money-bill-alt"></i>

                                                                </span>

                                                                <input type="text" name="details_input" id="details_input_field" class="form-control" value="">

                                                            </div>

                                                        </div>

                                                    <!-- End Detail Bills -->

                                                </div>

                                            <?php

                                                }

                                            ?>
                                        
                                        </div>

                                    <!-- End Card Body -->

                                    <!-- Card Footer -->

                                        <div class="card-footer">

                                            <button type="submit" class="btn btn-round btn-success mr-2">Submit</button>

                                        </div>

                                    <!-- End Card Footer -->

                                </form>

                                
                                <script>

                                    var descriptionInput = document.getElementById('description_input');
                                    var detailsInputField = document.getElementById('details_input_field');
                                
                                    descriptionInput.addEventListener('change', function () {
                                
                                        const selectedOption = this.value;
                                
                                        switch (selectedOption) {
                                
                                            case 'uang buku':
                                
                                                detailsInputField.value = '2000000';
                                
                                            break;
                                
                                            case 'uang tahunan':
                                
                                                detailsInputField.value = '1000000';
                                
                                            break;
                                
                                            case 'uang spp':
                                
                                                detailsInputField.value = '600000';
                                
                                            break;
                                
                                            default:
                                
                                                detailsInputField.value = '';
                                
                                            break;
                                                
                                        }
                                
                                    });
    
                                </script>

                            </div>

                        </div>

                    </div>
                    
                </div>

            </div>