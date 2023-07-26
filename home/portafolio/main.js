const grid = new Muuri('.grid', {
    layout: {
        rounding: false
    }
});

window.addEventListener('load', () => {
    grid.refreshItems().layout();
    document.getElementById('grid').classList.add('imagenes-cargadas');

    // Agregamos los listener de los enlaces para filtrar por categoria.
    const enlaces = document.querySelectorAll('#categorias a');
    enlaces.forEach((elemento) => {
        elemento.addEventListener('click', (evento) => {
            evento.preventDefault();
            enlaces.forEach((enlace) => enlace.classList.remove('activo'));
            evento.target.classList.add('activo');

            const categoria = evento.target.innerHTML.toLowerCase();
            categoria === 'todos' ? grid.filter('[data-categoria]') : grid.filter(`[data-categoria="${categoria}"]`);
        });
    });

    // Agregamos el listener para la barra de busqueda
    document.querySelector('#barra-busqueda').addEventListener('input', (evento) => {
        const busqueda = evento.target.value;
        grid.filter((item) => item.getElement().dataset.etiquetas.includes(busqueda));
    });

    // Agregamos listener para las imagenes
    const overlay = document.getElementById('overlay');
    document.querySelectorAll('.grid .item img').forEach((elemento) => {
        elemento.addEventListener('click', () => {
            const ruta = elemento.getAttribute('src');
            const blogs = elemento.getAttribute('blogs');
            const descripcion = elemento.parentNode.parentNode.dataset.descripcion;
            overlay.classList.add('activo');
            document.querySelector('#overlay img').src = ruta;
            document.querySelector('#overlay .descripcion').innerHTML = descripcion;
            document.querySelector('#overlay .agregar').innerHTML = '<button onclick="uf_agregar('+blogs+');" class="agregar-btn" id="uf_agregar">Agregar</button';
        });
    });

    // Eventlistener del boton de cerrar
    document.querySelector('#btn-cerrar-popup').addEventListener('click', () => {
        overlay.classList.remove('activo');
    });

    // Eventlistener del overlay
    overlay.addEventListener('click', (evento) => {
        evento.target.id === 'overlay' ? overlay.classList.remove('activo') : '';
    });
});

function uf_agregar(id){
	
	$.ajax({
                async: false,
                dataType: 'html',
                data:  {
                  id_blogs: id,
                  agregar: 'yes'
                },
                url:   '../../admin/controller/c_article.php',
                type:  'post',
                beforeSend: function () {},
                success:  function (response) {
                    if( parseInt(response) == 1 ){
						alert('agregado');
                    }
                    else{
                     alert('Error al Agregar');
                    }
                },
                error: function( msj, xhr, status ) {
                    console.log( msj+" - "+xhr );
                }
          });
		  
}