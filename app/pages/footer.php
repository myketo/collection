        </main>
        
        <footer class="text-muted pt-3">
            <div class="container">
                <!-- hide back to top on some subpages -->
                <p class="float-right">
                    <a href='#' id='scroll-btn'>Back to top</a>
                </p>
                <p class="text-center">&copy; 2020 <span class='font-weight-bold'>Mikołaj Pięcek s.p.z.o.o</span></p>
            </div>
        </footer>
        
        <script src='scripts/active.js'></script>
        <script>
            $("#scroll-btn").on('click', function(e){
                e.preventDefault();
                $('html, body').animate({scrollTop: 0}, 300);
            });
        </script>
    </body>
</html>