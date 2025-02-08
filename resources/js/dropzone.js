import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
(() => {
    if(document.querySelector('#dropzone')) {
        const dropzone = new Dropzone('#dropzone', {
            dictDefaultMessage: 'Sube aqui tu imagen',
            acceptedFiles: '.jpg, .jpeg, .png, .gif',
            // peritir eliminar imagen
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar imagen',
            maxFiles: 1,
            uploadMultiple: false,
    
            // se ejecuta cuando se carga dropzone
            // para recuperar la imagen anterior
            init: function() {
                if(document.querySelector('[name="imagen"]').value.trim()) {
                    const imagenPublicada = {};
                    imagenPublicada.size = 1234;
                    imagenPublicada.name = document.querySelector('[name="imagen"]').value;
    
                    // bind hay que llamarlo para que se ejecute la funcion, con call se ejecuta
                    this.options.addedfile.call(this, imagenPublicada);
                    this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
    
                    imagenPublicada.previewElement.classList.add('dz-success, dz-complete');
                }
            }
        });
    
        dropzone.on('success', (file, response) => {
            console.log(response.imagen);
            document.querySelector('[name="imagen"]').value = response.imagen;
        });
    
        dropzone.on('removedfile', (file) => { 
            document.querySelector('[name="imagen"]').value = '';
        });
    
    }
})();
