(() => {
    if(document.querySelector('.follow')) {
        
        consultarFollow()

        // consultar estado de following
        async function consultarFollow() {
            const username = document.querySelector('#user').textContent
            const url = `/${username}/consultar`
            
            try {
                const response = await fetch(url, {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                });  
                
                if(!response) {
                    throw new Error(`Error: ${response.status}`);
                }

                const data = await response.json();
                
                // renderizar html
                mostrarHTML(data);
            } catch (error) {
                console.log(error)
            }
        }

        function mostrarHTML(data) {

            // siguiendo y seguidores
            const followers = document.querySelector('.followers');
            const following = document.querySelector('.following');

            followers.textContent = data.followers;
            following.textContent = data.following;

            // cambiar boton
            if(data.follows){
                const form = document.querySelector('.unfollow');
                const noForm = document.querySelector('.follow');
                noForm.classList.add('hidden');
                form.classList.remove('hidden');
                form.addEventListener('submit', cambiarFollow);
            }
            else {
                const form = document.querySelector('.follow');
                const noForm = document.querySelector('.unfollow');
                noForm.classList.add('hidden');
                form.classList.remove('hidden');
                form.addEventListener('submit', cambiarFollow);
            }
        }

        async function cambiarFollow (e) {
            e.preventDefault();

            const form =e.target;
            const formData = new FormData(form);

            const response = fetch(form.action, {
                method: 'POST',
                body: formData
            });

            const data = await response;
            if(data.ok) {
                consultarFollow();
            }
        }

    }
})();