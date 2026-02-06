</div>
  <!-- end content -->
</section>
<!-- end admin -->
<!-- start screpting -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 

<!-- <script src="{{asset('public/backend/js/jquery.min.js')}}"></script> -->
<script src="{{asset('backend/js/tether.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/highcharts.js')}}"></script>
<script src="{{asset('backend/js/chart.js')}}"></script>
<script src="{{asset('backend/js/app.js')}}"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- end screpting -->



<script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script>
     
     <script>


       
     </script>

    <!-- Hide CKEditor security notice (message: "This CKEditor ... Version Is Not Secure") -->
    <style>
      /* generic fallbacks */
      .cke_security_notice, .cke_notification, .cke_alert, .cke_warning{ display: none !important; }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded', function(){
        // delay to allow CKEditor to insert its notice
        setTimeout(function(){
          // search all elements and hide ones that contain the CKEditor warning text
          document.querySelectorAll('div, span, p').forEach(function(el){
            try{
              if(el && el.textContent && el.textContent.trim().indexOf('This CKEditor') === 0){
                el.style.display = 'none';
                if(el.parentElement) el.parentElement.style.display = 'none';
              }
            }catch(e){}
          });
        }, 500);
      });
    </script>
</body>
</html>
