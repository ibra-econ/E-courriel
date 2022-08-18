@extends('layouts.app')
@section('content')
<div class="">
    @if (Session::has('insert'))
    <div class="text-center alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> {{ Session::get('insert') }}</strong>
    </div>
    @endif
</div>
<div class="my-3 row align-items-center">
    <div class="col">
        <h2 class="page-title">Agenda</h2>
    </div>
    <div class="col-auto">

        <button type="button" class="btn btn-green-1" data-toggle="modal" data-target="#eventModal"><span
                class="mr-3 fe fe-plus fe-16"></span>Créer</button>
    </div>
</div>
<div id='calendar'></div>
<!-- new event modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Fomulaire de nouvelle tache</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-4 modal-body">
                <form action="{{ route('new.agenda') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="eventTitle" class="col-form-label">Titre</label>
                        <input type="text" name="titre" class="form-control" id="eventTitle"
                            placeholder="Entrer le titre de la tâche ou de l'événement" required>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>
                    <div class="form-group">
                        <label for="eventNote" class="col-form-label">Objet/Description</label>
                        <textarea name="objet" class="form-control" id="eventNote"
                            placeholder="Description de la tâche ou de l'événement" required></textarea>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="eventType">Type</label>
                            <select id="eventType" name="type" class="form-control select2" required>
                                <option selected disabled value="">Selectionner</option>
                                <option value="0">Tâche</option>
                                <option value="1">Evénement</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="eventType">Destinateurs</label>
                            <select class="form-control select2-multi" name="destinateurs[]" multiple="multiple"
                                id="validationCustom04" required>
                                <optgroup label="Personnel">
                                    @forelse ($user as $row)
                                    <option value="{{ $row->id }}">{{ $row->name.' - '.$row->departement->nom }}
                                    </option>
                                    @empty
                                    <option>Aucun utilisateur</option>
                                    @endforelse
                                </optgroup>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date-input1">Date de debut</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                                <input type="date" name="debut" class="form-control drgpicker" id="drgpicker-start"
                                    required>
                            </div>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="startDate">Heure de debut</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="button-addon-time"><span
                                            class="fe fe-clock fe-16"></span></div>
                                </div>

                                <input type="time" name="heure_debut" class="form-control time-input" id="start-time"
                                    required>
                            </div>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date-input1">Date de fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                                <input type="date" name="fin" class="form-control drgpicker" id="drgpicker-end">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="startDate">Heure de fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="button-addon-time"><span
                                            class="fe fe-clock fe-16"></span></div>
                                </div>
                                <input type="time"  name="heure_fin" class="form-control time-input" id="end-time" placeholder="11:00 AM">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="mb-2 btn btn-green-1">Valider</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> <!-- new event modal -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/locales-all.min.js"></script>
<script>
    /** full calendar */
    var calendarEl = document.getElementById('calendar');
    if (calendarEl)
    {
      document.addEventListener('DOMContentLoaded', function()
      {
        var calendar = new FullCalendar.Calendar(calendarEl,
        {
            locale: 'fr',
          plugins: ['dayGrid', 'timeGrid', 'list', 'bootstrap','interactionPlugin','dayGridPlugin '],
          selectable: true,
          droppable: true,
          timeZone: 'UTC',
          themeSystem: 'bootstrap',
          header:
          {
            left: 'today, prev, next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          buttonIcons:
          {
            prev: 'fe-arrow-left',
            next: 'fe-arrow-right',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'
          },
          buttonText:{
            today:    "Aujourd'hui",
            month:    'Mois',
            week:     'Semaine',
            day:      'Jour',
            list:     'liste'
        },
          weekNumbers: true,
          eventLimit: true, // allow "more" link when too many events
          events: [
            @foreach ($rows as $row)
                        {
                title  : "{{ $row->titre }} objet:{{ $row->objet }}",
                start  : "{{ $row->debut }}T{{ $row->heure_debut }}",
                end  : "{{ $row->fin }}T{{ $row->heure_fin }}",
                },
            @endforeach
          ]
        });
        calendar.render();
      });
    }

</script>
@endsection
