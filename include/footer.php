<!-- footer  -->
<div class="container-fluid text-secondary px-4 py-3" id="footer">
    <div class="row d-flex justify-content-around">
        <div class="col-lg-3 col-md-12 my-2 my-lg-2">
            <span class="my-logo h3">ASK ME</span>
            <p class="my-desc mt-2">Ask me is a social questions & Answers Engine which will help you establish your
                community and connect with other peoples.</p>
        </div>
        <div class="col-lg-2 col-md-3 my-2 my-lg-2 quick-links">
            <span>Quick Links</span>
            <div class="d-flex flex-column">
                <a href="index">Home</a>
                <a href="questions">Questions</a>
                <?php if (isset($_SESSION["uid"])) { ?>
                    <a href="my-questions">My Questions</a>
                <?php } ?>
                <a href="contact">Contact</a>
                <a href="about">About</a>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 my-2 my-lg-2 help">
            <span>Help</span>
            <div class="d-flex flex-column">
                <a href="faq">FAQ</a>
                <a href="">Payment</a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 my-3 my-lg-2 quick-links">
            <span>Let's stay connected</span>
            <p>Subscribe for get quickly updates</p>
            <input type="text" class="form-control w-85" placeholder="Enter Your Email">
            <button class="btn btn-secondary my-3">SUBSCRIBE <i class="fab fa-telegram"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr class="w-75 mx-auto text-center text-light" />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-center text-secondary">
                &copy;Copyright <span class="year">2022</span> By <a href="#" class="logo-href">Ask Me</a> |
                Allright reserved.</p>
            <div class="d-flex justify-content-center w-100 social-links">
                <a href="#" class="mx-2"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-facebook"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="mx-2"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    // $(document).ready(function() {
    //     $('#myTable').DataTable();
    // });
</script>

<!-- <script src="./bootstrap-5.1.3-dist/js/bootstrap.min.js"></script> -->
<script src="./js/jquery-3.6.0.min.js"></script>

<script src="./package/dist/sweetalert2.all.min.js"></script>
<!-- <script src="./datatables.min.js"></script>
<script src="./DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
<script src="./DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
<script src="./DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script> -->
<script src="./bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script> -->

<script src="./js/script.js"></script>
<?php

if (isset($_SESSION['Swal-title'])) {
?>
    <script>
        Swal.fire({
            // position: 'top-right',
            title: "<?= $_SESSION['Swal-title'] ?>",
            icon: "<?= $_SESSION['Swal-icon'] ?>",
            footer: "<?= $_SESSION["Swal-footer"] ?>",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php
    unset($_SESSION['Swal-title'], $_SESSION['Swal-icon'], $_SESSION['Swal-footer']);
}
?>

</body>

</html>