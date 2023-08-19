<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    function userLoginPage():View{
        return view('pages.auth.user-login-page');
    }

    function userRegistrationPage():View{
       return view('pages.auth.user-register-page');
    }

    function sendingOTPCode():View{
        return view('pages.auth.send-OTP-code-page');
    }

    function otpVerification():View{
        return view('pages.auth.otp-verify-page');
    }

    function resetUserPassword():View{
        return view('pages.auth.password-reset-page');
    }

    function dashboardPage():View{
        return view('pages.dashboard.user-dashboard-page');
    }

    function userLogoutPage(){
        return redirect('/userLogin')->cookie('token', '', -1);
    }

    function userProfileShow():View{
        return view('pages.dashboard.user-profile-page');
    }

    function incomePageInfo():View{
        return view('pages.dashboard.income-page');
    }

    function expensePageInfo():View{
        return view('pages.dashboard.expense-page');
    }

}
