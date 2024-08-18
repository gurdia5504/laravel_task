<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return "Admin dashboard";
    }

    public function about()
    {
        return "Admin About";
    }

    public function contact()
    {
        return "Admin Contact";
    }
    public function dashboard_camp()
    {
        return "Camp dashboard";
    }

    public function about_camp()
    {
        return "Camp About";

    }

    public function contact_camp()
    {
        return "Camp Contact";

    }
    public function dashboard_sales()
    {
        return "Sales dashboard";
    }

    public function about_sales()
    {
        return "Sales About";

    }

    public function contact_sales()
    {
        return "Sales Contact";

    }
    public function dashboard_accounts()
    {
        return "Accounts dashboard";
    }

    public function about_accounts()
    {
        return "Accounts about";

    }

    public function contact_accounts()
    {
        return "Accounts contact";

    }
    public function dashboard_staff()
    {
        return "Staff dashboard";
    }

    public function about_staff()
    {
        return "Staff about";

    }

    public function contact_staff()
    {
        return "Staff contact";

    }
    public function dashboard_kitchen()
    {
        return "Kitchen dashboard";
    }

    public function about_kitchen()
    {
        return "Kitchen about";

    }

    public function contact_kitchen()
    {
        return "Kitchen contact";
    }
}
