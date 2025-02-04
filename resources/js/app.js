import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: '.jpg, .jpeg, .png, .gif',
    // peritir eliminar imagen
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar imagen',
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on('sending', (file, xhr, formData) => {
    console.log(file);
})