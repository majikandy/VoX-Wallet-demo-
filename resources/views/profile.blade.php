        @extends('layouts.app')
        @section('content')                
            <section id="content">
                <div class="content--boxed-sm">
                    <header class="content__header">
                        <h1>{{ Auth::user()->name }} <small></small></h1>
                    </header>

                    <div class="well">
                        <div class="profile__img">
                            <img src="{{ Gravatar::fallback('http://urlto.example.com/avatar.jpg')->get(Auth::user()->email) }}" alt="It's {{ Auth::user()->name }}">

                            <!-- <a href="" class="zmdi zmdi-camera profile__img__edit"></a> -->
                        </div>

                        <div class="profile__info">
                            <p>Tech savvy, love dancing and reading</p>

                            <ul class="icon-list">
                                <!-- <li><i class="zmdi zmdi-phone"></i></li> -->
                                <li><i class="zmdi zmdi-email"></i> {{ Auth::user()->email }}</li>
                                <li><i class="zmdi zmdi-twitter"></i><a href="http://twitter.com/{{ strtolower(explode(" ", Auth::user()->name)[0]) }}">twitter.com/{{ strtolower(explode(" ", Auth::user()->name)[0]) }}</a></li>
                                <li><i class="zmdi zmdi-facebook"></i><a href="http://facebook.com/{{ strtolower(explode(" ", Auth::user()->name)[1]) }}">facebook.com/{{ strtolower(explode(" ", Auth::user()->name)[1]) }}</a></li>
                                <li><i class="zmdi zmdi-pin"></i>EC2M 4QD</li>
                            </ul>
                        </div>
                    </div>
                <!--<div class="card">
                        <div class="action-header action-header--card">
                            <ul class="action-header__menu">
                                <li><a href="profile-timeline.html">Timeline</a></li>
                                <li class="active"><a href="profile-about.html">About</a></li>
                                <li><a href="profile-photos.html">Photos</a></li>
                                <li class="action-header__settings"><a href=""><i class="zmdi zmdi-settings"></i></a></li>
                            </ul>
                        </div>

                        <div class="card__body">
                            <div class="card__sub">
                               
                                <p>Pellentesque vitae quam quis tellus dignissim faucibus. Suspendisse mattis felis at faucibus lobortis. Sed sit amet tellus dolor. Fusce quis sollicitudin velit. Praesent gravida ullamcorper lectus et tincidunt. Phasellus lectus quam, porta pharetra feugiat in, auctor eget dolor.</p>
                                <p>Vestibulum tincidunt imperdiet egestas. In in nunc vitae elit tincidunt tristique id eu justo. Quisque gravida maximus orci, vulputate pharetra mauris commodo at. Mauris eget fermentum ipsum, quis faucibus neque. Fusce eleifend sapien sit amet convallis rhoncus. Proin commodo lacinia lectus, et tempus turpis.</p>
                            </div>

                            <div class="card__sub">
                                <h4>Contact Information</h4>

                                <ul class="icon-list">
                                    <li><i class="zmdi zmdi-phone"></i>308-360-8938</li>
                                    <li><i class="zmdi zmdi-email"></i>robertbosborne@inbound.plus</li>
                                    <li><i class="zmdi zmdi-facebook"></i>robertbosborne</li>
                                    <li><i class="zmdi zmdi-twitter"></i>@robertbosborne</li>
                                    <li><i class="zmdi zmdi-pin"></i>5470 Madison Street Severna Park, MD 21146</li>
                                </ul>
                            </div>
                        </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            </section>
        @endsection