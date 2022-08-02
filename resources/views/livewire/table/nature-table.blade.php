<table class="table datatables" id="dataTable-1">
    <thead class="thead-green">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Crée</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->created_at->format('d/m/Y') }}</td>
            <td>
                <button wire:click="edit({{ $row->id }})" type="button"
                    class="btn btn-sm btn-green-1"><i class="fe fe-edit"></i></button>
                <button onclick="deleteConfirmation({{ $row->id }})" type="button"
                    class="btn btn-sm btn-green-1"><i class="fe fe-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">Formulaire de mise a jour</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.nature') }}" method="POST" class="needs-validation p-3" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="validationCustom02">Nom</label>
                        <input type="text" wire:model.defer='nom' name="nom" class="form-control" id="validationCustom02" value=""
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
        window.addEventListener('show-form', event=>{
        $('#form').modal('show')
    })
</script>
