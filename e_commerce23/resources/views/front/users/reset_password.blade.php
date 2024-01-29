
@extends('front.layout.layout')

@section('content')
<style>
    .divcheck{
        width: 400;
        margin:auto
    }
    .progress-bar{
        border-radius: 5px;
    }
</style>
 <!--====== App Content ======-->
 <input type="text" id="myinput" placeholder="please enter your password!">
 <div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-10">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">

                                <a href="index.html">Home</a></li>
                            <li class="is-marked">

                                <a href="lost-password.html">Reset</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">FORGOT PASSWORD?</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 u-s-m-b-30">
                        <div class="l-f-o">
                            <div class="l-f-o__pad-box">
                                <h1 class="gl-h1">PASSWORD RESET</h1>

                                <span class="gl-text u-s-m-b-30">Enter your email to reset your password.</span>
                                <p class="forgot-success"></p>
                                <form class="l-f-o__form" id="resetpasswordform" method="post" action="javascript:;">
                                    @csrf
                                    <input type="hidden" name="code" value="{{$code}}">
                                    <div class="u-s-m-b-30">

                                        <label class="gl-label" for="reset-email">Password *</label>

                                        <input class="input-text input-text--primary-style" type="password" onkeyup="isGood(this.value)" id="reset-password" name="password" placeholder="Enter password">
                                        <p id="reset-password"></p>
                                                <small class="help-block" id="password-text"></small>
                                                <div class="">
                                                    <ul>
                                                        <li>uppercase letter</li>
                                                        <li>lowercase letter</li>
                                                        <li>numbers</li>
                                                        <li>special characters</li>
                                                    </ul>
                                                </div>
                                    </div>
                                    <div class="u-s-m-b-30">

                                        <button class="btn btn--e-transparent-brand-b-2" type="submit">SUBMIT</button></div>
                                    <div class="u-s-m-b-30">

                                        <a class="gl-link" href="signin.html">Back to Login</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
</div>
<!--====== End - App Content ======-->
@endsection

<script>
    // password strong check
function isGood(password){
    // alert(1)
    var password_strength=document.getElementById("password-text");
    // textbox left blank
    if(password.length==0){
        password_strength.innerHTML="";
        return;
    }
    // regular expression
    var regex=new Array();
    regex.push("[A-Z]")//uppercase alphabet
    regex.push("[a-z]")//lowercase alphabet
    regex.push("[0-9]")//digit
    regex.push("[$@$!%*#?&]"); //Special Character.

    var passed=0;
    // validate for each regular expression
    for(var i=0;i<regex.length;i++){
        if(new RegExp(regex[i]).test(password)){
            passed++;
        }
    }
    // display status
    switch (passed) {
    case 0:
    case 1:
    case 2:
        strength = "<small class='progress-bar bg-danger' style='width: 40%;color:red'><h4>Weak</h4></small>";
        break;
    case 3:
        strength = "<small class='progress-bar bg-warning' style='width: 60%;color:orange'><h4>Medium</h4></small>";
        break;
    case 4:
        strength = "<small class='progress-bar bg-success' style='width: 100%;color:green'><h4>Strong</h4></small>";
        break;
}

    password_strength.innerHTML=strength;

}
var myinputelement=document.getElementById("myinput");
var orginalplaceholder=myinputelement.placeholder;
var letters=orginalplaceholder.split('');
var currentindex=0;
var isforward=true;
var intervalid=setInterval(() => {
    if(isforward){
        moveforward();
    }else{
        movebackward();
    }
}, 200);
function moveforward(){
    if(currentindex < letters.length){
        
    }
}
</script>