<?php

include_once("Model/mStaff.php");
class controlStaff{
    function getAllKitchenStaff(){
        $p = new modelStaff();
        $tblUsers = $p->SelectAllKitchenStaff();
        return    $tblUsers;
    }
    
    function getAllCustomer(){
        $p = new modelStaff();
        $tblUsers = $p->SelectAllCustomer();
        return    $tblUsers;
    }
}