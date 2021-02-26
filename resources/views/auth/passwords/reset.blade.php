@extends('layouts.app')

@section('content')

    <div>
        <password-reset></password-reset>
    </div>

@endsection
<script>
    import PasswordReset from "../../../js/vue_pages/PasswordReset";
    export default {
        components: {PasswordReset}
    }
</script>
