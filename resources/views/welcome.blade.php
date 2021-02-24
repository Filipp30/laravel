@extends('layouts.app')
@section('content')

    <div>
        <navi-bar/>
    </div>
    <div>
        <router-view></router-view>
    </div>

@endsection
<script>
    import NaviBar from "../js/components/NaviBar";
    export default {
        components: {NaviBar}
    }
</script>
