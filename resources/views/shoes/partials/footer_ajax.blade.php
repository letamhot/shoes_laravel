<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    function AddCart(id){
        // let qty = document.getElementById('quantity').value;
        // let check = document.getElementById('check_stock').value;
    $.ajax({
        url: 'add/cart/'+id,
        type: 'GET',
    }).done(function(response){
        // console.log(size);
        $("#change-item-cart").empty();
        $("#change-item-cart").html(response);
        // console.log(response);
        toastr.success("Added to your cart!");

    });
}
</script>

<script>
    let size = 'abc';
    function sizes(id){
        size = id;
        // console.log(id);
    }

    $(document).ready(function(){
        $(".qtyavailable").hide();
        $(".equipCatValidation").hide();
        $('.size-select1').click(function(){
            let inputValue = $(this).attr("value");
            // console.log(inputValue);
            let targetBox = $("." + inputValue);
            $(".qtyavailable").not(targetBox).hide();
            $(".equipCatValidation").not(targetBox).hide();
            $(".qtyexample").hide();

            $(targetBox).show();
            $(targetBox).val(1);
        });
    });

    function AddCartPost(id){
        let check = document.getElementById('check_stock').value;
        let qty = 1;
        if(size == 'abc'){
            qty = 1;
        } else {
            qty = document.getElementById(size).value;
        }
        $.ajax({
            url : 'addCartPost/'+id+'/'+qty+'/'+check+'/'+size,
            type : 'GET',
        }).done(function(response) {
            if(response.status == "error") {
                Command: toastr["warning"]("The number you have entered exceeds the number allowed !");
            } else if(response.status == "errorsize") {
                toastr.warning("Please select size");
            } else {
                $("#change-item-cart").empty();
                $("#change-item-cart").html(response);
                Command: toastr["success"]("Added this product to the cart");


            }
        });
    }
</script>

<script>
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            let inputValue = $(this).attr("value");
            let targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    });
</script>

<script>

</script>
<script>
    $("#list-cart").on("click", ".cart_delete i", function(){
        $.ajax({
            url : 'deleteListCart/' + $(this).data("id"),
            type : 'GET',
        }).done(function(res3){
            $("#list-cart").empty();
            $("#list-cart").html(res3);
            Command: toastr["success"]("Deleted this product");


        });
    });
</script>
<script>
    //Save Cart
    $("#list-cart").on("change", ".qty", function(){
        let y = $(this).data("id");
        let x = document.getElementById("quantityItem" + $(this).data("id")).value;
        $.ajax({
            url : 'saveCart/'+ y + '/'+ x,
            type : 'GET',
        }).done(function(res1){
            // console.log(res1);
            if(res1.status == "Wrong") {
                Command: toastr["warning"]("The number you have entered exceeds the number allowed !");
            } else {
                Command: toastr["success"]("Updated this product");
                $("#list-cart").empty();
                $("#list-cart").html(res1);
            }
        });
    });
</script>
