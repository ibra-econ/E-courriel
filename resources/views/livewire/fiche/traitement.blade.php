<div class="shadow card">
    <div class="p-5 card-body">
        <div class="mb-5 row">
            <div class="mb-4 text-center col-12">
                <h2 class="mb-0 text-uppercase">FORMULAIRE DE TRAITEMENT COURRIER</h2>
                <p class="text-dark">DIRECTION NATIONALE DE L’URBANISME ET DE L’HABITAT</p>
            </div>
            <div class="col-md-7">
                <p class="mb-2 text-dark text-uppercase font-weight-bolder">Numéro d’arrivée: N°{{
                    $courrier->id }}</p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">Références: {{ $courrier->reference }}
                </p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">Expediteur: {{ $courrier->emetteur }}
                </p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">Destinateur: {{ $courrier->destinateur
                    }}</p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">Objet: {{ $courrier->objet }}</p>
            </div>

            <div class="col-md-5">
                <p class="mb-2 text-dark text-uppercase font-weight-bolder">Date d'arrivée : {{
                    date('d/m/Y',strtotime($courrier->date_arriver)) }}</p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">En date du: {{
                    $courrier->created_at->format('d/m/Y H:m:s') }}</p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">Type: {{ $courrier->type }}</p>
                <p class="mb-2 text-dark font-weight-bolder text-uppercase">Priorité: {{ $courrier->priorite }}</p>
            </div>
        </div>
         <!-- /.row -->

        {{-- include annotation et imputation --}}
        <hr>

        <h3 class="text-center">ANNOTATION {{  count($annotation)  }}</h3>
        <div class="row mt-5">
            @forelse ($traitement as $row)
            <div class="col-md-3">
                <div class="custom-control custom-checkbox mb-3">
                    <input wire:model="annotation" type="checkbox" class="custom-control-input" value="{{ $row->id }}" id="{{ $row->id }}">
                    <label class="custom-control-label" for="{{ $row->id }}">{{ $row->nom }}</label>
                </div>
            </div>
            @empty
            <h3 class="text-center">Aucune annotation</h3>
            @endforelse
        </div> <!-- /.row -->
        <hr>
        <h3 class="text-center">IMPUTATION {{  count($imputation)  }}</h3>
        <div class="row mt-5">
            @forelse ($imputations as $row)
            <div class="col-md-3">
                <div class="custom-control custom-checkbox mb-3">
                    <input wire:model="imputation" type="checkbox" class="custom-control-input" value="{{ $row->id }}" id="imputation{{ $row->id }}">
                    <label class="custom-control-label" for="imputation{{ $row->id }}">{{ $row->imputation }}</label>
                </div>
            </div>
            @empty
            <h3 class="text-center">Aucune imputation</h3>
            @endforelse
        </div> <!-- /.row -->

        <div class="text-center">
            <button class="btn btn-primary" wire:click="save_imputation">test</button>
            <a href="{{ route('Traitement') }}" role="button" class="mb-2 btn btn-secondary">Annuler</a>
            <button wire:click='save_annotation' class="mb-2 btn btn-success">Enregistrer</button>
            <button type="button" onClick="imprimer()" class="mb-2 btn btn-success">Imprimer</button>
            <p>NB : Tout courrier reçu doit faire l’objet d’une ventilation dans les 24 heures
                qui suivent son arrivée.</p>
        </div>
    </div> <!-- /.card-body -->
</div> <!-- /.card -->
<div class="modal fade" id="verticalModal" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de nouvelle Nature</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('new.nature') }}" method="POST" class="needs-validation p-3" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="validationCustom02">Nom</label>
                        <input type="text" name="nom" class="form-control" id="validationCustom02" value=""
                            placeholder="Entrez le nom de la nature" required>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>

                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn mb-2 btn-success">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>

        @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif
</script>
