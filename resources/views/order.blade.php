@extends('layouts.app')
@section('title', "Order")
@section('content')

<h3>Order</h3>

<br>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="orders">
         
    </tbody>
    
</table>

<div id="spinner" class="spinner-border" role="status" style="margin: 0 auto;">
    <span class="visually-hidden">Loading...</span>
</div>



@endsection

  
@section('script')

<script>

    var notification = '<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">'
                            +'<span class="visually-hidden">New alerts</span>'
                        +'</span>'

    load_page();

    function received(order_id){


        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/order/received",
            type:"POST",
            data:{
                id:order_id,
                _token: _token
            },
            success:function(response){
                console.log(response);
                if(response) {

                    alert(response.success);

                }
                load_page();
                $('#linkNotify').append(notification);
                $('#linkNotify').attr("href", "/order/"+order_id);
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
            url: "/order/get",
            dataType: 'json',
            success: function (result){

                $("#spinner").hide();
                
                $( "#orders").empty();

                if(result.length > 0){
                    var html = '';
                    $.each(result, function( index, value ) {

                        html += '<tr>';
                        html += '<td>'+value.id+'</td>';
                        html += '<td>'+value.status+'</td>';

                        html += '<td>';
                        
                        if(value.status === "Pending"){

                            html += '<button type="button" class="btn btn-success" onclick="received('+value.id+')">Received</button>&nbsp;';

                        }

                        html += '<a type="button" class="btn btn-primary" href="/order/'+value.id+'">View</a>';

                        html += '<td>';

                        
                        html += '</tr>';
                    });
                    $('#orders').append(html);

                }
                
            },
            error: function() {
                alert('There was some error performing the AJAX call!');
            }

        });

    }

    

</script>


@endsection

