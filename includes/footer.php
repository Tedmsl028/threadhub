</div><br><br><br><br>
 <footer class="text-right" id="footer">
   <div class="col-xs-3">
     <img src="/threadhub/images/logo/threadhub.png" style="width:185px">
     <br>
     <p><span class="glyphicon glyphicon-heart"></span> Your Trendy Online Clothing Store
       <br><br>
       Email: info@threadhubstore.co.za
       <br>
       Phone: (+27) 0 81 767 3854
       <br><br>
       Copyright © 2017 <a href="/threadhub/index.php" alt="home">Threadhub Store</a>
     </p>
   </div>
   <div class="col-xs-3"><br>
     <label for="size">MY ACCOUNT</label>
     <hr>
     <p>
       <a href="/threadhub/index.php" alt="home">Account Settings</a>
       <br>
       <a href="/threadhub/index.php" alt="home">Order History</a>
       <br>
       <a href="/threadhub/cart.php" alt="home">My Cart</a>
       <br>
       <a href="/threadhub/wishlist.php" alt="home">My Wishlist</a>
     </p>
   </div>
   <div class="col-xs-3"><br>
     <label for="size">QUESTIONS?</label>
     <hr>
     <p>
       <a href="/threadhub/index.php" alt="home">How to Shop</a>
       <br>
       <a href="/threadhub/index.php" alt="home">Secure Shopping</a>
       <br>
       <a href="/threadhub/index.php" alt="home">Delivery</a>
       <br>
       <a href="/threadhub/index.php" alt="home">Returns</a>
       <br>
       <a href="/threadhub/index.php" alt="home">FAQ</a>
       <br>
       <a href="/threadhub/terms.php" alt="home">Terms & Conditions</a>
       <br>
       <a href="/threadhub/privacy.php" alt="home">Privacy Policy</a>
     </p>
   </div>
   <div class="col-xs-2"><br>
     <label for="size">ABOUT US</label>
     <hr>
     <p>
       <a href="/threadhub/index.php" alt="home">Who Are We</a>
       <br>
       <a href="/threadhub/index.php" alt="home">Work at Threadhub</a>
       <br>
       <a href="/threadhub/index.php" alt="home">Contact Ust</a>
     </p>
   </div>
 </footer>
 <img src="/threadhub/images/about/footer.png" style="max-width: 100%;">


 <script>
   jQuery(window).scroll(function(){
   var vscroll = jquery(this).scrollTop();
   jquery('#logotext').css({
     "transform" : "translate(0px, "+vscroll/2+"px)"
   });

   var vscroll = jquery(this).scrollTop();
   jquery('#back-flower').css({
     "transform" : "translate("+vscroll/5+"px, -"+vscroll/12+"px)"
   });

   var vscroll = jquery(this).scrollTop();
   jquery('#fore-flower').css({
     "transform" : "translate(0px, -"+vscroll/2+"px)"
   });
   });

   function detailsmodal(product_id){
     var data = {"product_id" : product_id};
     jQuery.ajax({
       url : '/threadhub/includes/detailsmodal.php',
       method : "post",
       data : data,
       success : function(data){
         jQuery('body').append(data);
         jQuery('#details-modal').modal('toggle');
       },
       error : function(){
         alert("Oops, Something Went Wrong!");
       }
     });
   }

   function update_cart(mode,edit_id,edit_size){
     var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
     jQuery.ajax({
       url : '/threadhub/admin/parsers/update_cart.php',
       method : "post",
       data : data,
       uccess : function(){location.reload();},
       error : function(){
         alert("Oops, Something Went Wrong!");}
     });
   }


   function add_to_cart(){
     jQuery('#modal_errors').html("");
     var size = jQuery('#size').val();
     var quantity = jQuery('#quantity').val();
     var available = jQuery('#available').val();
     var error = '';
     var data = jQuery('#add_product_form').serialize();
     if(size == '' || quantity == '' || quantity == 0){
       error += '<p class="text-danger text-center">You must choose a size and quantity!</p>';
       jQuery('#modal_errors').html(error);
       return;
     }else if(quantity > available){
       error += '<p class="text-danger text-center">There are only '+available+' available!</p>';
       jQuery('#modal_errors').html(error);
       return;
     }else{
       jQuery.ajax({
         url : '/threadhub/admin/parsers/add_cart.php',
         method: 'post',
         data : data,
         success : function(){
           location.reload();
         },
         error : function(){
           alert("Oops, Something Went Wrong!");}
       });
     }
   }
 </script>
 </body>
</html>
