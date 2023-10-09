@extends('layouts.app')

@section('content')
<a href="{{ route('orders.index') }}" class="btn btn-primary">Retour</a>

    <h1>Modifier l'état de la commande</h1>

    <form action="{{ route('orders.update', $order->id)  }}" method="post" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">Selectinner le status actuelle de la commande</option>
                <option value="Commandé">Commandé</option>
                <option value="Confirmé">Confirmé</option>
                <option value="Livrés à la sociéte">Livrés à la sociéte</option>
                <option value="Livrés au client">Livrés au client</option>
                <option value="Retour">Retour</option>
                <option value="Annuler">Annuler</option>

            </select>
            <label for="payement_status">L'état du payement</label>
            <select name="payement_status" id="payement_status" class="form-control">
                <option value="">Selectinner l'état du payement de la commande</option>
                <option value="non payées">non payées</option>
                <option value="payées">payées</option>

            </select>
        </div>

        
        <button type="submit" class="btn btn-primary">Modifier la commande</button>
    </form>
@endsection

@section('after-scripts')
<script>
    // JavaScript logic for fetching and updating sizes dropdown based on selected category
    // This part of the script can remain the same as your create view
</script>
@endsection
