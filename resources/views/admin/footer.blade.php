{{-- Model --}}
@include('admin.product.detail')

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white" style="margin-top: auto">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
{{-- <a class="scroll-to-top rounded" href="js/#page-top">
    <i class="fas fa-angle-up"></i>
</a> --}}

<!-- Bootstrap core JavaScript-->
{{--  <script src="js/jquery.pjax.js"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="js/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="js/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="js/vendor/chart.js/Chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<script src="js/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="js/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/js/demo/datatables-demo.js"></script>
<script src="js/back-to-top.js"></script>
@stack('ckeditor-js')
@stack('ckeditor')
@stack('chart-js')
@stack('show-ajax')
@stack('select2-js')
@stack('clicked')
@stack('img-js')




</body>

</html>
