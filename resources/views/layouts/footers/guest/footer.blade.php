  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        @if (!auth()->user() || \Request::is('static-sign-up')) 
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
              <a href="https://www.instagram.com/starksmanbozzo/" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
              </a>
              <a href="https://gitlab.com/adityaerlangga" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-gitlab" aria-hidden="true"></span>
              </a>
              <a href="https://github.com/adityaerlangga" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-github" aria-hidden="true"></span>
              </a>
          </div>
        @endif
      </div>
      @if (!auth()->user() || \Request::is('static-sign-up')) 
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              <script>
                document.write(new Date().getFullYear())
              </script> Created by
              <a style="color: #252f40;" href="https://adityaerlangga.my.id/" class="font-weight-bold ml-1" target="_blank">Aditya Erlangga Wibowo</a>
            </p>
            <p class="mb-0 text-secondary">
              Using template by
              <a style="color: #252f40;" href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
              &
              <a style="color: #252f40;" href="https://www.updivision.com" class="font-weight-bold ml-1" target="_blank">UPDIVISION</a>.
            </p>
          </div>
        </div>
      @endif
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
