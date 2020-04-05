</body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@stack('ckeditor')
@stack('select2-js')


<script>
    function readURL(event) {
   if (event.target.files && event.target.files[0]) {
       let reader = new FileReader();

       reader.onload = function () {
           let output = document.getElementById('image');
           output.src = reader.result;
       }

       reader.readAsDataURL(event.target.files[0]);
   }
}
</script>


</html>
