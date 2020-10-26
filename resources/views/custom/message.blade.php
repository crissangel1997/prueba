 @if (session('status_success'))
      <div class="alert alert-success custom-alert" role="alert">

           {{ session('status_success') }} 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
 @endif

 

 @if ($errors->any())
      <div class="alert alert-danger" role="alert">
          <ul>
          	@foreach($errors->all() as $error)
          	<li>{{ $error }}</li>
            
            
            @endforeach
          </ul>
      </div>
 @endif

  <script >
  
  window.setTimeout(function() {
       //$(".custom-alert").alert('close'); <--- Do not use this
     
       $(".custom-alert").slideUp(500, function() {
           $(this).remove();
       });
}, 2000);

 </script>  