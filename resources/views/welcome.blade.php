@extends('layouts.app')
@section('title', "Catalogue")
@section('content')

<h3>Catalogue</h3>

<br>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="catalogue">


    </tbody>

    
</table>

<div id="spinner" class="spinner-border" role="status" style="margin: 0 auto;">
    <span class="visually-hidden">Loading...</span>
</div>

<nav aria-label="Page navigation example">
    <ul id="pagination" class="pagination">
    </ul>
</nav>

@endsection

  
@section('script')


<script>
    var paginate = false;
    var page_num = 1;
    var username="ck_2682b35c4d9a8b6b6effac126ac552e0bfb315a0";
    var password="cs_cab8c9a729dfb49c50ce801a9ea41b577c00ad71";
    let cart = [];

    load_page(page_num);

    function add_to_cart(product_id, product_img, product_name, value){
        
        let id = product_id;
        let img = product_img;
        let name = product_name;
        let quantity = $(value).parent().prev().find('.quantity').val();

        if(quantity < 1){
            alert("Please pick 1 or more!");
            return false;
        }

        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/cart/store",
            type:"POST",
            data:{
                id:id,
                img:img,
                name:name,
                quantity:quantity,
                _token: _token
            },
            success:function(response){
                console.log(response);
                if(response) {

                    alert(response.success);

                }
            },
            error: function(error) {
            console.log(error);
            }
        });

    }

    function load_page(page_num){

        $("#spinner").show();

        $.ajax({
            type: "GET",
            url: "https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products?page="+page_num,
            dataType: 'json',
            headers: {
                "Authorization": "Basic " + btoa(username + ":" + password)
            },
            success: function (result, status, xhr){

                $("#spinner").hide();

                $( "#catalogue").empty();
                
                if(result.length > 0){
                    
                    
                    var html = '';
                    $.each(result, function( index, value ) {

                        html += '<tr>';
                        html += '<td>'+value.id+'</td>';
                        html += '<td><img height="100px" src="'+value.images[0].src+'"></td>';
                        html += '<td>'+value.name+'</td>';
                        html += '<td><input type="number" class="quantity" name="quantity" style="width:48px;" min="1" value="0"></td>';
                        html += '<td><button type="button" class="btn btn-primary" onclick="add_to_cart('+value.id+', '+"'"+value.images[0].src+"'"+', '+"'"+value.name+"'"+', this)">Add To Cart</button></td>';
                        html += '</tr>';
                    });
                    $('#catalogue').append(html);

                }

                var total_product = xhr.getResponseHeader("X-WP-Total");
                var total_pages = xhr.getResponseHeader("X-WP-TotalPages");

                if(paginate === false){

                    for (var i = 1; i <= total_pages; i++) {

                        $('#pagination').append('<li class="page-item">' +
                            '<a class="page-link" href="#" onclick="load_page('+i+')">'+i+'</a>'
                        +'</li>');

                    }

                    paginate = true;

                }

                $(".page-item").removeClass("active");

                $(".page-item")[page_num-1].classList.add("active");
  
            },
            error: function() {
                alert('There was some error performing the AJAX call!');
            }
        });
    }

</script>

@endsection

