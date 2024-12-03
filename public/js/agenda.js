
document.addEventListener('DOMContentLoaded', function() {
                let formulario = document.querySelector("form");
                let isEditing = false; // Modo edición
                let currentEvent = null; // Evento seleccionado para editar


                var calendarEl = document.getElementById('agenda');
        
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap5',
                    initialView: 'dayGridMonth',

                    
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listDay'
                    },
                    buttonText: {
                        today: 'Hoy',
                        month: 'Mes',
                        week: 'Semana',
                        day: 'Día',
                        list: 'Día'
                    },
                    locale: 'es', 
                    windowResize: function(view) {
                        if (window.innerWidth < 768) {
                            calendar.setOption('height', 'auto'); // Ajuste de altura en móviles
                        }
                    },
                    height: 'auto', 
                    contentHeight: 'auto',
                    aspectRatio: 1.5,
                    
                    dateClick:function(info){
                        //lo reseteo
                        formulario.reset();
                        
                        isEditing = false;
                        currentEvent = null;

                        // Configurar fechas por defecto
                        let startDate = new Date(info.dateStr);
                        let endDate = new Date(info.dateStr);
                        endDate.setHours(endDate.getHours() + 1);

                        formulario.fecha_hora_inicio.value = startDate.toISOString().slice(0, 16);
                        formulario.fecha_hora_termino.value = endDate.toISOString().slice(0, 16);

                        document.querySelector('#actividad .modal-title').textContent = 'Agregar Actividad';
                        document.getElementById('btnGuardar').textContent = 'Guardar';
                        var myModal = new bootstrap.Modal(document.getElementById('actividad'));
                        myModal.show();
                        

                    },
                    


                    
                    eventClick: function(info) {
                        Swal.fire({
                            title: 'Detalles del Evento',
                            html: `
                                <p><strong>Evento:</strong> ${info.event.title}</p>
                                <p><strong>Descripción:</strong> ${info.event.extendedProps.description}</p>
                                <p><strong>Fecha de Inicio:</strong> ${info.event.start.toLocaleString()}</p>
                                <p><strong>Fecha de Término:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'No especificada'}</p>
                            `,
                            icon: 'info',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonText: 'Editar',
                            denyButtonText: 'Eliminar',
                            cancelButtonText: 'Cerrar',}).then((result) => {
                                if (result.isConfirmed) {
                                    formulario.reset();
                                    isEditing = true;
                                    currentEvent = info.event;

                                    formulario.nombre_actividad.value = info.event.title;
                                    formulario.descripcion.value = info.event.extendedProps.descripcion || '';
                                    formulario.fecha_hora_inicio.value = info.event.start.toISOString().slice(0, 16);
                                    formulario.fecha_hora_termino.value = info.event.end ? info.event.end.toISOString().slice(0, 16) : '';
                                    formulario.id_categoria.value = info.event.extendedProps.id_categoria || '';

                                    document.querySelector('#actividad .modal-title').textContent = 'Editar Actividad';
                                    document.getElementById('btnGuardar').textContent = 'Actualizar';

                                    var myModal = new bootstrap.Modal(document.getElementById('actividad'));
                                    myModal.show();
                                } else if (result.isDenied) {
                                    // Acción de eliminar
                                    Swal.fire({
                                        title: '¿Estás seguro?',
                                        text: "Esta acción no se puede deshacer.",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Sí, eliminar',
                                        cancelButtonText: 'Cancelar',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            axios.delete(`/actividades/${evento.id}`)
                                                .then(() => {
                                                    calendar.refetchEvents();
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Actividad eliminada',
                                                        text: 'La actividad ha sido eliminada con éxito.',
                                                    });
                                                })
                                                .catch((error) => manejarErrores(error));
                                        }
                                    });
                                }
                            });;
                    },

                    events: {

                        url: "/actividades/index",
                       
                    },
                    

                    eventContent: function(info) {
                        // Esto elimina la numeración del evento
                        return { html: info.event.title };
                    },
                    eventDidMount: function(info) {
                        // Establece el color de fondo y borde del evento
                        info.el.style.backgroundColor = info.event.backgroundColor;
                        info.el.style.borderColor = info.event.borderColor;
                    
                        // // Calcula el color del texto basado en el fondo
                        // const textColor = getTextColor(info.event.backgroundColor);
                        
                    
                        // // esto llamaba a la funcion de abajo (no sirvio)
                        // info.el.style.color = '#333333';
                    
                        // // into de forzar el color en algunas partes 
                        // const titleElement = info.el.querySelector('.fc-event-title');
                        // if (titleElement) {
                        //      titleElement.style.color = '#333333';
                        // }
                    
                        // const timeElement = info.el.querySelector('.fc-event-time');
                        // if (timeElement) {
                        //      timeElement.style.color = '#333333';
                        // }
                    },
                    editable: true,
                    droppable: true
                    
                    
                
                });
                // function getTextColor(backgroundColor) {
                //     let hexColor;
                
                //     // Si el color es en formato RGB, conviértelo a hexadecimal
                //     if (backgroundColor.startsWith('rgb')) {
                //         hexColor = rgbToHex(backgroundColor);
                //     } else {
                //         // Si ya está en formato hexadecimal, úsalo directamente
                //         hexColor = backgroundColor;
                //     }
                
                //     // Convierte hexadecimal a RGB
                //     const rgb = parseInt(hexColor.slice(1), 16);
                //     const red = (rgb >> 16) & 0xff;
                //     const green = (rgb >> 8) & 0xff;
                //     const blue = rgb & 0xff;
                
                //     // Calcula el brillo relativo (luminosidad)
                //     const brightness = (red * 299 + green * 587 + blue * 114) / 1000;
                
                //     // no supe hacer que el valor que devolviera no fuera un rgb (no si) 
                //     return brightness > 128 ? '#333333' : '#ffffff';
                // }
                
                // // Función auxiliar para convertir RGB a Hex (No Sirve)
                // function rgbToHex(rgb) {
                //     const rgbArray = rgb.match(/\d+/g).map(Number);
                //     return `#${rgbArray.map((x) => x.toString(16).padStart(2, '0')).join('')}`;
                // }
                


                calendar.render();

                document.getElementById("btnGuardar").addEventListener("click", function(){
                    event.preventDefault();

                    const datos = new FormData(formulario);

                    if (!formulario.checkValidity()) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Por favor, completa todos los campos correctamente.',
                        });
                        return;
                    }
                    if (isEditing) {
                        // Actualizar evento existente (PUT)
                        axios({
                            method: 'PUT',
                            url: `/actividades/${currentEvent.id}`, // URL para actualizar el evento
                            data: datos // Enviar los datos del formulario
                        })
                        .then((respuesta) => {
                            currentEvent.setProp('title', formulario.nombre_actividad.value);
                            currentEvent.setExtendedProp('descripcion', formulario.descripcion.value); 
                            currentEvent.setStart(formulario.fecha_hora_inicio.value);
                            currentEvent.setEnd(formulario.fecha_hora_termino.value); 
                            formulario.id_categoria.value = info.event.extendedProps.id_categoria || '';
                
                            modal.hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Evento Actualizado',
                                text: 'El evento ha sido actualizado con éxito.',
                            });
                        })
                        .catch((error) => {
                            manejarErrores(error);
                        });
                    } else {
                        // Crear nuevo evento (POST)
                        axios({
                            method: 'POST',
                            url: "/actividades", // URL para crear un nuevo evento
                            data: datos // Enviar los datos del formulario
                        })
                        .then((respuesta) => {
                            calendar.refetchEvents(); // Refresca los eventos en el calendario
                            modal.hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Actividad Guardada',
                                text: 'La actividad ha sido registrada con éxito.',
                            });
                        })
                        .catch((error) => {
                            manejarErrores(error);
                        });
                    }
                                        
                });
                
                document.getElementById('abrirModal').addEventListener('click', function () {

                        // para limpiar el modal si alguien lo abrio con la otra cosita
                        isEditing = false;
                        currentEvent = null;
                        document.querySelector('#actividad .modal-title').textContent = 'Agregar Actividad';
                        document.getElementById('btnGuardar').textContent = 'Guardar';
                        formulario.reset();
                        
                });
                function manejarErrores(error) {
                        console.log(error.response);
                        if (error.response && error.response.data.errors) {
                            let errorMessage = '<ul>';
                            for (const [field, messages] of Object.entries(error.response.data.errors)) {
                                messages.forEach((message) => {
                                    errorMessage += `<li>${message}</li>`;
                                });
                            }
                            errorMessage += '</ul>';
                
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                html: errorMessage,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al procesar tu solicitud.',
                            });
                        }
                    
                }
                    
                    
                    
    
                    
                    
});
