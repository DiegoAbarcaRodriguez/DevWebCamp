(function () {
    const horas = document.querySelector('#horas');
    if (horas) {

     

        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');


        let busqueda = {
            categoria_id: +categoria.value??'',
            dia: +inputHiddenDia.value??''//+ Hace un casteo a int
        };

        if (!Object.values(busqueda).includes('')) {

            (async function(){ //Función IFEE que se retorna inmediatamente empleanda para que primero se termine de ejecutar buscarEventos que deshavilita a todas
                await buscarEventos();
                 //Resaltar hora actual
                const horaSeleccionada=document.querySelector(`[data-hora-id="${inputHiddenHora.value}"]`);
                horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                horaSeleccionada.classList.add('horas__hora--seleccionada');

                horaSeleccionada.onclick=seleccionarHora;
            })();
         

           

        }

        

        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));

        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;

            //Reiniciar los campos ocultos y el selector de horas
            inputHiddenHora.value='';
            inputHiddenDia.value='';

            const horaPrevia=document.querySelector('.horas__hora--seleccionada');

            if(horaPrevia){
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }


            if (Object.values(busqueda).includes('')) {
                return;
            }

            buscarEventos();
        }

        async function buscarEventos() {
            const { dia, categoria_id } = busqueda;
            const url = `/api/eventos-horario?categoria_id=${categoria_id}&dia_id=${dia}`;

            const resultado=await fetch(url);
            const eventos=await resultado.json();
            
            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos) {
            //Reiniciar las Horas
            const listadoHoras=document.querySelectorAll('#horas li');
            listadoHoras.forEach(li=>li.classList.add('horas__hora--deshabilitada'));



            //Comprobar eventos ya tomados y quitar la clase de deshabilitado en las horas no ocupadas
            const horasTomadas=eventos.map(evento=>evento.hora_id);
            const listadoHorasArray=Array.from(listadoHoras);

            const resultado=listadoHorasArray.filter(li=>!horasTomadas.includes(li.dataset.horaId));
            resultado.forEach(li=>li.classList.remove('horas__hora--deshabilitada'));


            const horasDisponibles=document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
            horasDisponibles.forEach(hora=>{
                hora.addEventListener('click',seleccionarHora);
            });
        }

        function seleccionarHora(e) {
            const horaPrevia=document.querySelector('.horas__hora--seleccionada');

            if(horaPrevia){
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            //Agregar clase seleccionado
            e.target.classList.add('horas__hora--seleccionada');

            inputHiddenHora.value=e.target.dataset.horaId;

            //Llenar el campo oculto de día
            inputHiddenDia.value=document.querySelector('[name="dia"]:checked').value;
        }
    }
})();