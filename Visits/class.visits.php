<?php

class Visits{

    function _construct() {}

    private static $header;
    static function Header()
    {
        if (self::$header == TRUE) return;
        self::$header = TRUE;

        $code = "";

        $code .= "<script>
        $(document).ready( function() {
        
            /* TABS */        
            if ($('.tablinks').hasClass('active')){
                var id = $('.tablinks').attr('id');
                $('.tabcontent .' + id).show();
            }
        
            $('.tablinks').on('click', function(){
                $('.active').removeClass('active');
                $(this).addClass('active');
                var id = $(this).attr('id');
                
                $('.tabcontent').hide();
                $('.tabcontent.' + id).show();
            });
            
            $('.active').click();
            
        });


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
    background: #fff;
    border: none;
    padding: 0 15px;
}

/* SUB-HEADER */

.subheader{
    padding: 15px;    
}

h2.visit-date{
    text-align: center;
}

i.previous-visit, i.next-visit{
    font-size: 1.5rem;
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

.visits p{
    margin: 0 0 5px 0;
}
      
.visit-store{
    font-size: 0.9rem;
    font-weight: bold;
    margin: 0 0 10px 0;
}

        

.visit-time, .visit-address, .visit-type{
    font-size: 0.8rem;
    margin: 0 0 5px 0;
}


.visit-comment {
    position: relative;
    background-color: #fff;
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
        $code .= $this->subheader();
        $code .= $this->sidebar();
        $code .= $this->map();
        $code .= $this->content();
        return $code;

    }


    private function subheader(){
        
        $code = "";

        $code = "<div class='col-12 row subheader'>";
        $code .= "<i class='fas fa-angle-left previous-visit col-1'></i>";
        $code .= "<h2 class='visit-date col-10'>Tuesday, 05.05.2020 <a><i class='fas fa-calendar-alt'></i> </a></h2>";
        $code .= "<i class='fas fa-angle-right next-visit col-1'></i>";
        $code .= "</div>";

        return $code;
    }

    private function sidebar(){
        $code = "";
        
        $code = "<div class='visits row col-3 tab'>";


        foreach($this->groups as $name => $visits) {

            foreach ($visits as $visit) {
                $code .= "<div class='visit-infos col-12 button tablinks' id='visit-". $visit['visit_id'] ."'>";
                $code .= "<p class='visit-time'>". $visit['time_start'] . " - " .  $visit['time_end']  . "</p>";
                $code .= "<p class='visit-store'>". $visit['pos_name'] . " <a href='/intern/modules/AGI/PV/shops_show.php?id=". $visit['pos_id'] ."''> <i class='fas fa-external-link-alt'></i></a> </p>";
                $code .= "<p class='visit-address'>". $visit['pos_street'] . ", " . $visit['pos_city'] . "</p>";
                $code .= "<p class='visit-type'>". $visit['type'] . "</p>";
                $code .= "</div>";
            }
        }

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
        
        $code .= "<div class='content image-gallery col-9 tabcontent visit-1'>";
        
        $code .= "<div class='visit-comment col-12'>";
        $code .= "<i class='fas fa-info'></i>";
        $code .= "<p class='col-11'>Falta stock de galletas. Cards y delice. Y pack huevos.";
        $code .= "</p>";
        $code .= "</div>";


        $code .= "<div class='col-12 gallery-group'>";
        $code .= "<p class='principal'>Kinder Shelf</p>";
        $code .= "<div class='card col-4'>";
        $code .= "<div class='image ' style='background-image: url(Images/img_15566_18_104_1.jpg)'>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_15566_18_104_3.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_15566_18_104_2.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";


        $code .= "<div class='col-12 gallery-group'>";
        $code .= "<p class='principal'>Cookie Shelf</p>";
        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_15566_18_104_2.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "<div class='container'>";
        $code .= "<h4>Nutella B-ready present?</h4>";
        $code .= "<p class='text'>Yes</p>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        
        $code .= "<div class='image-gallery col-9 tabcontent visit-2 content'>";
        $code .= "<div class='col-12 gallery-group'>";
        $code .= "<p class='principal'>Kinder Shelf</p>";
        $code .= "<div class='card col-4'>";
        $code .= "<div class='image ' style='background-image: url(Images/img_16084_18_104_1.jpg)'>";
        $code .= "</div>";
        $code .= "</div>";
        
        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_16084_18_104_3.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_16126_18_104_5.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        $code .= "</div>";
        
        $code .= "<div class='image-gallery col-9 tabcontent visit-3 content'>";
        $code .= "<div class='visit-comment col-12'>";
        $code .= "<i class='fas fa-info'></i>";
        $code .= "<p class='col-11'>Kinder delice en este centro se vende muy bien. Falta stock de cards. Bombones y nutella sin stock practicamente.</p>";
        $code .= "</div>";
        
        $code .= "<div class='col-12 gallery-group'>";
        $code .= "<p class='principal'>Kinder Shelf</p>";
        $code .= "<div class='card col-4'>";
        $code .= "<div class='image ' style='background-image: url(Images/img_15502_18_104_3.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_15502_18_104_4.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "<div class='card col-4'>";
        $code .= "<div class='image' style='background-image: url(Images/img_16126_34_160_1.jpg)'>";
        $code .= "<i class='fas fa-expand'></i>";
        $code .= "</div>";
        $code .= "</div>";

        $code .= "</div>";
        $code .= "</div>";

        return $code;
    }
}


?>