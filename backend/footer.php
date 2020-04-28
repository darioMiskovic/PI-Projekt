
   <script>

        let landPage = document.querySelector('.landing-page');

        document.addEventListener('click',e=>{

            if(e.target.id === 'registracija'){
                window.location = 'signup.php' 
            }else if(e.target.id === 'prijava'){
                window.location = 'index.php'
            }
        })
</script>

</body>
</html>