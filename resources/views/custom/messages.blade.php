@if (session('warning'))
      <div class="alert alert-warning custom-alert" style="background: #ff8520;" role="alert">

           {{ session('warning') }} 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
 @endif

 <script >
 	
 	window.setTimeout(function() {
       //$(".custom-alert").alert('close'); <--- Do not use this
     
       $(".custom-alert").slideUp(500, function() {
           $(this).remove();
       });
}, 3000);

 </script> 	