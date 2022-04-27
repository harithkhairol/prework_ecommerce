@extends('layouts.app')
@section('title', "Cart")
@section('content')

<h3>Cart</h3>

<br>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="carts">

    </tbody>
    
</table>

<div id="spinner" class="spinner-border" role="status" style="margin: 0 auto;">
    <span class="visually-hidden">Loading...</span>
</div>

<button type="submit" onclick="submit_order()" class="btn btn-primary">Submit Order</button>

@endsection

  
@section('script')

<script>

load_page();

function delete_product(product_id){

    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/cart/delete",
        type:"POST",
        data:{
            id:product_id,
            _token: _token
        },
        success:function(response){
            console.log(response);
            if(response) {

                alert(response.success);

            }
            load_page();
        },
        error: function(error) {
        console.log(error);
        }
    });

}

function submit_order(){

    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/order/store",
        type:"POST",
        data:{
            _token: _token
        },
        success:function(response){
            console.log(response);
            if(response) {

                alert(response.success);

            }
            load_page();
        },
        error: function(error) {
        console.log(error);
        }
    });

}

function load_page(){

    $("#spinner").show();

    $.ajax({
        type: "GET",
        url: "/cart/get",
        dataType: 'json',
        success: function (result){

            $("#spinner").hide();

            $( "#carts").empty();

            if(result.length > 0){

                
                var html = '';
                $.each(result, function( index, value ) {

                    html += '<tr>';
                    html += '<td>'+value.product_id+'</td>';
                    html += '<td><img height="100px" src="'+value.img+'"></td>';
                    html += '<td>'+value.name+'</td>';
                    html += '<td>'+value.quantity+'</td>';
                    html += '<td><button type="button" class="btn btn-danger" onclick="delete_product('+value.product_id+')">Delete</button></td>';
    
                    html += '</tr>';
                });
                $('#carts').append(html);

            }
            
        },
        error: function() {
            alert('There was some error performing the AJAX call!');
        }

    });

}

    
</script>

@endsection

