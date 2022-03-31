<div class="topnav">
  <a 
    href="/"
    class="{{ request()->is('/') ? 'active' : '' }}"> 
        Home
  </a>
  <a 
    href="signup"
    class="{{ request()->is('signup') ? 'active' : '' }}"> 
        Sign up
  </a>
  <a 
    href="login"
    class="{{ request()->is('login') ? 'active' : '' }}"> 
        Log in
  </a>
</div>