<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    .right-nav{
        width: 250px;
        height: 92%;
        margin-left: 0px;
        margin-top: -20px;
        overflow: hidden;
        background-color: #cccccc;
    }

    .menuItem{
        width: 250px;
        height: 50px;
        margin-left: 0px;
        /* margin-top: -8px; */
        background-color: rgba(101, 129, 248, 0.37);
    }

    .menuItem:hover{
        background-color: rgba(40, 169, 230, 0.65);
        display: block;
    }

    .menuItem:active{
        background-color: rgba(199, 169, 169, 0.82);
    }
    .menuItem > a{
        width: 96%;
        margin-left: 8px;
        padding-left: 10px;
        padding-top: 15px;
        height: 100%;
        text-decoration: none;    
    }
</style>
<div class="right-nav">
    <script>
        var nav = ["Pet Walking", "Pet Feeding", "Pet Socialisation", "Play Session"];
        var navLink = ["PurchasePetWalking.php", "./PetFeeding.php", "", ""];
        var i = 0;
        for (i = 0; i < nav.length; i++) {
            var menu = "<div class='menuItem' id='" + i + "'><a style='display:block; text-style: none;' href='" + navLink[i] + "'>" + nav[i] + "</a></div>";
            document.write(menu);
        }
    </script>
</div>