(function () {
    const ponentesInput = document.querySelector('#ponentes');

    if (ponentesInput) {
        let ponentes = [];
        let ponentesFiltrados = [];

        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="ponente_id"]');

        obtenerPonentes();

        ponentesInput.addEventListener('input', buscarPonentes);

        if (ponenteHidden.value) {
            (async function (){
                const ponente=await obtenerPonente(ponenteHidden.value);
                const {nombre,apellido}=ponente;

                //Insertar en el HTML
                const ponenteHTML=document.createElement('LI');
                ponenteHTML.classList.add('listado-ponentes__ponente','listado-ponentes__ponente--seleccionado');
                ponenteHTML.textContent=`${nombre} ${apellido}`;

                listadoPonentes.appendChild(ponenteHTML);
            })();
        }


        async function obtenerPonentes() {
            const url = "/api/ponentes";

            const resultado = await fetch(url);
            const ponentes = await resultado.json();

            formatearPonentes(ponentes);

        }

        async function obtenerPonente(id) {
            const url = `/api/ponente?id=${id}`;

            const resultado = await fetch(url);
            const ponente = await resultado.json();

            return ponente;
        }

        

        function formatearPonentes(arrayPonentes = []) {
            ponentes = arrayPonentes.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            });

        }

        function buscarPonentes(e) {
            const busqueda = e.target.value;

            if (busqueda.length > 3) {
                const expresion = RegExp(busqueda, 'i');

                ponentesFiltrados = ponentes.filter(ponente => {
                    if (ponente.nombre.toLowerCase().search(expresion) != -1) {
                        return ponente;
                    }
                });
                mostrarPonentes();
            } else {
                ponentesFiltrados = [];
            }
        }

        function mostrarPonentes() {
            while (listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;

                    ponenteHTML.onclick = seleccionarPonente;

                    listadoPonentes.appendChild(ponenteHTML);

                })
            } else {
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-ponentes__no-resultado');
                noResultados.textContent = 'No hay resultado para tu búsqueda';

                listadoPonentes.appendChild(noResultados);
            }

            function seleccionarPonente(e) {
                const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
                if (ponentePrevio)
                    ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');

                const ponente = e.target;
                ponente.classList.add('listado-ponentes__ponente--seleccionado');

                ponenteHidden.value = ponente.dataset.ponenteId;
            }


        }
    }
})();