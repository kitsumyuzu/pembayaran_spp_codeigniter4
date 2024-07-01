                <footer class="footer">

                    <div class="container-fluid">

                        <nav class="pull-left">

                            <ul class="nav">
                                
                                <li class="nav-item">

                                    <a class="nav-link" href="https://instagram.com/kitsumyuzu">Instagram</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="https://github.com/@kitsumyuzu">Github</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="https://discord.gg/sound">Discord</a>

                                </li>

                            </ul>

                        </nav>

                        <div class="copyright ml-auto">

                            Copyright ©️ 2023 Kitsumyuzu

                        </div>

                    </div>

                </footer>

            </div>
            
        </div>

            <!--   Core JS Files   -->

                <script src="<?= base_url('Vendor') ?>/js/core/jquery.3.2.1.min.js"></script>
                <script src="<?= base_url('Vendor') ?>/js/core/popper.min.js"></script>
                <script src="<?= base_url('Vendor') ?>/js/core/bootstrap.min.js"></script>

            <!-- jQuery UI -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
                <script src="<?= base_url('Vendor') ?>/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

            <!-- jQuery Scrollbar -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


            <!-- Chart JS -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/chart.js/chart.min.js"></script>

            <!-- jQuery Sparkline -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

            <!-- Chart Circle -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/chart-circle/circles.min.js"></script>

            <!-- Datatables -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/datatables/datatables.min.js"></script>

            <!-- Bootstrap Notify -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

            <!-- jQuery Vector Maps -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/jqvmap/jquery.vmap.min.js"></script>
                <script src="<?= base_url('Vendor') ?>/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

            <!-- Sweet Alert -->

                <script src="<?= base_url('Vendor') ?>/js/plugin/sweetalert/sweetalert.min.js"></script>

            <!-- Atlantis JS -->

                <script src="<?= base_url('Vendor') ?>/js/atlantis.min.js"></script>

            <!-- Scripting -->

                <script>

                    $(document).ready(function() {

                        $("#show-password").on('click', function(event) {

                            event.preventDefault();

                            if($('#password_input').attr("type") == "password") {

                                $('#password_input').attr('type', 'text');
                                $('.fa-eye-slash').addClass('fa-eye');
                                $('.fa-eye').removeClass('fa-eye-slash');

                            } else {

                                $('#password_input').attr('type', 'password');
                                $('.fa-eye').addClass('fa-eye-slash');
                                $('.fa-eye-slash').removeClass('fa-eye');

                            };

                        });

                    });

                </script>

    </body>

    <style>

        /* Remove scroll bar */

        *::-webkit-scrollbar {

            display: none;

        }
        
    </style>

</html>