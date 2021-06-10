<?php 
/**________________________________________________________________________________
Author:         QUANG HIEU VO   
Parameters:     N/A
References:     N/A
Revisions:      N/A
________________________________________________________________________________
THIS IS A BOTTOM OF ALL THE PAGES, SIMPLY INCLUDE THE FOOTER
**/ ?>


<!-------------------------- BOTTOM -------------------------->  
    </div>
        <footer class="text-muted border-top" style="margin-top: 70px;">
            <div class="container">
            <div style="text-align: center;"><p>Created by Quang Hieu Vo - Copyright 2021 &copy;</p></div>
            </div>
        </footer>

        <style>
            .spinner {
                display: block;
                position: fixed;
                z-index: 1031; 
                top: 50%;
                right: 50%; 
                margin-top: -..px; 
                margin-right: -..px; 
            }
        </style>
    
            <div id="loading" class="spinner-border spinner justify-content-center align-items-center" style="z-index: 9999; display:none; width: 6rem; height: 6rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        

        <script>
            function loading() {
                //document.getElementById('Login').style.display = "none";
                document.getElementById('loading').style.display = "block";
                setTimeout(function() {
                    document.getElementById('loading').style.display = "none";
                    //document.getElementById('showme').style.display = "block";
                },2000);
                
            }
        </script>
    </body>
</html>