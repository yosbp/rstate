// LOADER

function startSpinner(){
    window.scrollTo(0, 0);
    let loader_ajax=document.querySelector(".loader");
    loader_ajax.style.display='block';
};

function stopSpinner(){
    let loader_ajax=document.querySelector(".loader");
    loader_ajax.style.display='none';
}


//AJAX PARA FORMULARIOS

const formularios_ajax=document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();

    let enviar=confirm("Quieres enviar el formulario");

    if(enviar==true){

        startSpinner();
        let data= new FormData(this);
        let method=this.getAttribute("method");
        let action=this.getAttribute("action");

        let encabezados= new Headers();

        let config={
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        fetch(action,config)
        .then(respuesta => respuesta.text())
        .then(respuesta =>{ 
            let contenedor=document.querySelector(".form-rest");
            contenedor.innerHTML = respuesta;
            stopSpinner();
        });
    }

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviar_formulario_ajax);
});

