<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop 'n' Go | @yield('title', '')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/media.css">

    @yield('extra-css')
       
</head>
<body>
    <div class="main-container" id="mainContainer">
        <!-- Navigation Bar-->
        <header id="navbar">
            <nav>
                <div class="container">
                    
                    @include('partials.components.nav')
                   
                </div>
            </nav>    
        @yield('content')  
    </div>
    <!-- Modal -->
    @include('auth.login')
    @include('auth.register') 
    <!-- End of Modal -->  
    @include('partials.modal.addtocart-modal') 
    @include('partials.components.footer')
   
    <!-- REQUIRED SCRIPTS --> 
    <script src="/js/app.js"></script>
    <script src="https://js.stripe.com/v3/"></script>  
    @yield('extra-js')
    <script>
        $(document).ready(function(){
    
            window.setTimeout(function() {
                $(".alertMsg").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 5000);

            $(document).on('click', '.itemRemove', function(event){
                event.preventDefault();  
                var id = $(this).attr("data-id");
                var url = "{{url('/cart/')}}/" + id;

                if(confirm("Are you sure you want to remove this item?")) {
                    $.ajax(url, {
                        type:"DELETE",       
                        dataType: "json",
                        success:function(response) {
                            if(response.success) {  
                                var success_html = '';
                                success_html += '<div class="success alertMsg" style="background-color: #edf9f0; color: #287d3c; text-align: center;">'
                                +response.success+'</div>';
                                $("#cartCount").html(response.count);
                                $("#cartContent").load(location.href+" #cartContent>*","");
                                $('#cartView').load(location.href+" #cartView>*","");
                                window.setTimeout(function() {
                                    $(".alertMsg").fadeTo(1000, 0).slideUp(1000, function(){
                                        $(this).remove(); 
                                    });
                                }, 5000);
                            } 
                        }      
                    })
                }
            }); 
        });
    </script>
</body>
</html>
