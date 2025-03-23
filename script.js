document.addEventListener('DOMContentLoaded', () => {
    let principalCalendar = document.getElementById('principalCalendar');
    let addEventModal = new bootstrap.Modal(document.getElementById('addEventModal'));
    let eventTitleInput = document.getElementById('event-title');
    let eventDateInput = document.getElementById('event-date');

    let mainCalendar = new FullCalendar.Calendar(principalCalendar, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        selectable: true,
        editable: true,
        droppable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,list'
        },
        buttonText: {
            today: "Aujourd'hui",
            year: 'Année',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
        },
        events: "get_events.php",  // Chargement des événements depuis la BDD
        dateClick: function (info) {
            eventTitleInput.value = "";
            eventDateInput.value = info.dateStr + "T12:00";
            addEventModal.show();
        },
        eventClick: function (info) {
            alert('Événement : ' + info.event.title);
        },
        height: '100vh',
        expandRows: true,
        aspectRatio: 1.35,
        eventLimit: 3,
        eventLimitText: 'plus',
        events: "get_events.php",  // Chargement dynamique des événements depuis la base de données
        dateClick: function (info) {
            eventTitleInput.value = "";
            eventDateInput.value = info.dateStr + "T12:00";
            addEventModal.show();
        }
    });

    mainCalendar.render();

    $(document).ready(function () {
        $("#save-event").click(function (e) {
            e.preventDefault();
    
            let titre = $("#event-title").val();
            let debut = $("#event-date").val();
    
            if (titre === "" || debut === "") {
                alert("Veuillez remplir tous les champs !");
                return;
            }
    
            $.ajax({
                url: "save_event.php",
                type: "POST",
                data: { title: titre, start: debut },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        alert("Événement enregistré !");
                        $("#addEventModal").modal("hide");
                        $("#event-title").val("");
                        $("#event-date").val("");
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Erreur lors de l'enregistrement !");
                }
            });
        });
    });
    
});