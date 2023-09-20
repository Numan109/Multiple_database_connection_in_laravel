@extends('layouts.admin_master')
@push('cs')

@endpush

@section('main_content')
<div class="card-body">
    <div class="row">

  

    <form id="login" target="frame" method="post" action="https://v2.bidyaan.com/auth/login">
         <input type="hidden" name="username" value="viceprincipal" />
          <input type="hidden" name="password" value="123456" />

    </form>

<iframe id="frame" height="800px" width="100%" name="frame"></iframe>


    </div>
</div>

@endsection

@push('js')

<script type="text/javascript">

// submit the form into iframe for login into remote site 
document.getElementById('login').submit();

// once you're logged in, change the source url (if needed) 
var iframe = document.getElementById('frame'); iframe.onload = function() {

if (iframe.src != "http://v2.bidyaan.com/auth/login") { 
    iframe.src = "http://v2.bidyaan.com/auth/login";

}

} 
</script>
@endpush