@extends('front.layout.layout')

@section('content')

<style>
    .password-input-container {
        position: relative;
    }

    .password-input-wrapper {
        display: flex;
        align-items: center;
    }

    .toggle-password {
        position: absolute;
        right: 22px;
        top: 40px;
        /* Adjust the value to change the distance from the right side */
        cursor: pointer;
    }
</style>


<!--====== App Content ======-->
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

                                <a href="index.html">Home</a>
                            </li>
                            <li class="is-marked">

                                <a href="dash-address-add.html">My Account</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">

                            <!--====== Dashboard Features ======-->
                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                <div class="dash__pad-1">

                                    Hello<span class="dash__text u-s-m-b-16" style="color: green;font-size:22px"> {{
                                        explode(' ',
                                        Auth::user()->name)[0] }}</span>
                                    <ul class="dash__f-list">
                                        <li><a href="account.html">My Billing/Contact Address</a></li>
                                        <li><a href="orders.html">My Orders</a></li>
                                        <li><a href="wishlist.html">My Wish List</a></li>
                                        <li><a href="update-password.html">Update Password</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!--====== End - Dashboard Features ======-->
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">Update Password</h1>

                                    <span class="dash__text u-s-m-b-30">Please enter your current password to update
                                        your password.</span>
                                    <p id="password-success"></p>
                                    {{-- <span id="success-icon"></span> --}}
                                    <p id="password-error"></p>
                                    <form class="dash-address-manipulation" id="passwordform" action="javascript:;"
                                        method="post">
                                        @csrf
                                        <div class="gl-inline">
                                            <div class="u-s-m-b-30 password-input-container">

                                                <label class="gl-label" for="current-password">Current Password
                                                    *</label>

                                                <input class="input-text input-text--primary-style" type="password"
                                                    name="current_password" id="current-password"
                                                    placeholder="Current Password">
                                                <i class="toggle-password fas fa-eye" id="toggle-current-password"
                                                    onclick="togglePasswordVisibility('current-password', 'toggle-current-password')"></i>

                                                <p id="password-current_password"></p>
                                            </div>
                                            <div class="u-s-m-b-30 password-input-container">

                                                <label class="gl-label" for="new-password">New Password *</label>

                                                <div class="password-input-wrapper">
                                                    <input class="input-text input-text--primary-style" type="password"
                                                        id="new-password" name="new_password"
                                                        placeholder="New Password">
                                                    <i class="toggle-password fas fa-eye" id="toggle-new-password"
                                                        onclick="togglePasswordVisibility('new-password', 'toggle-new-password')"></i>
                                                </div>
                                                <p id="password-new_password"></p>
                                            </div>

                                        </div>
                                        <div class="gl-inline">
                                            <div class="u-s-m-b-30 password-input-container">

                                                <label class="gl-label" for="confirm-password">Confirm Password
                                                    *</label>

                                                <input class="input-text input-text--primary-style" type="password"
                                                    id="confirm-password" name="confirm_password"
                                                    placeholder="Confirm Password">
                                                <i class="toggle-password fas fa-eye" id="toggle-confirm-password"
                                                    onclick="togglePasswordVisibility('confirm-password', 'toggle-confirm-password')"></i>
                                                <p id="password-confirm_password"></p>
                                            </div>
                                            <div class="u-s-m-b-30"></div>
                                        </div>


                                        <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                    </form>
                                </div>
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
    function togglePasswordVisibility(passwordFieldId,eyeIconId) {
        var passwordField = document.getElementById(passwordFieldId);
        var eyeIcon = document.getElementById(eyeIconId);
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }


</script>