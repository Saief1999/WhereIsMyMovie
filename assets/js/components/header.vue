<template>
    <!-- ======= Header ======= -->
    <header id="header" :class="{'fixed-top':true , 'header-inner-pages' :!isIndex}"><!--class+= header-inner-pages-->
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="/">WIMM<span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="{{ asset( 'build/img/logo.png' ) }}" alt="" class="img-fluid"></a>-->

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/plannings">Plannings</a></li>
                    <li><a href="#">Movies</a></li>
                    <li><a href="#">Cinemas</a></li>
<!--                    <li class="drop-down"><a href="">Drop Down</a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="drop-down"><a href="#">Deep Drop Down</a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>-->
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav><!-- .nav-menu -->

            <a href="#" class="get-started-btn scrollto">Get Started</a>

        </div>
    </header><!-- End Header -->
</template>

<script>

    import { IsIndex } from  "@/services/page-context"
    export default {
        name: "header-component" ,
        data()
        {
            return {
                isIndex: IsIndex()
                }
        }
    }
</script>

<style scoped>

</style>