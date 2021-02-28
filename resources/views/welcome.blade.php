@extends('layouts.app')
@section('content')

    <nav>
        <navi-bar/>
    </nav>
    <article>
        <router-view></router-view>
    </article>

@endsection
<script>
    import NaviBar from "../js/components/NaviBar";
    export default {
        components: {NaviBar}
    }
</script>
