
document.addEventListener('DOMContentLoaded', function() {


                let formulario = document.querySelector("form");


                var calendarEl = document.getElementById('agenda');
        
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',

                    
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridDay,listDay'
                    },
                    buttonText: {
                        today: 'Hoy',
                        month: 'Mes',
                        week: 'Semana',
                        day: 'Día',
                        list: 'Lista'
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
                        }
                    } ,
                    
                    
                });



                calendar.render();

                document.getElementById("btnGuardar").addEventListener("click", function(){
                    var myModal = new bootstrap.Modal(document.getElementById('actividad'));
                    event.preventDefault();
                    const datos= new FormData(formulario);
                    console.log(datos);
                    axios.post("/actividades", datos)
                        .then((respuesta) => {
                            $("actividad").modal("hide");
                            console.log("Actividad guardada correctamente:", respuesta.data);
                            myModal.hide();
                            Swal.fire({
                                icon: 'success',
                                title: '¡Actividad guardada!',
                                text: 'La actividad se ha guardado correctamente.',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        })
                        .catch((error) => {
                            if (error.response) {

                                console.error("Error al guardar la actividad:", error.response.data); 
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un problema al guardar la actividad.',
                                });//errores de laravel
                            }
                        });
                                        
                    });
                    
                    
    
                    // Refrescar el calendario para mostrar la nueva actividad
                    calendar.refetchEvents()
});
