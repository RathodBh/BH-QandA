</main>
</div>

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="js/script.js"></script>

<?php
if (isset($_SESSION['Swal-title'])) {
?>
    <script>
        Toast.fire({
            icon: "<?= $_SESSION['Swal-icon'] ?>",
            title: "<?= $_SESSION['Swal-title'] ?>"
        })
    </script>
<?php
    unset($_SESSION['Swal-title'], $_SESSION['Swal-icon'], $_SESSION['Swal-footer']);
}
?>


</body>


</html>