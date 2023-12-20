<!-- Basic modal -->
<div id="user{{$item->id}}" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-backdrop="user{{$item->id}}" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar estado del usuario</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                    <p> ¿ Esta seguro de inhabilitar el almacen? </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn bg-primary" data-dismiss="modal" onclick="inhabilitar('{{$item->id}}');" >Inhabilitar</button>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->