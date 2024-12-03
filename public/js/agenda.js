
document.addEventListener('DOMContentLoaded', function() {
                let formulario = document.querySelector("form");


                var calendarEl = document.getElementById('agenda');
        
                var calendar = new FullCalendar.Calendar(calendarEl, {
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
                            let fechaSeleccionada = info.dateStr; // le paso el valor de la fecha que seleccione

                            
                            let startDate = new Date(fechaSeleccionada); // Crea un objeto Date con la fecha seleccionada
                            let endDate = new Date(fechaSeleccionada);   
                            endDate.setHours(endDate.getHours() + 1);


                            let hora_inicio = startDate.toISOString().slice(0, 16); // Formato 'YYYY-MM-DDTHH:mm'
                            let hora_termino = endDate.toISOString().slice(0, 16); // Lo mismo para la fecha de fin

                            
                            formulario.fecha_hora_inicio.value = hora_inicio;
                            formulario.fecha_hora_termino.value = hora_termino;

                        //parte que muestra el modal
                        var myModal = new bootstrap.Modal(document.getElementById('actividad'));
                        myModal.show();

                    },
                    


                    
                    eventClick: function(info) {
                        alert('Evento: ' + info.event.title + '\nDescripción: ' + info.event.extendedProps.description);
                    },

                    events: {

                        url: "/actividades/index",
                        failure: function(error) {
                            console.error('Error cargando eventos:', error);
                        },
                        success: function(data) {
                            console.log('Eventos cargados:', data);
                        }
                    },
                    

                    eventContent: function(info) {
                        // Esto elimina la numeración del evento
                        return { html: info.event.title };
                    },
                    eventDidMount: function(info) {
                        info.el.style.backgroundColor = info.event.extendedProps.backgroundColor;
                        info.el.style.borderColor = info.event.extendedProps.borderColor;
                    },
                    
                
                });



                calendar.render();

                document.getElementById("btnGuardar").addEventListener("click", function(){
                    var myModal = new bootstrap.Modal(document.getElementById('actividad'));
                    event.preventDefault(); // Prevenir el envío del formulario inmediatamente
                    const datos= new FormData(formulario);

                    if (!formulario.checkValidity()) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Por favor, completa todos los campos correctamente.',
                        });
                        return; // Si la validación falla, no se envían los datos
                    }
                    axios.post("/actividades", datos)
                        .then((respuesta) => {
                            myModal.hide();
                            console.log("Actividad guardada correctamente:", respuesta.data);

                            calendar.refetchEvents()
                            Swal.fire({
                                icon: 'success',
                                title: 'Actividad guardada correctamente',
                                text: 'La actividad ha sido registrada con éxito.',
                            })
                           
                        })
                        .catch((error) => {
                            if (error.response) {

                                let errorMessage = '';
                                if (error.response.data.errors) {
                                    // Iteramos sobre los errores que nos manda Laravel
                                    for (const [field, messages] of Object.entries(error.response.data.errors)) {
                                    errorMessage += `${messages.join(', ')}\n`;
                                }
                                } else {
                                    errorMessage = 'Hubo un problema al guardar la actividad.';
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorMessage, // Mostrar los mensajes de error aquí
                                });
                            }
                        });
                                        
                    });
                    document.getElementById('abrirModal').addEventListener('click', function () {
                        // Asegúrate de que el formulario se limpie antes de abrir el modal
                        formulario.reset();
                    });

                    
                    
                    
    
                    
                    
});
