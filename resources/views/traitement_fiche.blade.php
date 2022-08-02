@extends('layouts.app')
@section('content')
<div class="mx-auto col-12">
@livewire('fiche.traitement')
</div> <!-- /.col-12 -->
<script>
    function imprimer()
{
    window.print()
}

const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timerProgressBar:true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert',({detail:{type,message}})=>{
            Toast.fire({
                icon:type,
                title:message
            })
        });
</script>
@endsection
