
<aside class="main-sidebar sidebar-light-info " style="background-color: #E4E8ED">
  <a href="#" class="brand-link" style="background-color: #E4E8ED;">
  	  <img src="{{ asset('assets/image/logo_claris.png') }}" alt="Logo" class="brand-image font-weight-light" style="opacity: .8">
    	<span class="brand-text font-weight-light"><strong>Claris</strong></span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        <a href="#" class="text-muted text-sm">{{ auth()->user()->email }}</a>
      </div>
    </div>

