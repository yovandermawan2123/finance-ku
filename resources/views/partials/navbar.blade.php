<nav class="navbar navbar-expand-lg navbar-dark bg-success justify-content-center text-white" >
  <div class="container col-lg-6">
   
    <a class="navbar-brand" href="/">Finance-ku</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    
      <ul class="navbar-nav ms-auto">
            @auth
    
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome back, {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              
                
                <li>
                  <form action="/logout" method="POST" >
                    @csrf
                    <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-in-right"></i> Logout</button>

                  </form>
                  
                 </li>
              </ul>
            </li>


            
            @endauth
          </ul>
    
    </div>

  </div>
</nav>