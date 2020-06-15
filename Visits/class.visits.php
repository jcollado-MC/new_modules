<?php

class visits{

    function _construct() {}

    private static $header;
    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "<script>
function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class='tabcontent' and hide them
    tabcontent = document.getElementsByClassName('tabcontent');
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = 'none';
    }

    // Get all elements with class='tablinks' and remove the class 'active'
    tablinks = document.getElementsByClassName('tablinks');
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(' active', '');
    }

    // Show the current tab, and add an 'active' class to the button that opened the tab
    document.getElementById(tabName).style.display = 'block';
    evt.currentTarget.className += ' active';
}

</script>";
        $code .= "<style>


/* TABS */

/* Style the tab */
.tabs {

    border: none;
    background-color: #eeeeee;
    padding: 15px;
}

/* Style the buttons that are used to open the tab content */
.tab .button {
    background-color: #f1f1f1;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 10px 16px;
    margin-bottom: 2px;
}

/* Change background color of buttons on hover */
.tab .button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab .button.active {
    background-color: #fff;
}

/* Style the tab content */
.tabcontent {
    display: none;
}


#alcampo{
    display: block;
}




/*IMAGE GALLERY*/

.image-gallery, .table{
    padding: 0 15px;
    margin-bottom: 15px;
}

.image-gallery div.image{
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    width: 100%;
    height: 300px;
    position: relative;
}

.image-gallery .image i{
    bottom: 0;
    right: 0;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.2rem;
    background-color: rgba(112, 112, 112, 0.4);
    padding: 5px;
    position: absolute;
    cursor: pointer;
}

.image-gallery .image i:hover{
    color: rgba(255, 255, 255, 1);
    background-color: rgba(112, 112, 112, 1);
}

.card {
    /* Add shadows to create the \"card\" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border: 2px solid white;
    margin-bottom: 5px;
}

/* Add some padding inside the card container */
.container {
    padding: 2px 16px;
}


.image-gallery p.subtitle{
    font-size: 0.8rem;
    color: #444444;
}

.gallery-group{
    margin-bottom: 25px;
}

/* SUB-HEADER */

h2.visit-date{
    text-align: center;
}

i.previous-visit, i.next-visit{
    font-size: 2rem;
    padding: 20px;
    cursor: pointer;
}

i.previous-visit:hover, i.next-visit:hover{
    color: #777777;
}

i.previous-visit{
    float: left;
}

i.next-visit, i.next-visit:before{
    float: right;
}

/* VISIT CONTENT */

/*.visit-header{*/
/*    background-color: #eeeeee;*/
/*    padding: 0 15px;*/
/*}*/

.visit-store{
    font-size: 1rem;
}

.visit-time, .visit-type{
    font-size: 0.8rem;
}


.visit-address{
    font-size: 0.8rem;
    margin: 0;
}

.visit-comment {
    position: relative;
    background-color: #fff;
    margin-bottom: 15px;

    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}


.visit-comment i{
    color: #3f48cc;
    font-size: 1.3rem;
    display: block;
    width: 15px;
    margin: 15px;
    float: left;
}


img.map{
    width: 100%;
    height: auto;
}

</style>";

        return $code;
    }


    function show() {

        $code = "";
        $code .= self::header();
        $code .= "<main>";
        $code .="<form method='post'>";
        $code .= $this->subheader();
        $code .= $this->sidebar();
        $code .= $this->map();
        $code .= $this->content();
        $code .= "</form>";
        $code .= "</main>";
        return $code;

    }


    private function subheader(){
        
        $code = "";

        $code = "<div class='col-12 row'>
                <i class='fas fa-angle-left previous-visit col-1'></i>
                <h2 class='visit-date col-10'>Tuesday, 05.05.2020 <a><i class='fas fa-calendar-alt'></i> </a></h2>
                <i class='fas fa-angle-right next-visit col-1'></i>
            </div>";

        return $code;
    }

    private function sidebar(){
        $code = "";
        
        $code = "<div class='visit-header row col-3 tab'>

                <div class='visit-infos col-12 button tablinks active' onclick='openTab(event, 'alcampo')'>
                    <p class='visit-time'>09:00 - 09:30 </p>
                    <h5 class='visit-store'>ALCAMPO - THADER MURCIA <a> <i class='fas fa-external-link-alt'> </i> </a> </h5>
                    <p class='visit-address'>AV DON JUAN DE BORBON S/N C.C.THADER MURCIA</p>
                    <p class='visit-type'>Visita Standard Hecho</p>
                </div>

                <div class='visit-infos col-12 button tablinks' onclick='openTab(event, 'carrefour1')'>
                    <p class='visit-time'>11:50 - 12:12 </p>
                    <h5 class='visit-store'>CARREFOUR - ZARAICHE <a> <i class='fas fa-external-link-alt'> </i> </a> </h5>
                    <p class='visit-address'>AV MIGUEL DE CERVANTES 106 C.C.CARREFOUR ZARAICHE | MURCIA</p>
                    <p class='visit-type'>Visita Standard Hecho</p>
                </div>

                <div class='visit-infos col-12 button tablinks' onclick='openTab(event, 'carrefour2')'>
                    <p class='visit-time'>12:37 - 13:08 </p>
                    <h5 class='visit-store'>CARREFOUR - MURCIA ATALAYAS <a> <i class='fas fa-external-link-alt'> </i> </a> </h5>
                    <p class='visit-address'>CL MOLINA SEGURA S/N C.C.CARREFOUR LAS ATALAYAS | MURCIA</p>
                    <p class='visit-type'>Visita Standard Hecho</p>
                </div>";

        return $code;
    }

    private function map(){
        $code = "";
        
        $code= "<img src='Images/Map.PNG' class='map col-12'>

            </div>";

        return $code;
    }

    private function content(){
        $code = "";
        
        $code = "
        <div class='image-gallery col-9 tabcontent' id='alcampo'>

                <div class='visit-comment col-12'>
                    <i class='fas fa-info'></i>
                    <p class='col-11'>Falta stock de galletas. Cards y delice. Y pack huevos.
                    </p>
                </div>

                    <div class='col-12 gallery-group'>
                        <p class='principal'>Kinder Shelf</p>
                        <div class='card col-4'>
                            <div class='image ' style='background-image: url(Images/img_15566_18_104_1.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>

                        </div>

                        <div class='card col-4'>
                            <div class='image' style='background-image: url(Images/img_15566_18_104_3.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                        </div>

                        <div class='card col-4'>
                            <div class='image' style='background-image: url(Images/img_15566_18_104_2.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                        </div>

                    </div>

                    <div class='col-12 gallery-group'>


                        <p class='principal'>Cookie Shelf</p>

                        <div class='card col-4'>
                            <div class='image ' style='background-image: url(Images/img_15566_18_104_3.jpg)'>
                                <i class='fas fa-expand'></i>
                            </div>
                            <div class='container'>
                                <h4>Nutella B-ready present?</h4>
                                <p class='text'>Yes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='image-gallery col-9 tabcontent' id='carrefour1'>

                <div class='col-12 gallery-group'>
                    <p class='principal'>Kinder Shelf</p>
                    <div class='card col-4'>
                        <div class='image ' style='background-image: url(Images/img_16084_18_104_1.jpg)'>
                            <i class='fas fa-expand'></i>
                        </div>

                    </div>

                    <div class='card col-4'>
                        <div class='image' style='background-image: url(Images/img_16084_18_104_3.jpg)'>
                            <i class='fas fa-expand'></i>
                        </div>
                    </div>

                    <div class='card col-4'>
                        <div class='image' style='background-image: url(Images/img_16126_18_104_5.jpg)'>
                            <i class='fas fa-expand'></i>
                        </div>
                    </div>

                </div>


            </div>
            <div class='image-gallery col-9 tabcontent' id='carrefour2'>

                <div class='visit-comment col-12'>
                    <i class='fas fa-info'></i>
                    <p class='col-11'>Kinder delice en este centro se vende muy bien. Falta stock de cards. Bombones y nutella sin stock practicamente.
                    </p>
                </div>

                <div class='col-12 gallery-group'>
                    <p class='principal'>Kinder Shelf</p>
                    <div class='card col-4'>
                        <div class='image ' style='background-image: url(Images/img_15502_18_104_3.jpg)'>
                            <i class='fas fa-expand'></i>
                        </div>

                    </div>

                    <div class='card col-4'>
                        <div class='image' style='background-image: url(Images/img_15502_18_104_4.jpg)'>
                            <i class='fas fa-expand'></i>
                        </div>
                    </div>

                    <div class='card col-4'>
                        <div class='image' style='background-image: url(Images/img_16126_34_160_1.jpg)'>
                            <i class='fas fa-expand'></i>
                        </div>
                    </div>

                </div>


            </div>
            </div>
        ";

        return $code;
    }




}


?>