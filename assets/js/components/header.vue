<template>

    <!-- ======= Header ======= -->
        <header id="header" :class="{'fixed-top':true , 'header-inner-pages' :!isIndex}"><!--class+= header-inner-pages-->
            <div class="container d-flex align-items-center justify-content-between" style="padding: 0px">

                <h1 class="logo"><a href="/">WIMM<span>?</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo"><img src="{{ asset( 'build/img/logo.png' ) }}" alt="" class="img-fluid"></a>-->

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/plannings">Plannings</a></li>
                        <li><a href="#">Movies</a></li>
                        <li><a href="#">Cinemas</a></li>
                        <li><a href="#">Contact</a></li>
                        <li class="drop-down logged-in pr-2"><a href="">Drop Down</a>
                            <ul>
                                <li><a href="#">Drop Down 2</a></li>
                                <li><a href="#">Drop Down 3</a></li>
                                <li><a href="#">Drop Down 4</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav><!-- .nav-menu -->

                <div v-if="user.role==='anon'" class="login-btns d-none d-lg-block">
                <a href="/login" class="login-btn">Login</a>
                <a href="/register" class="get-started-btn ">SignUp</a><!--class+=scrollto-->
                </div>
                <div v-else-if="user.role==='user'" class="dropdown">
                    <button class="btn btn-outline-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-user-fill"></i>
                        <span>{{user.username}}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/user/profile">My Profile</a>
                        <a class="dropdown-item" href="/user/settings">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Logout</a>

                    </div>
                </div>

            </div>
        </header><!-- End Header -->

</template>

<script>
    import { IsIndex } from  "@/services/page-context"
    import { getInfo } from "@/services/userInfo";
    export default {
        name: "header-component" ,
        data()
        {
            return {
                isIndex: IsIndex(),
                user:getInfo()
            }
        }
    }
</script>

<style scoped>
</style>