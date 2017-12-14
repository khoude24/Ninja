@extends('layout')

@section('content')
    <div class="container">

        <h1>Hi <span class="job">ninja</span>!</h1>

        <div v-show="isShow" class="ninja-name">
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <div class="tile tile-profile">
                        <img class="job_img" src="img/ninja.png" alt="">
                        <h4>Your <span class="job">ninja</span> name is:</h4>
                        <h3 v-html="name" class="text-center"></h3>
                    </div>
                </div>
            </div>

            <h3>Share your name</h3>

            <div id="social-links">
                <ul>
                    <li>
                        <a href="" id="twitter_link" class="social-button ">
                            <span class="fa fa-twitter"></span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <h3>To get your <span class="job">ninja</span> name, type some awesome words in the input field, and separate them with enter, comma, or tab.</h3>

        <p><input type="text" id="tech" name="tags" placeholder="Enter some awesome words" class="tech-input"></p>
        <input type="hidden" id="secret" value="">

        <p class="text-center">
            <button v-on:click="greet" type="submit" class="btn btn-success">Generate my name</button>
        </p>

    </div>

@stop