<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Schema;

class Home extends BaseController {

    public function index() {

        return view('login');

    }

    // =================================================== [ Authentication System ] ================================================== //

        public function authentication_login() {

            $Schema = new Schema();

                // Collecting data by " name " attribute from HTML document

                    $authentication_account = $this -> request -> getPost('account_input_username');
                    $authentication_password = $this -> request -> getPost('account_input_password');

                /**
                 * Filter a input username with email, if the input was an email then login with session of email
                 * else if the input was username then login with session of username

                 * Convert inputted data into an array, and find the data from database of " authentication_account " table
                */

                    if (filter_var($authentication_account, FILTER_VALIDATE_EMAIL)) {
                        
                        $_data = array('email' => $authentication_account, 'password_encrypted' => md5($authentication_password));

                    } else {

                        $_data = array('username' => $authentication_account, 'password_encrypted' => md5($authentication_password));

                    }
                    
                    $data_filter = $Schema -> getWhere2('authentication_account', $_data);

                // ==================================================================================================== //

                    if ($data_filter && $data_filter['_status'] === 'suspended') {

                        // If the user's status is "suspended," redirect them back to the login page

                            session() -> set('alert', 'Your account has been suspended!');
                            return redirect()->to('/home/');

                    }

                    if ($data_filter > 0) {

                        session() -> set('username', $data_filter['username']);
                        session() -> set('email', $data_filter['email']);
                        session() -> set('roles', $data_filter['_roles']);
                        session() -> set('id', $data_filter['_idAccount']);

                        // Redirect an user into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    } else {

                        // Redirect an user back into home pages

                            return redirect() -> to('/home/');

                    };
            
        }

        public function authentication_logout() {

            session() -> destroy(); // Destroy session that existed in a user

            // Redirect an user back into login pages

                return redirect() -> to('/home/authentication_login');

        }

        public function suspend_account($_id) {

            if (in_array(session() -> get('ranks'), [1]) || session() -> get('id') > 0) {

                $Schema = new Schema();

                $accountData = array('_idAccount' => $_id);
                $suspend = array('_status' => 'suspended', '_accountUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')));

                    $Schema -> edit_data('authentication_account', $suspend, $accountData);

                // Redirect an user back into login pages

                    return redirect() -> to('/home/dashboard');

            } else {

                // Redirect an user back into dsahboard pages

                    return redirect() -> to('/home/dashboard');
            }

        }

        public function unsuspend_account($_id) {

            if (in_array(session() -> get('ranks'), [1]) || session() -> get('id') > 0) {

                $Schema = new Schema();

                $accountData = array('_idAccount' => $_id);
                $suspend = array('_status' => 'active', '_accountUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')));

                    $Schema -> edit_data('authentication_account', $suspend, $accountData);

                // Redirect an user back into login pages

                    return redirect() -> to('/home/dashboard');

            } else {

                // Redirect an user back into dsahboard pages

                    return redirect() -> to('/home/dashboard');
            }

        }

    // =================================================== [ Main ] =================================================================== //

        public function dashboard() {

            if (session() -> get('id') > 0) {

                // Counting

                    $Schema = new Schema();

                    $_fetch['onlineCount'] = $Schema -> countActiveAccount();
                    $_fetch['activeDocument'] = $Schema -> countActiveDocument();
                    $_fetch['activeInvoice_Student'] = $Schema -> countActiveDocument_Student();
                    $_fetch['activeDueDateInvoice_Student'] = $Schema -> countActiveDueDateDocument_Student();
                    $_data['userAccount'] = $Schema -> getWhere('authentication_account', array('_idAccount' => session() -> get('id')));

                // Return a view base from a file specified

                    echo view('layout/_header');
                    echo view('layout/_menu', $_data);

                    echo view('pages/dashboard', $_fetch);
                    echo view('layout/_footer');

            } else {

                // Redirect an user back into login pages

                    return redirect() -> to('/home/authentication_login');

            }

        }

        // =================================================== [ Admin access ] ================================================== //

            public function admin_data() {

                if (in_array(session() -> get('roles'), [1, 2])) {

                    $Schema = new Schema();

                    // Fetching data

                        $on1 = 'authentication_account._roles = authentication_roles._idRoles';
                        $on2 = 'account_administrator._adminId = authentication_account._idAccount';

                        $_fetch['adminaccount'] = $Schema -> visual_join3('authentication_account', 'authentication_roles', 'account_administrator', $on1, $on2);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/account_data/account_admin', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function view_more_admin($_id) {

                if (in_array(session() -> get('roles'), [1, 2])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_adminData = array('_adminId' => $_id);
                        
                        $_fetch['adminData'] = $Schema -> getWhere('account_administrator', $_adminData);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/account_data/account_admin_more', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboad pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function insert_admin_data() {

                if (in_array(session() -> get('roles'), [1]) || session() -> get('id') > 0) {

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/account/admin/insert_administrator');
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function action_insert_admin_data() {

                $Schema = new Schema();

                // Authentication data collection

                    $username = $this -> request -> getPost('username_input');
                    $email = $this -> request -> getPost('email_input');
                    $password = $this -> request -> getPost('password_input');

                // Personal information data collection

                    $first_name = $this -> request -> getPost('first_name_input');
                    $surname = $this -> request -> getPost('surname_input');
                    $gender = $this -> request -> getPost('gender_input');
                    $phone_number = $this -> request -> getPost('phone_number_input');
                    $birthdate = $this -> request -> getPost('birthdate_input');
                    $birthplace = $this -> request -> getPost('birthplace_input');

                // Convert data into an array and add into databases

                    $_accountData = array(
                        
                        'username' => $username,
                        'email' => $email, 
                        'password_encrypted' => md5($password),
                        'password_decrypted' => $password,
                        '_roles' => '2',
                        '_status' => 'active',
                        '_accountCreatedBy' => session() -> username,
                        '_accountCreatedAt' => date('Y-m-d H:i:s', strtotime('now'))
                    
                    );

                    if (in_array(session() -> get('roles'), [1]) || session() -> get('id') > 0) {

                        $Schema -> add_data('authentication_account', $_accountData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                // Convert data into an array and add into databases

                    // Fetching data

                        $_fetch = array('username' => $username);
                        $_where = $Schema -> getWhere2('authentication_account', $_fetch);

                        $_id = $_where['_idAccount'];

                    $_adminData = array(

                        'admin_first_name' => $first_name,
                        'admin_last_name' => $surname,
                        'admin_gender' => $gender,
                        'admin_phone_number' => '+62 ' . $phone_number,
                        'admin_birth_date' => $birthdate,
                        'admin_birth_place' => $birthplace,
                        '_adminCreatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                        '_adminId' => $_id

                    );

                    if (in_array(session() -> get('roles'), [1]) || session() -> get('id') > 0) {

                        $Schema -> add_data('account_administrator', $_adminData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into admin pages

                        return redirect() -> to('/home/admin_data');

            }

            public function update_admin_data($_id) {

                if (in_array(session() -> get('roles'), [1, 2])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_adminData = array('_adminId' => $_id);
                        $_accountData = array('_idAccount' => $_id);

                        $_fetch['adminData'] = $Schema -> getWhere('account_administrator', $_adminData);
                        $_fetch['accountData'] = $Schema -> getWhere('authentication_account', $_accountData);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/account/admin/update_administrator', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into admin pages

                        return redirect() -> to('/home/admin_data');

                }

            }

            public function action_update_admin_data() {

                $Schema = new Schema();

                // Authentication data collection

                    $username = $this -> request -> getPost('username_input');
                    $email = $this -> request -> getPost('email_input');
                    $password = $this -> request -> getPost('password_input');
                    $_idAccount = $this -> request -> getPost('idAccount');

                // Personal information data collection

                    $first_name = $this -> request -> getPost('first_name_input');
                    $surname = $this -> request -> getPost('surname_input');
                    $gender = $this -> request -> getPost('gender_input');
                    $phone_number = $this -> request -> getPost('phone_number_input');
                    $birthdate = $this -> request -> getPost('birthdate_input');
                    $birthplace = $this -> request -> getPost('birthplace_input');
                    $_idAdmin = $this -> request -> getPost('idAdmin');

                // Convert data into an array and add into databases

                    $_where = array('_idAccount' => $_idAccount);

                    $_accountData = array(
                        
                        'username' => $username,
                        'email' => $email, 
                        'password_encrypted' => md5($password),
                        'password_decrypted' => $password,
                        '_accountUpdatedAt' => date('Y-m-d H:i:s', strtotime('now'))

                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> edit_data('authentication_account', $_accountData, $_where);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                // Convert data into an array and add into databases

                    // Fetching data

                    $_where2 = array('_adminId' => $_idAdmin);

                    $_adminData = array(

                        'admin_first_name' => $first_name,
                        'admin_last_name' => $surname,
                        'admin_gender' => $gender,
                        'admin_phone_number' => '+62 ' . $phone_number,
                        'admin_birth_date' => $birthdate,
                        'admin_birth_place' => $birthplace,
                        '_adminUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                        
                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> edit_data('account_administrator', $_adminData, $_where2);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into admin pages

                        return redirect() -> to('/home/admin_data');

            }

            public function delete_admin_data($_id) {

                $Schema = new Schema();

                $_adminData = array('_adminId' => $_id);
                $_accountData = array('_idAccount' => $_id);

                // Delete data from databases

                    if (in_array(session() -> get('roles'), [1])) {

                        $Schema -> delete_data('account_administrator', $_adminData);
                        $Schema -> delete_data('authentication_account', $_accountData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/admin_data');

            }

        // =================================================== [ Teacher access ] ================================================ //

            public function teacher_data() {

                if (in_array(session() -> get('roles'), [1, 2, 3])) {

                    $Schema = new Schema();

                    // Fetching data

                        $on1 = 'authentication_account._roles = authentication_roles._idRoles';
                        $on2 = 'account_teacher._teacherId = authentication_account._idAccount';

                        $_fetch['teacheraccount'] = $Schema -> visual_join3('authentication_account', 'authentication_roles', 'account_teacher', $on1, $on2);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/account_data/account_teacher', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function view_more_teacher($_id) {

                if (in_array(session() -> get('roles'), [1, 2, 3])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_teacherData = array('_teacherId' => $_id);
                        
                        $_fetch['teacherData'] = $Schema -> getWhere('account_teacher', $_teacherData);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/account_data/account_teacher_more', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboad pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function insert_teacher_data() {

                if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/account/teacher/insert_teacher');
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function action_insert_teacher_data() {

                $Schema = new Schema();

                // Authentication data collection

                    $username = $this -> request -> getPost('username_input');
                    $email = $this -> request -> getPost('email_input');
                    $password = $this -> request -> getPost('password_input');

                // Personal information data collection

                    $first_name = $this -> request -> getPost('first_name_input');
                    $surname = $this -> request -> getPost('surname_input');
                    $gender = $this -> request -> getPost('gender_input');
                    $phone_number = $this -> request -> getPost('phone_number_input');
                    $birthdate = $this -> request -> getPost('birthdate_input');
                    $birthplace = $this -> request -> getPost('birthplace_input');
                    $class_guard = $this -> request -> getPost('class_guard_input');

                // Convert data into an array and add into databases

                    $_accountData = array(
                        
                        'username' => $username,
                        'email' => $email, 
                        'password_encrypted' => md5($password),
                        'password_decrypted' => $password,
                        '_roles' => '3',
                        '_status' => 'active',
                        '_accountCreatedBy' => session() -> username,
                        '_accountCreatedAt' => date('Y-m-d H:i:s', strtotime('now'))
                    
                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> add_data('authentication_account', $_accountData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                // Convert data into an array and add into databases

                    // Fetching data

                        $_fetch = array('username' => $username);
                        $_where = $Schema -> getWhere2('authentication_account', $_fetch);

                        $_id = $_where['_idAccount'];

                    $_teacherData = array(

                        'teacher_first_name' => $first_name,
                        'teacher_last_name' => $surname,
                        'teacher_gender' => $gender,
                        'teacher_phone_number' => '+62 ' . $phone_number,
                        'teacher_birth_date' => $birthdate,
                        'teacher_birth_place' => $birthplace,
                        'teacher_class_guard' => $class_guard,
                        '_teacherCreatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                        '_teacherId' => $_id

                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> add_data('account_teacher', $_teacherData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into teacher pages

                        return redirect() -> to('/home/teacher_data');

            }

            public function update_teacher_data($_id) {

                if (in_array(session() -> get('roles'), [1, 2])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_teacherData = array('_teacherId' => $_id);
                        $_accountData = array('_idAccount' => $_id);

                        $_fetch['teacherData'] = $Schema -> getWhere('account_teacher', $_teacherData);
                        $_fetch['accountData'] = $Schema -> getWhere('authentication_account', $_accountData);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/account/teacher/update_teacher', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into teacher pages

                        return redirect() -> to('/home/teacher_data');

                }

            }

            public function action_update_teacher_data() {

                $Schema = new Schema();

                // Authentication data collection

                    $username = $this -> request -> getPost('username_input');
                    $email = $this -> request -> getPost('email_input');
                    $password = $this -> request -> getPost('password_input');
                    $_idAccount = $this -> request -> getPost('idAccount');

                // Personal information data collection

                    $first_name = $this -> request -> getPost('first_name_input');
                    $surname = $this -> request -> getPost('surname_input');
                    $gender = $this -> request -> getPost('gender_input');
                    $phone_number = $this -> request -> getPost('phone_number_input');
                    $birthdate = $this -> request -> getPost('birthdate_input');
                    $birthplace = $this -> request -> getPost('birthplace_input');
                    $class_guard = $this -> request -> getPost('class_guard_input');
                    $_idTeacher = $this -> request -> getPost('idTeacher');

                // Convert data into an array and add into databases

                    $_where = array('_idAccount' => $_idAccount);

                    $_accountData = array(
                        
                        'username' => $username,
                        'email' => $email, 
                        'password_encrypted' => md5($password),
                        'password_decrypted' => $password,
                        '_accountUpdatedAt' => date('Y-m-d H:i:s', strtotime('now'))

                    );

                    if (in_array(session() -> get('roles'), [1]) || session() -> get('id') > 0) {

                        $Schema -> edit_data('authentication_account', $_accountData, $_where);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                // Convert data into an array and add into databases

                    // Fetching data

                    $_where2 = array('_teacherId' => $_idTeacher);

                    $_teacherData = array(

                        'teacher_first_name' => $first_name,
                        'teacher_last_name' => $surname,
                        'teacher_gender' => $gender,
                        'teacher_phone_number' => '+62 ' . $phone_number,
                        'teacher_birth_date' => $birthdate,
                        'teacher_birth_place' => $birthplace,
                        'teacher_class_guard' => $class_guard,
                        '_teacherUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                        
                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> edit_data('account_teacher', $_teacherData, $_where2);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into teacher pages

                        return redirect() -> to('/home/teacher_data');

            }

            public function delete_teacher_data($_id) {

                $Schema = new Schema();

                $_teacherData = array('_teacherId' => $_id);
                $_accountData = array('_idAccount' => $_id);

                // Delete data from databases

                    if (in_array(session() -> get('roles'), [1])) {

                        $Schema -> delete_data('account_teacher', $_teacherData);
                        $Schema -> delete_data('authentication_account', $_accountData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into teacher pages

                        return redirect() -> to('/home/teacher_data');

            }

        // =================================================== [ Student access ] ================================================ //

            public function student_data() {

                if (in_array(session() -> get('roles'), [1, 2, 3])) {

                    $Schema = new Schema();

                    // Fetching data

                        $on1 = 'authentication_account._roles = authentication_roles._idRoles';
                        $on2 = 'account_student._studentId = authentication_account._idAccount';
                        $on3 = 'account_student.student_class = account_teacher.teacher_class_guard';

                        $_fetch['studentaccount'] = $Schema -> visual_join4('authentication_account', 'authentication_roles', 'account_student', 'account_teacher' , $on1, $on2, $on3);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/account_data/account_student', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function view_more_student($_id) {

                if (in_array(session() -> get('roles'), [1, 2, 3])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_adminData = array('_studentId' => $_id);
                        
                        $_fetch['studentData'] = $Schema -> getWhere('account_student', $_adminData);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/account_data/account_student_more', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboad pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function insert_student_data() {

                if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/account/student/insert_student');
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function action_insert_student_data() {

                $Schema = new Schema();

                // Authentication data collection

                    $username = $this -> request -> getPost('username_input');
                    $email = $this -> request -> getPost('email_input');
                    $password = $this -> request -> getPost('password_input');

                // Personal information data collection

                    $first_name = $this -> request -> getPost('first_name_input');
                    $surname = $this -> request -> getPost('surname_input');
                    $gender = $this -> request -> getPost('gender_input');
                    $phone_number = $this -> request -> getPost('phone_number_input');
                    $birthdate = $this -> request -> getPost('birthdate_input');
                    $birthplace = $this -> request -> getPost('birthplace_input');
                    $class = $this -> request -> getPost('class_input');

                // Convert data into an array and add into databases

                    $_accountData = array(
                        
                        'username' => $username,
                        'email' => $email, 
                        'password_encrypted' => md5($password),
                        'password_decrypted' => $password,
                        '_roles' => '4',
                        '_status' => 'active',
                        '_accountCreatedBy' => session() -> username,
                        '_accountCreatedAt' => date('Y-m-d H:i:s', strtotime('now'))
                    
                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> add_data('authentication_account', $_accountData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                // Convert data into an array and add into databases

                    // Fetching data

                        $_fetch = array('username' => $username);
                        $_where = $Schema -> getWhere2('authentication_account', $_fetch);

                        $_id = $_where['_idAccount'];

                    $_teacherData = array(

                        'student_first_name' => $first_name,
                        'student_last_name' => $surname,
                        'student_gender' => $gender,
                        'student_phone_number' => '+62 ' . $phone_number,
                        'student_birth_date' => $birthdate,
                        'student_birth_place' => $birthplace,
                        'student_class' => $class,
                        '_studentCreatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                        '_studentId' => $_id

                    );

                    if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                        $Schema -> add_data('account_student', $_teacherData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into student pages

                        return redirect() -> to('/home/student_data');

            }

            public function update_student_data($_id) {

                if (in_array(session() -> get('roles'), [1, 2, 4])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_teacherData = array('_studentId' => $_id);
                        $_accountData = array('_idAccount' => $_id);

                        $_fetch['studentData'] = $Schema -> getWhere('account_student', $_teacherData);
                        $_fetch['accountData'] = $Schema -> getWhere('authentication_account', $_accountData);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/account/student/update_student', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into student pages

                        return redirect() -> to('/home/student_data');

                }

            }

            public function action_update_student_data() {

                $Schema = new Schema();

                // Authentication data collection

                    $username = $this -> request -> getPost('username_input');
                    $email = $this -> request -> getPost('email_input');
                    $password = $this -> request -> getPost('password_input');
                    $_idAccount = $this -> request -> getPost('idAccount');

                // Personal information data collection

                    $first_name = $this -> request -> getPost('first_name_input');
                    $surname = $this -> request -> getPost('surname_input');
                    $gender = $this -> request -> getPost('gender_input');
                    $phone_number = $this -> request -> getPost('phone_number_input');
                    $birthdate = $this -> request -> getPost('birthdate_input');
                    $birthplace = $this -> request -> getPost('birthplace_input');
                    $class = $this -> request -> getPost('class_input');
                    $_idStudent = $this -> request -> getPost('idStudent');

                // Convert data into an array and add into databases

                    $_where = array('_idAccount' => $_idAccount);

                    $_accountData = array(
                        
                        'username' => $username,
                        'email' => $email, 
                        'password_encrypted' => md5($password),
                        'password_decrypted' => $password,
                        '_accountUpdatedAt' => date('Y-m-d H:i:s', strtotime('now'))

                    );

                    if (in_array(session() -> get('roles'), [1, 2, 4]) || session() -> get('id') > 0) {

                        $Schema -> edit_data('authentication_account', $_accountData, $_where);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                // Convert data into an array and add into databases

                    // Fetching data

                    $_where2 = array('_studentId' => $_idStudent);

                    $_studentData = array(

                        'student_first_name' => $first_name,
                        'student_last_name' => $surname,
                        'student_gender' => $gender,
                        'student_phone_number' => '+62 ' . $phone_number,
                        'student_birth_date' => $birthdate,
                        'student_birth_place' => $birthplace,
                        'student_class' => $class,
                        '_studentUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                        
                    );

                    if (in_array(session() -> get('roles'), [1, 2, 4]) || session() -> get('id') > 0) {

                        $Schema -> edit_data('account_student', $_studentData, $_where2);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into student pages

                        return redirect() -> to('/home/student_data');

            }

            public function delete_student_data($_id) {

                $Schema = new Schema();

                $_studentData = array('_studentId' => $_id);
                $_accountData = array('_idAccount' => $_id);

                // Delete data from databases

                    if (in_array(session() -> get('roles'), [1, 2])) {

                        $Schema -> delete_data('account_student', $_studentData);
                        $Schema -> delete_data('authentication_account', $_accountData);

                    } else {

                        // Redirect an user back into dashboard pages

                            return redirect() -> to('/home/dashboard');

                    }

                    // Redirect an user back into student pages

                        return redirect() -> to('/home/student_data');

            }

        // =================================================== [ Invoice System ] ========================================================= //

            public function invoice() {

                if (session() -> get('id') > 0) {

                    $Schema = new Schema();

                    // Fetching data

                        $on1 = 'invoice._invoiceId = account_student._studentId';

                        $_fetch['invoice'] = $Schema -> visual_join2('invoice', 'account_student', $on1);

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('pages/invoice/invoice', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function insert_invoice_data() {

                if (in_array(session() -> get('roles'), [1, 2])) {

                    $Schema = new Schema();

                    // Fetching data

                        $_fetch['studentData'] = $Schema -> visual('account_student');

                    // Return a view base from a file specified

                        echo view('layout/_header');
                        echo view('layout/_menu');

                        echo view('forms/invoice/insert_invoice', $_fetch);
                        echo view('layout/_footer');

                } else {

                    // Redirect an user back into dashboard pages

                        return redirect() -> to('/home/dashboard');

                }

            }

            public function action_insert_invoice_data() {

                $Schema = new Schema();

                // Personal information data collection

                    $username = $this -> request -> getPost('username_input');
                    $description = $this -> request -> getPost('description_input');
                    $duedate = $this -> request -> getPost('due_date_input');
                    $details = $this -> request -> getPost('details_input');

                    
                    // Convert data into an array and add into databases

                        if ($description === 'uang spp') {
                            
                            $invoiceData = array(

                                'invoice_description' => $description,
                                'invoice_due_date' => $duedate,
                                'invoice_bill' => $details,
                                'invoice_status' => 'belum lunas',
                                '_invoiceCreatedBy' => session() -> get('username'),
                                '_invoiceCreatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                                '_invoiceId' => $username

                            );

                            if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                                $Schema -> add_data('invoice', $invoiceData);

                            } else {

                                // Redirect an user back into dashboard pages

                                    return redirect() -> to('/home/dashboard');

                            }

                        } else if ($description === 'uang tahunan') {

                            $invoiceData = array(

                                'invoice_description' => $description,
                                'invoice_due_date' => $duedate,
                                'invoice_bill' => $details,
                                'invoice_status' => 'belum lunas',
                                '_invoiceCreatedBy' => session() -> get('username'),
                                '_invoiceCreatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                                '_invoiceId' => $username

                            );

                            if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                                $Schema -> add_data('invoice', $invoiceData);

                            } else {

                                // Redirect an user back into dashboard pages

                                    return redirect() -> to('/home/dashboard');

                            }

                        } else if ($description === 'uang buku') {

                            $invoiceData = array(

                                'invoice_description' => $description,
                                'invoice_due_date' => $duedate,
                                'invoice_bill' => $details,
                                'invoice_status' => 'belum lunas',
                                '_invoiceCreatedBy' => session() -> get('username'),
                                '_invoiceCreatedAt' => date('Y-m-d H:i:s', strtotime('now')),
                                '_invoiceId' => $username

                            );

                            if (in_array(session() -> get('roles'), [1, 2]) || session() -> get('id') > 0) {

                                $Schema -> add_data('invoice', $invoiceData);

                            } else {

                                // Redirect an user back into dashboard pages

                                    return redirect() -> to('/home/dashboard');

                            }

                        }
                    
                    // Redirect an user back into student pages

                        return redirect() -> to('/home/invoice');

            }

            public function pays_invoice() {

                $Schema = new Schema();

                    $invoiceData = $this -> request -> getPost('paid_invoice');

                    if (!empty($invoiceData)) {

                        foreach ($invoiceData as $_data) {

                            $update = [

                                'invoice_status' => 'lunas',

                            ];

                            $Schema -> edit_data('invoice', $update, ['_idInvoice' => $_data]);

                        }

                    }

                return redirect() -> to('/home/invoice');

            }

            public function change_accept($_id) {

                if (in_array(session() -> get('ranks'), [1, 2]) || session() -> get('id') > 0) {
    
                    $Schema = new Schema();
    
                    $invoiceData = array('_idInvoice' => $_id);
                    $status = array('invoice_status' => 'lunas', '_invoiceUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')));
    
                        $Schema -> edit_data('invoice', $status, $invoiceData);
    
                    // Redirect an user back into invoice pages
    
                        return redirect() -> to('/home/invoice');
    
                } else {
    
                    // Redirect an user back into dsahboard pages
    
                        return redirect() -> to('/home/dashboard');
                }
    
            }

            public function change_decline($_id) {

                if (in_array(session() -> get('ranks'), [1, 2]) || session() -> get('id') > 0) {
    
                    $Schema = new Schema();
    
                    $invoiceData = array('_idInvoice' => $_id);
                    $status = array('invoice_status' => 'belum lunas', '_invoiceUpdatedAt' => date('Y-m-d H:i:s', strtotime('now')));
    
                        $Schema -> edit_data('invoice', $status, $invoiceData);
    
                    // Redirect an user back into invoice pages
    
                        return redirect() -> to('/home/invoice');
    
                } else {
    
                    // Redirect an user back into dsahboard pages
    
                        return redirect() -> to('/home/dashboard');
                }
    
            }

}